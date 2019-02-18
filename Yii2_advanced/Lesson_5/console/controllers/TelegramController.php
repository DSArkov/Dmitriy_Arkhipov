<?php

//Регистрируем класс в пространстве имён.
namespace console\controllers;

//Импортируем классы.
use common\models\tables\Projects;
use common\models\tables\TelegramOffset;
use common\models\tables\TelegramSubscribe;
use SonkoDmitry\Yii\TelegramBot\Component;
use TelegramBot\Api\Types\Message;
use TelegramBot\Api\Types\Update;
use yii\console\Controller;


/**
 * Class TelegramController
 * @package console\controllers
 */
class TelegramController extends Controller
{
    /** @var Component $bot */
    private $bot;
    private $offset = 0;

    /**
     * Метод инициализирует бота.
     */
    public function init()
    {
        parent::init();
        $this->bot = \Yii::$app->bot;
    }

    /**
     * Метод получает новые сообщения и запускает их дальнейшую обработку.
     * @throws \Exception
     */
    public function actionIndex()
    {
        try {
            $updates = $this->bot->getUpdates($this->getOffset() + 1);
            $updCount = count($updates);
            if ($updCount > 0) {
                foreach ($updates as $update) {
                    $this->updateOffset($update);
                    $this->processCommand($update->getMessage());
                }
                echo 'Новых сообщений: ' . $updCount . PHP_EOL;
            } else {
                echo 'Новых сообщений нет.' . PHP_EOL;
            }
        } catch (\Exception $e) {
            echo 'Не удалось получить обновления от Telegram: ', $e->getMessage();
        }
    }

    /**
     * Метод проверяет наличие новых сообщений и если они есть, запоминает ID последнего.
     * @return int - Возвращает смещение.
     */
    private function getOffset()
    {
        $max = TelegramOffset::find()
            ->select('id')
            ->max('id');
        if ($max > 0) {
            $this->offset = $max;
        }
        return $this->offset;
    }

    /**
     * Метод сохраняет в БД информацию о новых сообщениях.
     * @param Update $update - Содержимое ответа API.
     */
    private function updateOffset(Update $update)
    {
        $model = new TelegramOffset([
            'id' => $update->getUpdateId(),
            'timestamp_offset' => date('Y-m-d H:i:s')
        ]);
        $model->save();
    }

    /**
     * Метод анализирует текст сообщения на наличие команды и выполняет её, если таковая имеется.
     * @param Message $message
     * @trows \Exception
     */
    private function processCommand(Message $message)
    {
        $params = explode(' ', $message->getText());
        $param = $params[1];
        $command = $params[0];
        $chatId = $message->getFrom()->getId();
        $channel = TelegramSubscribe::CHANNEL_PROJECT_CREATE;
        $response = 'Unknown command.';

        switch ($command) {
            case '/help':
                $response = "Доступные команды: \n\n";
                $response .= "/help - список команд;\n";
                $response .= "/project_create ##project_name## - создание нового проекта;\n";
                $response .= "/new_projects_subscription - подписка на новые проекты;\n";
                break;

            case '/project_create':
                $model = new Projects([
                    'title' => $param
                ]);
                if ($model->save()) {
                    $response = "Проект '{$param}' успешно создан.";
                }
                break;

            case '/new_projects_subscription':
                if (TelegramSubscribe::find()->where(['chat_id' => $chatId, 'channel' => $channel])->exists()) {
                    $response = 'Упс, оказывается вы уже подписаны на данную рассылку...';
                } else {
                    $model = new TelegramSubscribe([
                        'chat_id' => $chatId,
                        'channel' => $channel
                    ]);
                    $model->save();
                    $response = 'Вы подписаны на уведомления о новых проектах.';
                }
        }

        try {
            $this->bot->sendMessage($message->getFrom()->getId(), $response);
        } catch (\Exception $e) {
            echo 'Не удалось отправить сообщение: ', $e->getMessage();
        }
    }
}
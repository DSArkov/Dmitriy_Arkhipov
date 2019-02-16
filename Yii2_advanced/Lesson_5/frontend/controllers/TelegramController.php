<?php

//Регистрируем класс в пространстве имён.
namespace frontend\controllers;

//Импортирем классы.
use SonkoDmitry\Yii\TelegramBot\Component;
use yii\web\Controller;


/**
 * Class TelegramController
 * @package frontend\controllers
 */
class TelegramController extends Controller
{
    /**
     * Метод получает сообщения от пользователей и выводит на экран.
     * @throws \Exception
     * @return string
     */
    public function actionReceive()
    {
        /** @var Component $bot */
        $bot = \Yii::$app->bot;
        $bot->setCurlOption(CURLOPT_TIMEOUT, 20);
        $bot->setCurlOption(CURLOPT_CONNECTTIMEOUT, 10);
        $bot->setCurlOption(CURLOPT_HTTPHEADER, ['Expect:']);

        try {
            $updates = $bot->getUpdates();

            $messages = [];
            foreach ($updates as $update) {
                $message = $update->getMessage();
                $username = $message->getFrom()->getFirstName() . ' ' . $message->getFrom()->getLastName();
                $messages[] = [
                    'text' => $message->getText(),
                    'username' => $username
                ];
            }
            return $this->render('receive', ['messages' => $messages]);

        } catch (\Exception $e) {
            echo 'Не удалось получить обновления от Telegram: ', $e->getMessage();
        }
    }

    /**
     * Метод посылает сообщение пользователю.
     * @throws \Exception
     */
    public function actionSend()
    {
        /** @var Component $bot */
        $bot = \Yii::$app->bot;

        try {
            $bot->sendMessage('', 'Hello!');
        } catch (\Exception $e) {
            echo 'Не удалось отправить сообщение: ', $e->getMessage();
        }
    }
}
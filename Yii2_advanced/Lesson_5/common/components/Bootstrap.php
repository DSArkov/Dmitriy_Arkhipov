<?php

//Регистрируем класс в пространстве имён.
namespace common\components;

//Импортируем классы.
use common\models\tables\Projects;
use common\models\tables\TelegramSubscribe;
use yii\base\Component;
use yii\base\Event;


/**
 * Class BootstrapComponent
 * @package common\components
 */
class Bootstrap extends Component
{
    /**
     * Метод запускает компоненты предзагрузки.
     */
    public function init()
    {
        $this->attachEventHandlers();
    }

    /**
     * Метод осуществляет подписку на события "Insert" всех экземпляров класса "Projects".
     */
    protected function attachEventHandlers()
    {
        Event::on(Projects::class, Projects::EVENT_AFTER_INSERT, function(Event $event) {
            $title = $event->sender->title;
            $message = "Создан новый проект '{$title}.'";
            $subscribers = TelegramSubscribe::find()
                ->select('chat_id')
                ->where(['channel' => TelegramSubscribe::CHANNEL_PROJECT_CREATE])
                ->column();

            foreach ($subscribers as $subscriber) {
                /** @var \SonkoDmitry\Yii\TelegramBot\Component $bot */
                $bot = \Yii::$app->bot;
                $bot->sendMessage($subscriber, $message);
            }
        });
    }

}
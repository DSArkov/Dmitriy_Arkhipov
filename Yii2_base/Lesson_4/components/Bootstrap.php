<?php

//Регистрируем класс в пространстве имён.
namespace app\components;


//Используем классы.
use app\models\tables\Tasks;
use yii\base\BootstrapInterface;
use yii\base\Component;
use yii\base\Event;

//Компонент, отвечающий за проведение работ на старте приложения.
class Bootstrap extends Component implements BootstrapInterface
{
    /**
     * Метод запускает компоненты предзагрузки.
     * @param \yii\base\Application $app - Экземпляр класса.
     */
    public function bootstrap($app)
    {
        $this->attachEventHandlers();
    }

    /**
     * Метод осуществляет подписку на события "Insert" и "Update" всех экземпляров класса "Tasks".
     */
    protected function attachEventHandlers()
    {
        Event::on(Tasks::class, Tasks::EVENT_AFTER_INSERT, function ($event) {
            $task = $event->sender;
            $user = $task->responsible;

            \Yii::$app->mailer->compose()
                ->setTo($user->email)
                ->setFrom('info@tasks.ru')
                ->setSubject('Новая задача')
                ->setTextBody("За вами закреплена новая задача \"{$task->title}\".")
                ->send();
        });

        Event::on(Tasks::class, Tasks::EVENT_AFTER_UPDATE, function ($event) {
            $task = $event->sender;
            $user = $task->responsible;

            \Yii::$app->mailer->compose()
                ->setTo($user->email)
                ->setFrom('info@tasks.ru')
                ->setSubject('Изменена задача')
                ->setTextBody("В задаче \"{$task->title}\" произошли изменения.")
                ->send();
        });
    }
}
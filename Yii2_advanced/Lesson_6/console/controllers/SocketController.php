<?php

//Регистрируем класс в пространстве имён.
namespace console\controllers;

//Импортируем классы.
use console\components\Chat;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;
use yii\console\Controller;


/**
 * Class SocketController
 * @package console\controllers
 */
class SocketController extends Controller
{
    /**
     * Метод создаёт и запускает WebSocket сервер.
     * @param int $port - порт, на котором он работает.
     */
    public function actionStart($port = 8080)
    {
        $server = IoServer::factory(
            new HttpServer(
                new WsServer(
                    new Chat()
                )
            ),
            $port
        );
        $server->run();
    }
}
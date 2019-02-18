<?php

//Регистрируем класс в пространстве имён.
namespace console\components;

//Импортируем классы.
use common\models\tables\User;
use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;
use common\models\tables\Chat as ChatTable;


/**
 * Обработчик событий чата.
 * @package console\components
 */
class Chat implements MessageComponentInterface
{
    protected $clients = [];

    /**
     * Chat constructor.
     */
    public function __construct()
    {
        echo "Server started...\n";
    }

    /**
     * Когда соединение устанавливается.
     * @param ConnectionInterface $conn
     */
    function onOpen(ConnectionInterface $conn)
    {
        $queryString = $conn->httpRequest->getUri()->getQuery();
        $channel = explode('=', $queryString)[1];

        $this->clients[$channel][$conn->resourceId] = $conn;

        $history = ChatTable::find()->where(['channel' => $channel])->all();
        foreach ($history as $msg) {
            $data = [
                'time' => date('H:i', strtotime($msg->created_at)),
                'user_name' => $msg->user->username,
                'msg' => $msg->message,
            ];
            $this->clients[$channel][$conn->resourceId]->send(json_encode($data));
        }

        echo "New connection: {$conn->resourceId}\n";
    }

    /**
     * Когда соединение закрывается.
     * @param ConnectionInterface $conn
     */
    function onClose(ConnectionInterface $conn)
    {
        //$this->clients->detach($conn);
        echo "User {$conn->resourceId} disconnects!\n";
    }

    /**
     * Когда происходит ошибка.
     * @param ConnectionInterface $conn
     * @param \Exception $e
     */
    function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "Conn {$conn->resourseId} closed with error\n";
        $conn->close();
        //$this->clients->detach($conn);
    }

    /**
     * Когда приходят данные.
     * @param ConnectionInterface $from
     * @param string $msg
     */
    function onMessage(ConnectionInterface $from, $msg)
    {
        //echo "$msg\n";
        $getData = json_decode($msg, true);
        $channel = $getData['channel'];
        try {
            (new ChatTable($getData))->save();
        } catch (\Exception $e) {
            echo($e->getMessage());
        }

        $userId = $getData['user_id'];
        $userName = User::findOne($userId)->username;
        $time = date('H:i');
        $setData = [
            'time' => $time,
            'user_name' => $userName,
            'msg' => $getData['message'],
        ];
        foreach ($this->clients[$channel] as $client) {
            $client->send(json_encode($setData));
        }
    }
}
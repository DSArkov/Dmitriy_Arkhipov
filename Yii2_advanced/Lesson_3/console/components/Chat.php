<?php

//Регистрируем класс в пространстве имён.
namespace console\components;

//Импортируем классы.
use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;
use common\models\tables\Chat as ChatTable;


/**
 * Обработчик событий чата.
 * @package console\components
 */
class Chat implements MessageComponentInterface
{
    protected $clients;

    /**
     * Chat constructor.
     */
    public function __construct()
    {
        $this->clients = new \SplObjectStorage();
        echo "Server started...\n";
    }

    /**
     * Когда соединение устанавливается.
     * @param ConnectionInterface $conn
     */
    function onOpen(ConnectionInterface $conn)
    {
        $this->clients->attach($conn);
        echo "New connection: {$conn->resourceId}\n";
    }

    /**
     * Когда соединение закрывается.
     * @param ConnectionInterface $conn
     */
    function onClose(ConnectionInterface $conn)
    {
        $this->clients->detach($conn);
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
        $this->clients->detach($conn);
    }

    /**
     * Когда приходят данные.
     * @param ConnectionInterface $from
     * @param string $msg
     */
    function onMessage(ConnectionInterface $from, $msg)
    {
        echo "{$from->resourseId}: $msg\n";
        $data = json_decode($msg);
        try {
            (new ChatTable($data))->save();
        } catch (\Exception $e) {
            echo($e->getMessage());
        }

        foreach ($this->clients as $client) {
            $client->send($msg);
        }
    }
}
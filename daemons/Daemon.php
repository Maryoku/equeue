<?php

//require __DIR__ . '../vendor/ratchet/rfc6455';
namespace app\daemons;
use app\models\Ticket;
use app\models\Window;
use Ratchet\Client;

class Daemon
{
    function init()
    {
        \Ratchet\Client\connect('ws://localhost:8080')->then(function (\Ratchet\Client\WebSocket $conn) {
            $conn->on('message', function ($msg) use ($conn) {
                echo "Received: {$msg}\n";
            });
            if ($this->getLastDbRows() != '{ }') {
                $conn->send($this->getLastDbRows());
                $conn->close();
            } else {
                echo "Нет записей \n";
                $conn->close();
            }
        }, function (\Exception $e) {
            echo "Could not connect: {$e->getMessage()}\n";
        });
    }

    function getLastDbRows(){

        $window_num = Window::getWindowNum();
        $ticket_num = Ticket::getTicketNum();

        if (($ticket_num == null) || ($window_num == null)){
            $rows = Ticket::getLastRows();
            $data = json_encode($rows,true);
            return $data;
        } else {
            $ticket = Ticket::findOne($ticket_num);


            $ticket->time_start = date('g:i a');
            $ticket -> WindowNum = $window_num;
            
            $ticket->save();
            
            $rows = Ticket::getLastRows();            
            $data = json_encode($rows,true);

            return $data;
        }


    }
}

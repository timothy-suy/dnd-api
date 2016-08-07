<?php

namespace App\Events;
/*
class Hello
{
	public function fire($message)
	{
		$socket = \App::make("App\Http\Controllers\SocketController\SocketController");
		$socket->sendMessage($message);
	}
}
*/
use App\Events\Event;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class Hello extends Event implements ShouldBroadcast
{
    use SerializesModels;

    public $data;

    public function __construct()
    {
        $this->data = array(
            'data'=> 'azertty'
        );
    }

    public function broadcastOn()
    {
        return ['message'];
    }
}
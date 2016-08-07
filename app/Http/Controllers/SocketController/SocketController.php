<?php namespace App\Http\Controllers\SocketController;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Request;
use LRedis;
 
class SocketController extends Controller {
	public function __construct()
	{
		$this->middleware('guest');
	}
	public function sendMessage($message){
		$redis = LRedis::connection();
		return $redis->publish('message', $message);
	}
}
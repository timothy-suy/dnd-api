<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/', function() {
return 'home';
});

Route::get('/api/hello', function() {
	$hello = \App::make("App\Events\Hello");
	event($hello);
    return response('event fired', 200)
                  ->header('Content-Type', 'text/plain');});

?>
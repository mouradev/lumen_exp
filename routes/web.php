<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', function () use ($app) {
    #return $app->version();
    return "hello lumen";
});

$app->group([], function($app)
{
    $app->get('user','UserController@index');
  
    $app->get('user/{id}','UserController@getUser');
      
    $app->post('user','UserController@createUser');
      
    $app->put('user/{id}','UserController@updateUser');
      
    $app->delete('user/{id}','UserController@deleteUser');
});

$app->group([], function($app)
{
    $app->get('game','GameController@index');
  
    $app->get('game/{id}','GameController@getgame');
      
    $app->post('game','GameController@creategame');
      
    $app->put('game/{id}','GameController@updategame');

    $app->put('game/{id}/adduser/{user_id}','GameController@addUser');

    $app->put('game/{id}/removeuser/{user_id}','GameController@removeUser');    
      
    $app->delete('game/{id}','GameController@deletegame');
});

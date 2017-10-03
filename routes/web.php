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
  
    $app->get('user/{id}','UserController@getuser');
      
    $app->post('user','UserController@createUser');
      
    $app->put('user/{id}','UserController@updateUser');
      
    $app->delete('user/{id}','UserController@deleteUser');
});

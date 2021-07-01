<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use Illuminate\Support\Str;
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

$router->get('/', function () use ($router) {
    return $router->app->version();
});


$router->group(['prefix' => 'api'], function () use ($router) {
    $router->post('/register', 'AuthController@register');
    $router->post('/login', 'AuthController@login');

    
    
    
    $router->group(['middleware' => 'auth'], function () use ($router) {
        $router->post('/orders', 'OrdersController@create');
        $router->get('/orders/status/{status}', 'OrdersController@status');
        $router->get('/orders/{id}', 'OrdersController@get');
        $router->put('/orders/{id}', 'OrdersController@pay');
        
        $router->post('/order', 'OrderDetailsController@create');
        $router->put('/order/{id}', 'OrderDetailsController@update');
        $router->delete('/order/{id}', 'OrderDetailsController@delete');
        
        
        $router->post('/logout', 'AuthController@logout');
        $router->get('/foods', 'FoodsController@index');
        $router->post('/foods', 'FoodsController@store');
        $router->put('/foods/{id}', 'FoodsController@update');
        $router->delete('/foods/{id}', 'FoodsController@destroy');
    });
});

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

$router->get('/', function () use ($router) {
    return ['message' => 'Welcome to Morbido\'s Api!'];
});

$router->get('/datasets', ['uses' => 'DatasetController@index']);
$router->post('/datasets/columns', ['uses' => 'DatasetController@columns']);
$router->post('/datasets/upload', ['uses' => 'DatasetController@uploadDataset']);

$router->post('/forecasts/sarima', ['uses' => 'ForecastController@sarima']);
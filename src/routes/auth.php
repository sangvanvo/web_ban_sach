<?php

$router->get('/login', 'App\Controllers\AuthController@getLogin');

$router->post('/login', 'App\Controllers\AuthController@postLogin');

$router->get('/signup', 'App\Controllers\AuthController@getSignup');

$router->post('/signup', 'App\Controllers\AuthController@postSignup');

$router->post('/logout', 'App\Controllers\AuthController@postLogout');

$router->get('/forgot-pass', 'App\Controllers\AuthController@getForgotPass');

$router->post('/forgot-pass', 'App\Controllers\AuthController@postForgotPass');

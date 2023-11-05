<?php

$router->get('/profile', 'App\Controllers\ProfileController@index');

$router->post('/profile', 'App\Controllers\ProfileController@postEditProfile');

$router->post('/profile/avatar', 'App\Controllers\ProfileController@postUpdateAvatar');

$router->get('/profile/password', 'App\Controllers\ProfileController@getChangePassword');

$router->post('/profile/password', 'App\Controllers\ProfileController@postChangePassword');

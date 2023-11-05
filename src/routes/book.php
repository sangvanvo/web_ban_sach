<?php

$router->get('/book/detail/(\d+)', 'App\Controllers\BookController@getDetail');
$router->get('/book/search', 'App\Controllers\BookController@getSearch');
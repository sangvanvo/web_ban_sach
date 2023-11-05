<?php

define('SRC_DIR', __DIR__ . '/../src');
define('VIEWS_DIR', __DIR__ . '/../src/views');
define('UPLOAD_DIR', __DIR__ . '/uploads');
define('BASE_URL', 'http://shop.localhost');

require_once SRC_DIR . '/bootstrap.php';

$router = new \Bramus\Router\Router();

require_once SRC_DIR . '/routes/auth.php';
require_once SRC_DIR . '/routes/cart.php';
require_once SRC_DIR . '/routes/admin.php';
require_once SRC_DIR . '/routes/profile.php';
require_once SRC_DIR . '/routes/book.php';

$router->get('/', function () {
    $BookModel = new \App\Models\BookModel();
    $ketqua = $BookModel->getAll();
    $random = $BookModel->getRandom();
    require_once VIEWS_DIR . '/home/index.php';
});

$router->run();

<?php

namespace App\Controllers;

class BookController
{
    public function getDetail(int $id)
    {
        $BookModel = new \App\Models\BookModel();
        $book = $BookModel->getById($id);
        $sptt = $BookModel->getAllByAuthor($book['tac_gia']);
        require_once VIEWS_DIR . '/book/index.php';
    }

    public function getSearch()
    {
        $BookModel = new \App\Models\BookModel();

        $book = $BookModel->getBookByCategory(htmlspecialchars($_GET['tu_khoa']));

        if (!empty($book)) {
            $tukhoa = $book[0]['the_loai'];
            require_once VIEWS_DIR . '/book/search/index.php';
        } else {
            require_once VIEWS_DIR . '/errors/404.php';
            exit;
        }
    }
}

<?php

namespace App\Controllers;

class CartController
{
    public function index()
    {
        try {
            $UserModel = new \App\Models\UserModel();
            $CartModel = new \App\Models\CartModel();

            $email = $_SESSION['email'];
            $user = $UserModel->getByEmail($email);
            $userId = $user['id'];

            $cartList = $CartModel->getList($userId);
            if (empty($cartList)) {
                require_once VIEWS_DIR . '/cart/empty.php';
                exit;
            }

            require_once VIEWS_DIR . '/cart/index.php';
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getList()
    {
        try {
            $UserModel = new \App\Models\UserModel();
            $CartModel = new \App\Models\CartModel();

            if (!isset($_SESSION['email'])) {
                echo json_encode([]);
                exit;
            }
            $email = $_SESSION['email'];

            $user = $UserModel->getByEmail($email);
            $userId = $user['id'];

            $cartList = $CartModel->getList($userId);
            echo json_encode($cartList);
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function postCreate()
    {
        try {
            require_once SRC_DIR . '/config.php';

            $UserModel = new \App\Models\UserModel();
            $CartModel = new \App\Models\CartModel();

            if (!isset($_SESSION['email'])) {
                JsonResponse(error: 2, message: "Vui lòng đăng nhập để tiếp tục");
            }
            $email = $_SESSION['email'];

            if (!isset($_POST['bookId'])) {
                JsonResponse(error: 1, message: "Có lỗi xảy ra! Vui lòng thử lại sau");
            }
            $bookId = htmlspecialchars($_POST['bookId']);

            $user = $UserModel->getByEmail($email);
            $userId = $user['id'];

            $isExist = $CartModel->find($userId, $bookId);
            if (!empty($isExist)) {
                $quantity = (int)$isExist['so_luong'] + 1;
                $isUpdated = $CartModel->update($userId, $bookId, $quantity);
                if (empty($isUpdated)) {
                    JsonResponse(error: 1, message: "Có lỗi xảy ra! Vui lòng thử lại sau");
                }

                JsonResponse(error: 0, message: "Cập nhật số lượng thành công thành công");
            }
            $isSuccess = $CartModel->create($userId, $bookId);
            if (empty($isSuccess)) {
                JsonResponse(error: 1, message: "Có lỗi xảy ra! Vui lòng thử lại sau");
            }

            JsonResponse(error: 0, message: "Thêm sản phẩm thành công");
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function postUpdate($id)
    {
        try {
            require_once SRC_DIR . '/config.php';

            $UserModel = new \App\Models\UserModel();
            $CartModel = new \App\Models\CartModel();

            $bookId = htmlspecialchars($id);
            $email = $_SESSION['email'];

            $user = $UserModel->getByEmail($email);
            $userId = $user['id'];

            $isExist = $CartModel->find($userId, $bookId);
            if (empty($isExist)) {
                JsonResponse(error: 1, message: "Sản phẩm không có tại trong giỏ hàng");
            }

            if (!isset($_POST['quantity'])) {
                JsonResponse(error: 1, message: "Vui lòng nhập số lượng");
            }
            $quantity = htmlspecialchars($_POST['quantity']);

            $isUpdated = $CartModel->update($userId, $bookId, $quantity);
            if (empty($isUpdated)) {
                JsonResponse(error: 1, message: "Có lỗi xảy ra! Vui lòng thử lại sau");
            }

            JsonResponse(error: 0, message: "Cập nhật số lượng thành công thành công");
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function postDelete($id)
    {
        try {
            $UserModel = new \App\Models\UserModel();
            $CartModel = new \App\Models\CartModel();

            $bookId = htmlspecialchars($id);
            $email = $_SESSION['email'];

            $user = $UserModel->getByEmail($email);
            $userId = $user['id'];

            $isDeleted = $CartModel->delete($userId, $bookId);
            if (empty($isDeleted)) {
                JsonResponse(error: 1, message: "Có lỗi xảy ra! Vui lòng thử lại sau");
            }

            JsonResponse(error: 0, message: "Xóa thành công");
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }
}

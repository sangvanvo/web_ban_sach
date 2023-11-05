<?php

namespace App\Controllers;

class AuthController
{
    public function getLogin()
    {
        require_once VIEWS_DIR . '/login/index.php';
    }

    public function postLogin()
    {
        try {
            require_once SRC_DIR . '/config.php';
            $UserModel = new \App\Models\UserModel();

            if (isset($_SESSION['email'])) {
                JsonResponse(error: 0, message: "Đăng nhập thành công");
            }

            if (!isset($_POST['email'])) {
                JsonResponse(error: 1, message: "Vui lòng nhập email");
            }
            $email = htmlspecialchars($_POST['email']);

            if (!isset($_POST['password'])) {
                JsonResponse(error: 1, message: "Vui lòng nhập mật khẩu");
            }
            $password = htmlspecialchars($_POST['password']);

            $user = $UserModel->getInfo($email, $password);
            if (empty($user)) {
                JsonResponse(error: 1, message: "Email hoặc mật khẩu không chính xác");
            }

            $_SESSION['email'] = $user['email'];
            $_SESSION['is_admin'] = $user['is_admin'];
            JsonResponse(error: 0, message: "Đăng nhập thành công");
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getSignup()
    {
        require_once VIEWS_DIR . '/signup/index.php';
    }

    public function postSignup()
    {
        try {
            require_once SRC_DIR . '/config.php';

            $UserModel = new \App\Models\UserModel();

            if (!isset($_POST['email'])) {
                JsonResponse(error: 1, message: "Vui lòng nhập email");
            }
            $email = htmlspecialchars($_POST['email']);

            $user = $UserModel->getByEmail($email);
            if (isset($user['email'])) {
                JsonResponse(error: 1, message: "Email đã được sử dụng!");
            }

            if (!isset($_POST['password'])) {
                JsonResponse(error: 1, message: "Vui lòng nhập mật khẩu");
            }
            $password = htmlspecialchars($_POST['password']);

            $user = $UserModel->create($email, $password);
            if (isset($user)) {
                JsonResponse(error: 0, message: "Đăng ký thành công");
            }

            JsonResponse(error: 1, message: "Lỗi server");
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function postLogout()
    {
        require_once SRC_DIR . '/config.php';
        session_destroy();
        redirect('/login');
    }

    public function getForgotPass()
    {
        require_once VIEWS_DIR . '/forgotPass/index.php';
    }

    function postForgotPass()
    {
        try {
            require_once SRC_DIR . '/config.php';

            $UserModel = new \App\Models\UserModel();
            $random = new \PragmaRX\Random\Random();

            if (!isset($_POST['email'])) {
                JsonResponse(error: 1, message: "Vui lòng nhập email");
            }
            $email = htmlspecialchars($_POST['email']);

            $user = $UserModel->getByEmail($email);
            if (empty($user['email'])) {
                JsonResponse(error: 1, message: "Email Không tồn tại!");
            }

            $newPass = $random->alpha()->size(8)->get();

            $updated = $UserModel->updatePass($email, $newPass);
            if (isset($updated)) {
                JsonResponse(error: 0, message: "Mật khẩu mới: $newPass");
            }
            JsonResponse(error: 1, message: "Lỗi server");
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }
}

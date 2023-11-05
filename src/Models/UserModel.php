<?php

namespace App\Models;

use PDO;

class UserModel
{
    public function getByEmail($email)
    {
        include SRC_DIR . '/config.php';
        $sql = "SELECT * FROM khach_hang WHERE email=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return $user;
    }

    public function getInfo($email, $password)
    {
        include SRC_DIR . '/config.php';

        $sql = "SELECT * FROM khach_hang WHERE email=? AND mat_khau=?";
        $stmt = $conn->prepare($sql);
        $password = md5($password);
        $stmt->execute([$email, $password]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function create($email, $password)
    {
        include SRC_DIR . '/config.php';

        $sql = "INSERT INTO khach_hang(email, mat_khau) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $password = md5($password);
        $stmt->execute([$email, $password]);
        return $stmt->rowCount() === 1;
    }

    public function updatePass($email, $password)
    {
        include SRC_DIR . '/config.php';
        $sql = "UPDATE khach_hang SET mat_khau = ? WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $password = md5($password);
        $stmt->execute([$password, $email]);
        return $stmt->rowCount() === 1;
    }

    public function updateAvatar($id, $avatar)
    {
        include SRC_DIR . '/config.php';
        $sql = "UPDATE khach_hang SET avatar = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([BASE_URL . '/uploads/' . $avatar, $id]);
        return $stmt->rowCount() === 1;
    }

    public function updateProfile($id, $name, $phone, $address)
    {
        include SRC_DIR . '/config.php';
        $sql = "UPDATE khach_hang SET ho_ten=?, so_dien_thoai=?, dia_chi=? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$name, $phone, $address, $id]);
        return $stmt->rowCount() === 1;
    }
}

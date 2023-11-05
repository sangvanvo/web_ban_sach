<?php

namespace App\Models;

use PDO;

class CartModel
{
    public function getSize($userId)
    {
        include SRC_DIR . '/config.php';
        $sql = "SELECT COUNT(*) quantity FROM gio_hang WHERE id_kh=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$userId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['quantity'];
    }

    public function getList($userId)
    {
        include SRC_DIR . '/config.php';
        $sql = "SELECT ten_sach, anh_bia, gia_sale, gia_goc, id_sach, so_luong FROM gio_hang gh JOIN sach s ON s.id = gh.id_sach WHERE id_kh=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$userId]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function create($userId, $bookId)
    {
        include SRC_DIR . '/config.php';
        $sql = "INSERT INTO gio_hang(id_kh, id_sach, so_luong) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$userId, $bookId, 1]);
        return $stmt->rowCount() === 1;
    }

    public function find($userId, $bookId)
    {
        include SRC_DIR . '/config.php';
        $sql = "SELECT * FROM gio_hang WHERE id_kh=? AND id_sach=? ";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$userId, $bookId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    public function update($userId, $bookId, $quantity)
    {
        include SRC_DIR . '/config.php';
        $sql = "UPDATE gio_hang SET so_luong=? WHERE id_kh=? AND id_sach=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$quantity, $userId, $bookId]);
        return $stmt->rowCount() === 1;
    }

    public function delete($userId, $bookId)
    {
        include SRC_DIR . '/config.php';
        $sql = "DELETE FROM gio_hang WHERE id_kh=? AND id_sach=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$userId, $bookId]);
        return $stmt->rowCount() === 1;
    }
}

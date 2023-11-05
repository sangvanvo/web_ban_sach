<?php

function redirect(string $location): void
{
    header("Location: $location", true, 302);
    exit;
}

function JsonResponse($error, $message)
{
    echo json_encode([
        "error" => $error,
        "message" => $message
    ]);
    exit;
}

function isAdmin()
{
    return (int)$_SESSION['is_admin'] === 1;
}

function isAuthentication()
{
    return $_SESSION['email'];
}

function handle_img_upload($img, $isMultiple = false)
{
    if (!isset($_FILES[$img])) {
        return false;
    }

    if ($isMultiple) {
        $book_imgs = [];
        $files = $_FILES[$img];

        foreach ($files["tmp_name"] as $key => $img_tmp_name) {
            $file = $_FILES[$img];
            $file_name = $file['name'][$key];
            $file_size = $file['size'][$key];
            $file_error = $file['error'][$key];

            $file_name_arr = explode('.', $file_name);
            $ext = end($file_name_arr);

            if (!isAllowFile($file_error, $ext, $file_size)) {
                return false;
            }

            $file_new_name = md5(uniqid()) . '.' . $ext;
            $file_destination = UPLOAD_DIR . '/' . $file_new_name;

            if (move_uploaded_file($img_tmp_name, $file_destination)) {
                array_push($book_imgs, $file_new_name);
            }
        }

        return $book_imgs;
    }

    $file = $_FILES[$img];
    $file_name = $file['name'];
    $file_tmp_name = $file['tmp_name'];
    $file_size = $file['size'];
    $file_error = $file['error'];

    $file_name_arr = explode('.', $file_name);
    $ext = end($file_name_arr);

    if (!isAllowFile($file_error, $ext, $file_size)) {
        return false;
    }

    $img_new_name = md5(uniqid()) . '.' . $ext;
    $img_destination = UPLOAD_DIR . '/' . $img_new_name;

    if (move_uploaded_file($file_tmp_name, $img_destination)) {
        return $img_new_name;
    }
    return false;
}

function isAllowFile($file_error, $ext, $file_size)
{
    $allow_file_exts = ['png', 'jpg', 'jpeg', 'gif'];
    $allow_file_size = 10 * 1024 * 1024; // 10MB
    if ($file_error !== 0 || !in_array($ext, $allow_file_exts) || ($file_size > $allow_file_size)) {
        return false;
    }
    return true;
}

function remove_img_file($filename)
{
    $old_img_file = realpath(UPLOAD_DIR . '/' . $filename);
    if (file_exists($old_img_file)) {
        return unlink($old_img_file);
    }
    return false;
}

function extractFileNameFromUrl($url)
{
    $fileNameArr = explode(BASE_URL . '/uploads/', $url);
    $fileName = end($fileNameArr);
    return $fileName;
}

function format_money($amount)
{
    return number_format($amount, 0, '.', '.') . '' . '₫';
}

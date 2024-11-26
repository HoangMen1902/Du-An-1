<?php

namespace Src\Validations\Client;

use Src\models\Client\CommentModel;
use Src\Notifications\Notification;

class CommentValidation
{
    public static function commentValidation($data)
{
    $is_valid = true;


    if (!isset($data['content']) || trim($data['content']) === '') {
        Notification::error('Lỗi', 'Nội dung bình luận không được để trống');
        $is_valid = false;
    } elseif (strlen($data['content']) > 500) {
        Notification::error('Lỗi', 'Độ dài bình luận không được vượt quá 500 ký tự');
        $is_valid = false;
    }

   
    if (isset($data['parent_id']) && !is_numeric($data['parent_id'])) {
        Notification::error('Lỗi', 'ID bình luận cha không hợp lệ');
        $is_valid = false;
    }

  

    if (!isset($_SESSION['user'])) {
        $is_valid = false;
        header('location: /login');
        Notification::error('Chưa đăng nhập', 'Vui lòng đăng nhập để bình luận');
    }

    if ($is_valid === false) {
        return false;
    }

    return true;
}

    
}

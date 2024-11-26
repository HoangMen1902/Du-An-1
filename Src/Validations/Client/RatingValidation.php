<?php

namespace Src\Validations\Client;

use Src\Notifications\Notification;

class RatingValidation
{
    public static function validateRatingInput($data)
    {
        $is_valid = true;

     
        if (isset($data['preview']) && strlen($data['preview']) > 500) {
            Notification::error('Lỗi', 'Độ dài nhận xét không được vượt quá 500 ký tự');
            $is_valid = false;
        }

   
        if (!isset($data['rating_value']) || !is_numeric($data['rating_value']) || $data['rating_value'] < 1 || $data['rating_value'] > 5) {
            Notification::error('Lỗi', 'Điểm đánh giá phải là số và nằm trong khoảng từ 1 đến 5');
            $is_valid = false;
        }

     
        if (!isset($_SESSION['user'])) {
            Notification::error('Chưa đăng nhập', 'Vui lòng đăng nhập để đánh giá');
            $is_valid = false;
            header('Location: /login');
        }

        return $is_valid;
    }
}

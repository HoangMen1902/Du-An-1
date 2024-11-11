<?php

namespace Src\Validations\Client;

use Src\Models\Admin\UserModel;

class UserValidation
{
    public static function userValidation($data)
    {
        $is_valid = true;
        $errors = [];

        if (!isset($data['firstname']) || !isset($data['lastname'])) {
            $errors[] = ['code' => 1, 'name' => 'vui lòng nhập đầy đủ họ và tên'];
            $is_valid = false;
        } else {
            if (strlen($data['firstname']) > 50 || strlen($data['lastname']) > 50) {
                $errors[] = ['code' => 2, 'name' => 'Độ dài họ và tên không được lớn hơn 50 ký tự'];
                $is_valid = false;
            }
        }

        if (!isset($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = ['code' => 4, 'name' => 'Định dạng email không đúng'];
            $is_valid = false;
        } else {
            $UserModel = new UserModel();
            if ($UserModel->findDuplicateUsersByColumn('email', $data['email'])) {
                $errors[] = ['code' => 3, 'name' => 'Email đã tồn tại'];
                $is_valid = false;
            }
        }

        if (!isset($data['password']) || !isset($data['passwordhash'])) {
            $errors[] = ['code' => 5, 'name' => 'Mật khẩu không được để trống '];
            $is_valid = false;
        } elseif ($data['password'] !== $data['passwordhash']) {
            $errors[] = ['code' => 6, 'name' => 'Mật khẩu không trùng khớp'];
            $is_valid = false;
        }

        if ($is_valid === false) {
            return $errors;
        }

        return true;
    }
}

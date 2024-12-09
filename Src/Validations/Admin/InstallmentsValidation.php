<?php

namespace Src\Validations\Admin;

use Src\Models\Admin\InstallmentsModel;


class InstallmentsValidation
{
    // Kiểm tra danh mục cha
    public static function InstallmentsValidation($data)
    {
        $is_valid = true;
        $errors = [];

        if (empty($data['sku_id'])) {
            $is_valid = false;
            $errors[] = "Mã sản phẩm không được để trống.";
        }

        if (empty($data['interest_rate'])) {
            $is_valid = false;
            $errors[] = "Lãi suất không được để trống.";
        } elseif (!is_numeric($data['interest_rate']) || $data['interest_rate'] <= 0 && $data['interest_rate'] >= 100) {
            $is_valid = false;
            $errors[] = "Lãi suất phải từ 0 - 100%.";
        }

        if (empty($data['term'])) {
            $is_valid = false;
            $errors[] = "Kỳ hạn không được để trống.";
        }

    
        return $is_valid ? true : $errors;
    }
}

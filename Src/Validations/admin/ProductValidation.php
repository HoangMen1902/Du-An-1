<?php
namespace Src\Validations\Admin;

class ProductValidation {
    public static function productValidation($data) {
        $is_valid = true;
        $errors = [];

        if (strlen($data['name']) > 100 || empty($data['name'])) {
            $is_valid = false;
            $errors['name'] = "Tên sản phẩm không được để trống và phải dưới 100 ký tự.";
        }

        if (strlen($data['description']) > 500) {
            $is_valid = false;
            $errors['description'] = "Mô tả sản phẩm phải dưới 500 ký tự.";
        }

        if (!is_numeric($data['total_quantity']) || (int)$data['total_quantity'] <= 0) {
            $is_valid = false;
            $errors['total_quantity'] = "Số lượng tổng phải là một số hợp lệ và lớn hơn 0.";
        }

        if (empty($data['brand'])) {
            $is_valid = false;
            $errors['brand'] = "Thương hiệu không được để trống.";
        }

        if (!is_numeric($data['discount']) || (int)$data['discount'] < 0 || (int)$data['discount'] > 100) {
            $is_valid = false;
            $errors['discount'] = "Giá giảm phải là số từ 0 đến 100.";
        }

        if (!in_array($data['status'], [1, 2])) {
            $is_valid = false;
            $errors['status'] = "Trạng thái không hợp lệ.";
        }

        if ($is_valid === true) {
            return true;
        }
        
        return $errors;
    }
}

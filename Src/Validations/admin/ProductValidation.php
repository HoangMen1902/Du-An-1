<?php
namespace Src\Validations\Admin;

use Src\Models\Admin\ProductModel;

class ProductValidation {
    public static function productValidation($data, $id = null) {
        $is_valid = true;
        $errors = [];

        if (!is_array($data)) {
            $data = [];
        }

        $productModel = new ProductModel();

        if (empty($data['name'])) {
            $is_valid = false;
            $errors['name'] = "Tên sản phẩm không được để trống.";
        } else {
            if ($id && $data['name'] !== $productModel->getOneProduct($id)['name'] && $productModel->isNameDupliProductByColumn($data['name'])) {
                $is_valid = false;
                $errors['name'] = "Tên sản phẩm đã tồn tại.";
            } elseif (!$id && $productModel->isNameDupliProductByColumn($data['name'])) {
                $is_valid = false;
                $errors['name'] = "Tên sản phẩm đã tồn tại.";
            }
        }

        if (isset($data['name']) && strlen($data['name']) > 100) {
            $is_valid = false;
            $errors['name'] = "Tên sản phẩm phải dưới 100 ký tự.";
        }

        if (isset($data['description']) && strlen($data['description']) > 500) {
            $is_valid = false;
            $errors['description'] = "Mô tả sản phẩm phải dưới 500 ký tự.";
        }



        if (empty($data['brand_id'])) {
            $is_valid = false;
            $errors['brand'] = "Thương hiệu không được để trống.";
        }

        if (isset($data['discount']) && (!is_numeric($data['discount']) || (int)$data['discount'] < 0 || (int)$data['discount'] > 100)) {
            $is_valid = false;
            $errors['discount'] = "Giá giảm phải là số từ 0 đến 100.";
        }

        if (isset($data['status']) && !in_array($data['status'], [1, 2])) {
            $is_valid = false;
            $errors['status'] = "Trạng thái không hợp lệ.";
        }

        return $is_valid ? true : $errors;
    }
}


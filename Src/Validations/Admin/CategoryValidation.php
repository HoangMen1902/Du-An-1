<?php
namespace Src\Validations\Admin;

use Src\Models\Admin\CategoryModel;

class CategoryValidation {
    public static function categoryValidation($data) {
        $is_valid = true;
        $errors = [];

        if (empty($data['name'])) {
            $is_valid = false;
            $errors[] = "Tên phân loại không được để trống";
        } else {
            $categoryModel = new CategoryModel();
            if ($categoryModel->isNameDuplicate($data['name'])) {
                $is_valid = false;
                $errors[] = "Tên phân loại đã tồn tại";
            }
        }

        if (!$is_valid) {
            return $errors;
        }

        return true;
    }
}


?>

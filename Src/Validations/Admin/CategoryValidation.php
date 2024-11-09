<?php

namespace Src\Validations\Admin;

use Src\Models\Admin\CategoryModel;
use Src\Models\Admin\CategoryValueModel;


class CategoryValidation
{
    // Kiểm tra danh mục cha
    public static function categoryValidation($data)
    {
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
    // Kiểm tra danh mục con
    public static function categoryValueValidation($data, $id = null)
    {
        $is_valid = true;
        $errors = [];

        if (empty($data['name'])) {
            $is_valid = false;
            $errors[] = "Tên danh mục con không được để trống.";
        } else {
            $categoryValueModel = new CategoryValueModel();

            if ($id && $data['name'] !== $categoryValueModel->getOneCategoryValue($id)['name'] && $categoryValueModel->isNameDuplicate($data['name'], $data['category_id'], $id)) {
                $is_valid = false;
                $errors[] = "Tên danh mục con đã tồn tại trong danh mục cha này.";
            }
        }

        if (empty($data['category_id'])) {
            $is_valid = false;
            $errors[] = "Danh mục cha không được để trống.";
        }

        return $is_valid ? true : $errors;
    }
}

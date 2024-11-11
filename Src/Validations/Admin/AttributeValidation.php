<?php

namespace Src\Validations\Admin;

use Src\Models\Admin\AttributeModel;

class AttributeValidation
{
    public static function attributeValidation($data)
    {
        $is_valid = true;
        $errors = [];

        if (empty($data['name'])) {
            $is_valid = false;
            $errors[] = "Tên thuộc tính không được để trống";
        } else {
            $attributeModel = new AttributeModel();
            
            if ($attributeModel->isNameDupliAttributeByColumn($data['name'])) {
                $is_valid = false;
                $errors[] = "Tên thuộc tính đã tồn tại";
            }
        }

        return $is_valid ? true : $errors;
    }

    public static function editAttributeValidation($data, $id)
    {
        $is_valid = true;
        $errors = [];

        if (empty($data['name'])) {
            $is_valid = false;
            $errors[] = "Tên thuộc tính không được để trống";
        } else {
            $attributeModel = new AttributeModel();
            
            $existingAttribute = $attributeModel->getOneAttribute($id);
            if ($existingAttribute && $existingAttribute['name'] !== $data['name'] && $attributeModel->isNameDupliAttributeByColumn($data['name'])) {
                $is_valid = false;
                $errors[] = "Tên thuộc tính đã tồn tại";
            }
        }

        return $is_valid ? true : $errors;
    }
}

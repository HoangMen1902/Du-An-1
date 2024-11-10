<?php

namespace Src\Validations\Admin;

class BrandValidation {
    public static function brandValidation($data) {
        $is_valid = true;

        foreach($data as $input) {
            if( is_null($input) || empty($input)) {
                $is_valid = false;
            }
        }

        if(!$is_valid) {
            return false;
        } 
        return true;
    }

}
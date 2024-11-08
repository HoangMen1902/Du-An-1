<?php
namespace Src\Validations\Admin;

class UserValidation {
    public static function userValidation($data) {
        $is_valid = true;
        $errors = [];

        if(!isset($data['firstName']) || !isset($data['lastName']) || !isset($data['username'])) {
            $errors = ['code' => 1, 'name' => 'required_input'];
            $is_valid = false;
        } else{
            if(strlen($data['firstName']) > 50 || strlen($data['lastName'])  > 50  || strlen($data['username'])  > 50) {
                $errors = ['code' => 2, 'name' => 'invalid_data'];
                $is_valid = false;
            }
        };
        if(isset($data['phone']) && strlen($data['phone']) > 10) {
            $errors = ['code' => 2, 'name' => 'invalid_data'];
            $is_valid = false;
        }

        if($is_valid === false) {
            return $errors;
        }
        return true;
    }
}
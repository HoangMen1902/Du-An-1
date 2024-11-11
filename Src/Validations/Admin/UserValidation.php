<?php
namespace Src\Validations\Admin;

use Src\Models\Admin\UserModel;

class UserValidation {
    public static function userValidation($data) {
        $is_valid = true;
        $errors = [];
        
        if(!isset($data['firstName']) || !isset($data['lastName'])) {
            $errors += ['code' => 1, 'name' => 'required_input'];
            $is_valid = false;
        } else{
            if(strlen($data['firstName']) > 50) {
                $errors += ['code' => 2, 'name' => 'invalid_data'];
                $is_valid = false;
            }
        };
        if(isset($data['phone']) && strlen($data['phone']) > 10) {
            $errors += ['code' => 2, 'name' => 'invalid_data'];
            $is_valid = false;
        }


        $UserModel = new UserModel();


        if($UserModel->findDuplicateUsersByColumn('email', $data['email'])) {
            $errors += ['code' => 3, 'name' => 'duplicate_email'];
            $is_valid = false;
        }

        
        if($is_valid === false) {
            return $errors;
        }

        
        return true;
    }
    public static function updateUserValidation($data, $id) {
        $is_valid = true;
        $errors = [];
        
        if(!isset($data['firstName']) || !isset($data['lastName'])) {
            $errors += ['code' => 1, 'name' => 'required_input'];
            $is_valid = false;
        } else{
            if(strlen($data['firstName']) > 50 || strlen($data['lastName'])  > 50) {
                $errors += ['code' => 2, 'name' => 'invalid_data'];
                $is_valid = false;
            }
        };
        if(isset($data['phone']) && strlen($data['phone']) > 10) {
            $errors += ['code' => 2, 'name' => 'invalid_data'];
            $is_valid = false;
        }


        $UserModel = new UserModel();

        if($UserModel->findDuplicateUsersForUpdate('email', $data['email'], $id)) {
            $errors += ['code' => 3, 'name' => 'duplicate_email'];
            $is_valid = false;
        }

        if($is_valid === false) {
            return $errors;
        }

        
        return true;
    }
}
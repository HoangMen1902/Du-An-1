<?php
namespace Src\Validations\Admin;

class UserValidation {
    public static function userValidation($data) {
        $is_valid = true;
        if(strlen($data['firstName']) > 50 || strlen($data['lastName'])  > 50  || strlen($data['username'])  > 50 
        || $data['firstName'] === Null || $data['lastName'] === Null || $data['username']  === null ) {
            $is_valid = false;
            echo '<pre>';
            var_dump($data['lastName']  > 50  );

        }

        if(strlen($data['phone']) > 10) {
            var_dump($data['phone']);
            $is_valid = false;
        }

        if($is_valid === true) {
            return true;
        }
        return false;
    }
}
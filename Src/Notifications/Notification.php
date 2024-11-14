<?php
namespace Src\Notifications;
use Src\Controllers\BaseController;
use League\Plates\Engine;
class Notification {    

    public static function success($name, $message) {
        $_SESSION['success']['name'] = $name;
        $_SESSION['success']['message'] = $message;
    }

    public static function error($name, $message) {
        $_SESSION['error']['name'] = $name;
        $_SESSION['error']['message'] = $message;


    }

    public static function unset() {
        unset($_SESSION['error']);
        unset($_SESSION['success']);
    }
}
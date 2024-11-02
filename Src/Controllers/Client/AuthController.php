<?php
namespace Src\Controllers\Client;

use Src\Controllers\BaseController;

class AuthController extends BaseController {
    public function login() {
        echo $this->view->render('Client/Pages/Login');
    }
}
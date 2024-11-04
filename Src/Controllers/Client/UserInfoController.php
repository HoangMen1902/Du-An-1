<?php

namespace Src\Controllers\Client;

use Src\Controllers\BaseController;

class UserInfoController extends BaseController{
    public function myAccount() {
        echo $this->view->render('Client/Pages/MyAccount');
    }
    public function changePassword() {
        echo $this->view->render('Client/Pages/UserChangePassword');
    }

    public function address() {
        echo $this->view->render('Client/Pages/UserAddressManage');
    }

    public function userOrders() {
        echo $this->view->render('Client/Pages/UserOrders');
    }
}
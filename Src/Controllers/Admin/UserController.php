<?php
namespace Src\Controllers\Admin;

use Src\Controllers\BaseController;

class UserController extends BaseController {
    public function show() {
        echo $this->view->render('Admin/Pages/Users/UsersList');
    }

    public function add(){
        echo $this->view->render('Admin/Pages/Users/UserAdd');
    }
    public function edit(){
        echo $this->view->render('Admin/Pages/Users/UserEdit');
    }
}
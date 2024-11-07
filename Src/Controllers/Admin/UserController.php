<?php
namespace Src\Controllers\Admin;

use Laracasts\Flash\Flash;
use Src\Controllers\BaseController;
use Src\Models\Admin\UserModel;
use Src\Validations\Admin\UserValidation;

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

    public function store() {
        $data = NULL;
        foreach($_POST as $input => $value) {
            if(!empty($value)) {
                $data[$input] = $value;
            }
        }
        
        $data_validate = UserValidation::userValidation($data);
        if( $data_validate ) {
            $UserModel = new UserModel();
            $result = $UserModel->store($data);
            if($result) {
                header('location: /admin/create-user?status=success');
                exit();
            } else {
                header('location: /admin/create-user?status=failed');
                exit();
            }
        }
    }
}
<?php

namespace Src\Controllers\Admin;

use Laracasts\Flash\Flash;
use Src\Controllers\BaseController;
use Src\Models\Admin\UserModel;
use Src\Validations\Admin\UserValidation;

class UserController extends BaseController
{
    public function show()
    {
        $userModel = new UserModel();
        $data = $userModel->showAll();
        echo $this->view->render('Admin/Pages/Users/UsersList', ['data' => $data]);
    }

    public function add()
    {
        echo $this->view->render('Admin/Pages/Users/UserAdd');
    }
    public function edit($id)
    {
        $UserModel = new UserModel();
        $data = $UserModel->getOne($id['id']);
        if(isset($data) && !empty($data)) {
            echo $this->view->render('Admin/Pages/Users/UserEdit', ['data' => $data]);
        }

    }



    public function store()
    {
        $data = NULL;
        foreach ($_POST as $input => $value) {
            if (!empty($value) || $value === null) {
                if($input === 'password') {
                    $value = password_hash($value, PASSWORD_DEFAULT);
                }
                $data[$input] = $value;
            }
        }

        $data_validate = UserValidation::userValidation($data);
        if ($data_validate === true) {
            $UserModel = new UserModel();
            $result = $UserModel->store($data);
            if ($result) {
                header('location: /admin/create-user?status=success');
                exit();
            } else {
                header('location: /admin/create-user?status=failed');
                exit();
            }
        } else {
            header('location: /admin/create-user?status=failed&error=' . $data_validate['code'] . '&name=' . $data_validate['name']);
            exit();
        }
    }

    public function search() {
        header('Content-Type: application/json');
        $user = $_POST['user'];
        $userModel = new UserModel();
        $result = $userModel->searchUser($user);
        echo json_encode($result);
    }

    public function update($params) {
        $id = $params['id'];
        $data = [];
        foreach ($_POST as $input => $value) {
            if (!empty($value) || $value === null) {
                $data[$input] = $value;
            }
        }

        unset($data['password']);


        $UserModel = new UserModel();
        $result = $UserModel->update($id, $data);
        if($result != false) {
            header('location: /admin/users?status=success');
        } else {
            header('location: /admin/users?status=failed');
        }
    }


    public function locked() {
        $userModel = new UserModel();
        $data = $userModel->getLockedUsers();
        echo $this->view->render('Admin/Pages/Users/UserLocked', ['data' => $data]);
    }

    public function delete($params) {
        header('Content-Type: application/json');
        $id = $params['id'];
        $userModel = new UserModel();
        $result = $userModel->deleteUser($id);
        if($result !== false) {
            $data = $userModel->getLockedUsers();
            $data = json_encode($data);
            echo $data;
        } else {
            header('location: /admin/locked-account?action=delete&status=failed');
        }
    }

    public function lockUser($params) {

        $id = $params['id'];
        $user_data = ['status' => 2];
        $userModel = new UserModel();
        $result = $userModel->updateUser($id, $user_data);
        if($result) {
            header('location: /admin/users?action=lock-user?status=success');
        } else {
            header('location: /admin/users?action=lock-user?status=failed');
        }
    }
}

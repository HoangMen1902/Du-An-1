<?php

namespace Src\Controllers\Admin;

use Laracasts\Flash\Flash;
use Src\Controllers\BaseController;
use Src\Models\Admin\UserModel;
use Src\Notifications\Notification;
use Src\Validations\Admin\UserValidation;

class UserController extends BaseController
{

    public function showOrders($params)
    {
        $id = $params['id'];

        $UserModel = new UserModel();
        $orders = $UserModel->getUserOrders($id);

        if ($orders !== false) {
            if (count($orders) > 0) {
                echo json_encode($orders);
            } else {
                echo json_encode('Người dùng chưa có đơn hàng nào tại BeeTechNova');
            }
        } else {
            echo json_encode('Đã có lỗi xảy ra khi lấy đơn hàng của người dùng này');
            exit();
        }
    }
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
        if (isset($data) && !empty($data)) {
            echo $this->view->render('Admin/Pages/Users/UserEdit', ['data' => $data]);
        }
    }



    public function store()
    {
        $data = NULL;
        foreach ($_POST as $input => $value) {
            if (!empty($value) || $value === null) {
                if ($input === 'password') {
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
                Notification::success('Thành công', 'đã thêm thành công');
                header('location: /admin/create-user?status=success');
                exit();
            } else {
                Notification::error('Lỗi', 'có lỗi xảy ra khi thêm');

                header('location: /admin/create-user?status=failed&code=' . $result['code'] . '&error=' . $result['name']);
                exit();
            }
        } else {
            Notification::error('Lỗi', 'có lỗi xảy ra khi thêm');

            header('location: /admin/create-user?status=failed&error=' . $data_validate['code'] . '&name=' . $data_validate['name']);
            exit();
        }
    }

    public function search()
    {
        header('Content-Type: application/json');
        $user = $_POST['user'];
        $userModel = new UserModel();
        $result = $userModel->searchUser($user);
        echo json_encode($result);
    }

    public function update($params)
    {
        $id = $params['id'];
        $data = [];
        foreach ($_POST as $input => $value) {
            if (!empty($value) || $value === null) {
                $data[$input] = $value;
            }
        }

        unset($data['password']);


        $data_validate = UserValidation::updateUserValidation($data, $id);
        if ($data_validate === true) {
            $UserModel = new UserModel();
            $result = $UserModel->update($id, $data);
            if ($result) {
                Notification::success('Thành công', 'đã sửa thành công');

                header('location: /admin/users?status=success');
                exit();
            } else {
                Notification::error('Lỗi', 'có lỗi xảy ra khi sửa');

                header('location: /admin/users?status=failed&');
                exit();
            }
        } else {
            Notification::error('Lỗi', 'có lỗi xảy ra khi sửa');

            header('location: /admin/users?status=failed&error=' . $data_validate['code'] . '&name=' . $data_validate['name']);
            exit();
        }
    }


    public function locked()
    {
        $userModel = new UserModel();
        $data = $userModel->getLockedUsers();
        echo $this->view->render('Admin/Pages/Users/UserLocked', ['data' => $data]);
    }

    public function delete($params)
    {
        header('Content-Type: application/json');
        $id = $params['id'];
        $userModel = new UserModel();
        $result = $userModel->deleteUser($id);
        if ($result !== false) {
            $data = $userModel->getLockedUsers();
            $data = json_encode($data);
            echo $data;
        } else {
            Notification::error('Lỗi', 'có lỗi xảy ra khi sửa');
            header('location: /admin/locked-account?action=delete&status=failed');
        }
    }

    public function lockUser($params)
    {

        $id = $params['id'];
        $user_data = ['status' => 2];
        $userModel = new UserModel();
        $result = $userModel->updateUser($id, $user_data);
        if ($result) {
            Notification::success('Khóa thành công', 'Đã khóa thành công');
            header('location: /admin/users?action=lock-user?status=success');
        } else {
            Notification::error('Khóa thất bại', 'Khóa người dùng thất bại');

            header('location: /admin/users?action=lock-user?status=failed');
        }
    }
}

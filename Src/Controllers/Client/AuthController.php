<?php
namespace Src\Controllers\Client;

use Src\Controllers\BaseController;
use Src\Models\Client\UserModel;
use Src\Notifications\Notification;
use Src\Validations\Client\UserValidation;

class AuthController extends BaseController {
    public function login() {
        echo $this->view->render('Client/Pages/Login');
    }

    public function register() {
        echo $this->view->render('Client/Pages/Register');
    }

    public function store() {
        $data = [
            'firstname' => $_POST['firstname'] ?? null,
            'lastname' => $_POST['lastname'] ?? null,
            'email' => $_POST['email'] ?? null,
            'password' => $_POST['password'] ?? null,
            'passwordhash' => $_POST['passwordhash'] ?? null
        ];

        // Kích hoạt validation
        $validation = UserValidation::userValidation($data);
        if ($validation !== true) {
            // Hiển thị form đăng ký với các lỗi
            echo $this->view->render('Client/Pages/Register', ['errors' => $validation]);
            return;
        }

        // Nếu validation thành công, băm mật khẩu và tạo tài khoản
        $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);

        $userData = [
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'password' => $hashedPassword,
            'status' => 1 
        ];

        $userModel = new UserModel();
        $isCreated = $userModel->store($userData);

        if ($isCreated) {
            Notification::success('Đăng ký thành công', 'Bạn đã đăng ký thành công');
            header('Location: /login?status=success');
            exit;
        } else {
            Notification::error('Đăng ký thất bại', 'Có lỗi đã xảy ra');

            header('Location: /register?status=failed');
        }
    }

    public function authLogin() {
        $email = $_POST['email'];
        $userModel = new UserModel();
        $user = $userModel->findUserForLogin('email',$email);
        if($user) {
            if(password_verify($_POST['password'], $user['password'])) {
                Notification::success('Đăng nhập thành công', 'Bạn đã đăng nhập thành công');
                $_SESSION['user']['name'] = $user['firstname'] . ' ' . $user['lastname'];
                $_SESSION['user']['id'] = $user['id'];
                $_SESSION['user']['role'] = $user['role'];
                $_SESSION['user']['status'] = $user['status'];

                header('location: /home');
                exit();
            } else {
                Notification::error('Đăng nhập thất bại', 'Thông tin đăng nhập không chính xác');
                header('location: /login');
                exit();
            }
        } else {
            Notification::error('Đăng nhập thất bại', 'Thông tin đăng nhập không chính xác');
            header('location: /login');
            exit();
        }
    }
}

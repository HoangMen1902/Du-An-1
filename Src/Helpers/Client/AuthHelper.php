<?php 
 namespace Src\Helpers\Client;
 use Src\Models\Client\UserModel;
 use Src\Notifications\Notification;

 class AuthHelper{
    public static function checkExistedInfo($column, $info)
    {
        $UserModel = new UserModel();
        $result = $UserModel->getOneUserByInfo($column, $info);
        if (empty($result)) {
            return false;
        } else {
            return $result;
        }
    }

    public static function updateSession($id)
    {
        $UserModel = new UserModel();
        $result = $UserModel->getUserById($id);
        $data = [
            'id' => $result['id'],
            'fullname' => $result['fullname'],
            'firstname' => $result['firstname'],
            'lastname' => $result['lastname'],
            'email' => $result['email'],
            'phone' => $result['phone'],
        ];
        if ($result) {
            $_SESSION['user'] = $result;
        }
    }

    public static function register($data)
    {
        $user = new UserModel();
        $result = $user->create($data);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    public static function updateCookie($id)
    {
        $UserModel = new UserModel();
        $result = $UserModel->getUserById($id);
        if ($result) {
            $userData = json_encode($result);
            setcookie('user', $userData, time() + 3600 * 24 * 30 * 12, '/');
        }
    }

    public static function logout(){
        unset($_SESSION['user']);
    }

    public static function middleware()
    {
        $admin = explode('/', $_SERVER['REQUEST_URI']);
        $admin = $admin[1];

        if ($admin == 'admin') {
            if (!isset($_SESSION['user'])) {
                Notification::error('Admin', 'Vui lòng đăng nhập');
                header('location: /login');
                exit;
            }
            if ($_SESSION['user']['role'] != 2) {
                Notification::error('Admin', 'Tài khoản không có quyền truy cập');
                header('location: /home');
                exit;
            }
            
        }


    }

    public static function update($data)
    {
        $UserModel = new UserModel();
        $result = $UserModel->updateUserInfo($_SESSION['user']['id'], $data);
        if ($result) {
            Notification::success('Cập nhật thông tin người dùng', 'Đã cập nhật thông tin tài khoản');
            self::updateCookie($_SESSION['user']['id']);
            self::updateSession($_SESSION['user']['id']);
            return true;
        } else {
            Notification::error('Cập nhật thông tin người dùng', 'Cập nhật thông tin tài khoản thất bại, số điện thoại đã tồn tại');
            return false;
        }
    }

    public static function checkInformation($data)
    {
        if (isset($_SESSION['user']['id'])) {
            $user = new UserModel();
            $user_id = $_SESSION['user']['id'];

            $result = $user->getOneUserByEmail($data['email']);
            if ($result && $result['id'] != $user_id) {
                Notification::error('email_existed', 'Email đã tồn tại');
                return false;
            }
            return true;
        } else {
            $user = new UserModel();

            $result = $user->getOneUserByEmail($data['email']);
            if ($result) {
                Notification::error('email_existed', 'Email đã tồn tại');
                return false;
            }
            return true;
        }
    }
    public static function updatePassword($data)
    {
        $currentPassword = $data['currentPassword'];
        $newPassword = $data['newPassword'];
        $confirmPassword = $data['confirmPassword'];
        $newPasswordHash = password_hash($data['newPassword'], PASSWORD_DEFAULT);

        $UserModel = new UserModel();
        $userData = $UserModel->getUserById($_SESSION['user']['id']);
        echo '<pre>';

        if (!password_verify($currentPassword, $userData['password'])) {
            Notification::error('Đổi mật khẩu', 'Mật khẩu hiện tại không đúng');
            return false;
        }


        if (strcmp($newPassword, $confirmPassword) !== 0) {
            Notification::error('Đổi mật khẩu', 'Mật khẩu xác nhận không trùng khớp');
            return false;

        }

        $result = $UserModel->updatePassword($_SESSION['user']['id'], ['password' => $newPasswordHash]);
        if ($result) {
            Notification::success('Đổi mật khẩu', 'Đã cập nhật mật khẩu thành công');
            return true;
        } else {
            Notification::error('Đổi mật khẩu', 'Cập nhật mật khẩu thất bại');
            return false;
        }
    }
 }
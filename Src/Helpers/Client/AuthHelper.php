<?php 
 namespace Src\Helpers\Client;
 use Src\Models\Client\UserModel;

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
            'firstName' => $result['firstName'],
            'lastName' => $result['lastName'],
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
 }
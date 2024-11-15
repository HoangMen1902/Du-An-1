<?php
namespace Src\Controllers\Client;

use Src\Controllers\BaseController;
use Src\Models\Client\UserModel;
use Src\Notifications\Notification;
use Src\Validations\Client\UserValidation;
use Src\Helpers\Client\AuthHelper;
use Google\Client;
use Google\Service;
use Google\Service\Oauth2;
use Exception;

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
            Notification::error('Đăng ký thất bại', 'Email đã tồn tại');

            header('Location: /register?status=failed');
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
    public function loginGoogle()
    {
        $client = new Client();

        $client->setClientId($_ENV['GOOGLE_CLIENT_ID']);
        $client->setClientSecret($_ENV['GOOGLE_CLIENT_SECRET']);
        $client->setRedirectUri($_ENV['GOOGLE_REDIRECT_URI']);

        $client->addScope(Oauth2::USERINFO_PROFILE);
        $client->addScope(Oauth2::USERINFO_EMAIL);

        if (isset($_GET['code'])) {
            try {
                $client->authenticate($_GET['code']);
                $_SESSION['access_token'] = $client->getAccessToken();
                header('Location: /profile');
                exit();
            } catch (Exception $e) {
                echo 'Lỗi khi kết nối với Google: ' . $e->getMessage();
                exit();
            }
        } else {
            $authUrl = $client->createAuthUrl();
            header('Location: ' . $authUrl);
            exit();
        }
    }

    public static function loginGoogleAction()
    {
        if (isset($_GET['code'])) {
            try {
                $client = new Client();
                $client->setClientId($_ENV['GOOGLE_CLIENT_ID']);
                $client->setClientSecret($_ENV['GOOGLE_CLIENT_SECRET']);
                $client->setRedirectUri($_ENV['GOOGLE_REDIRECT_URI']);
                $client->addScope(Oauth2::USERINFO_PROFILE);
                $client->addScope(Oauth2::USERINFO_EMAIL);

                $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
                $client->setAccessToken($token['access_token']);

                $oAuth = new Oauth2($client);
                $accountInfo = $oAuth->userinfo->get();

                $_SESSION['access_token'] = $token['access_token'];

                $existedUser = AuthHelper::checkExistedInfo('email', $accountInfo->getEmail());
                if ($existedUser > 0) {
                    if (!empty($existedUser['google_id'])) {
                        if ($existedUser['status'] != 1) {
                            Notification::error('locked_account', 'Tài khoản đã bị khóa');
                            header('Location: /login');
                            exit();
                        } else {
                            AuthHelper::updateSession($existedUser['id']);
                            header('Location: /home');
                            exit();
                        }
                    } else {
                        Notification::error('Đăng ký thất bại', 'Tài khoản đã tồn tại và không liên kết với Google');
                        header('Location: /login');
                        exit();
                    }
                } else {
                    $data = [
                        'google_id' => $accountInfo->getId(),
                        'email' => $accountInfo->getEmail(),
                    ];
                    $result = AuthHelper::register($data);

                    if ($result) {
                        $user = AuthHelper::checkExistedInfo('google_id', $data['google_id']);
                        AuthHelper::updateSession($user['id']);
                        AuthHelper::updateCookie($user['id']);
                        Notification::success('Đăng nhập thành công', 'Đăng nhập tài khoản Google thành công');
                        header('Location: /home');
                        exit();
                    } else {
                        Notification::error('đăng nhập thất bại', 'Đăng nhập tài khoản Google thất bại');
                        header('Location: /login');
                        exit();
                    }
                }
            } catch (Exception $e) {
                echo 'Lỗi khi kết nối với Google: ' . $e->getMessage();
                exit();
            }
        } else {
            header('Location: /login');
            exit();
        }
    }
}

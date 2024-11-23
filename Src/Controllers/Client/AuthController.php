<?php
namespace Src\Controllers\Client;

use DateTime;
use Src\Controllers\BaseController;
use Src\Helpers\Client\SendMailHelper;
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
                $_SESSION['user']['fullname'] = $user['firstname'] . ' ' . $user['lastname'];
                $_SESSION['user']['id'] = $user['id'];
                $_SESSION['user']['phone'] = $user['phone'];
                $_SESSION['user']['firstname'] = $user['firstname'];
                $_SESSION['user']['lastname'] = $user['lastname'];
                $_SESSION['user']['email'] = $user['email'];
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
                    } else if (!empty($existedUser['facebook_id'])) {
                        // Nếu tài khoản đã có facebook_id, chuyển hướng đến đăng nhập Facebook
                        Notification::error('Đăng nhập thất bại', 'Email này đã được liên kết với tài khoản Facebook. Vui lòng đăng nhập qua Facebook');
                        header('Location: /login-facebook');
                        exit();
                    } else {
                        Notification::error('Đăng ký thất bại', 'Tài khoản đã tồn tại và không liên kết với Google');
                        header('Location: /login');
                        exit();
                    }
                } else {
                    $nameParts = explode(" ", $accountInfo->getName());
                    $lastname  = array_pop($nameParts);
                    $firstname = implode(" ", $nameParts);
                    $data = [
                        'google_id' => $accountInfo->getId(),
                        'email' => $accountInfo->getEmail(),
                        'fullname' => $accountInfo->getName(),
                        'firstname' => $firstname,
                        'lastname' => $lastname,
                        'method' => 'google'
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
    public static function redirectToFacebook()
    {
        $facebook_oauth_app_id = $_ENV['FACEBOOK_APP_ID'];
        $facebook_oauth_redirect_uri = $_ENV['FACEBOOK_REDIRECT_URI'];

        $params = [
            'client_id' => $facebook_oauth_app_id,
            'redirect_uri' => $facebook_oauth_redirect_uri,
            'response_type' => 'code',
            'scope' => 'email'
        ];

        header('Location: https://www.facebook.com/dialog/oauth?' . http_build_query($params));
        exit;
    }

    public static function handleFacebookCallback()
    {

        $usermodel = new UserModel();
        $userHelper = new AuthHelper;

        $facebook_oauth_app_id = $_ENV['FACEBOOK_APP_ID'];
        $facebook_oauth_app_secret = $_ENV['FACEBOOK_APP_SECRET'];
        $facebook_oauth_redirect_uri = $_ENV['FACEBOOK_REDIRECT_URI'];
        $facebook_oauth_version = $_ENV['FACEBOOK_OAUTH_VERSION'];

        if (isset($_GET['code']) && !empty($_GET['code'])) {
            // Lấy access token từ Facebook
            $params = [
                'client_id' => $facebook_oauth_app_id,
                'client_secret' => $facebook_oauth_app_secret,
                'redirect_uri' => $facebook_oauth_redirect_uri,
                'code' => $_GET['code']
            ];

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://graph.facebook.com/oauth/access_token');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);

            if (curl_errno($ch)) {
                Notification::error('Lỗi', 'Không thể kết nối với Facebook: ' . curl_error($ch));
                header('Location: /login');
                exit();
            }

            curl_close($ch);
            $response = json_decode($response, true);

            if (isset($response['access_token']) && !empty($response['access_token'])) {
                // Lấy thông tin tài khoản từ Facebook
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, 'https://graph.facebook.com/' . $facebook_oauth_version . '/me?fields=id,name,email,picture');
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization: Bearer ' . $response['access_token']]);
                $profileResponse = curl_exec($ch);
                curl_close($ch);

                $profile = json_decode($profileResponse, true);

                if (isset($profile['email'], $profile['name'])) {
                    // Tách tên và họ
                    $nameParts = explode(' ', $profile['name']);
                    $firstname = array_pop($nameParts);
                    $lastname = implode(' ', $nameParts);

                    // Kiểm tra xem người dùng đã tồn tại
                    $account = $usermodel->getAccountByEmail($profile['email']);
                    if (!$account) {
                        // Tạo tài khoản mới
                        $userData = [
                            'facebook_id' => $profile['id'],
                            'email' => $profile['email'],
                            'fullname' => $profile['name'],
                            'firstname' => $firstname,
                            'phone' => $profile['phone'],
                            'lastname' => $lastname,
                            'avatar' => $profile['picture']['data']['url'],
                            'status' => 1,
                            'role' => 1,
                            'method' => 'facebook'
                        ];
                        $userId = $userHelper->register($userData);

                        if (!$userId) {
                            Notification::error('Lỗi', 'Không thể tạo tài khoản mới!');
                            header('Location: /login');
                            exit();
                        }
                    } else {
                        $userId = $account['id'];
                        if ($account['status'] != 1) {
                            Notification::error('Lỗi', 'Tài khoản của bạn đã bị khóa!');
                            header('Location: /login');
                            exit();
                        }
                    }

                    // Lưu thông tin vào session
                    $_SESSION['user'] = [
                        'id' => $userId,
                        'email' => $profile['email'],
                        'fullname' => $profile['name'],
                        'firstname' => $firstname,
                        'lastname' => $lastname,
                        'phone' => $profile['phone'],
                        'avatar' => $profile['picture']['data']['url'],
                        'method' => 'facebook'
                    ];

                    Notification::success('Đăng nhập thành công', 'Chào mừng bạn trở lại!');
                    header('Location: /home');
                    exit();
                } else {
                    Notification::error('Lỗi', 'Không thể lấy thông tin từ Facebook!');
                    header('Location: /login');
                    exit();
                }
            } else {
                Notification::error('Lỗi', 'Mã token không hợp lệ!');
                header('Location: /login');
                exit();
            }
        } else {
            Notification::error('Lỗi', 'Không có mã xác thực!');
            header('Location: /login');
            exit();
        }
    }


    public function logoutUser()
    {
        $userHelper = new AuthHelper;
        $userHelper->logout();
        Notification::success('Đăng xuất thành công', 'bạn đã đăng xuất khỏi tài khoản');
        header('Location: /login');
        exit;
    }

    public static function updateUserInfoAction()
    {
        $data = [
            'fullname' => $_POST['fullname'],
            'firstname' => $_POST['firstname'],
            'lastname' =>  $_POST['lastname'],
            'phone' => $_POST['phone'],
            'email' => $_POST['email']
        ];
        $checkDuplicate = AuthHelper::checkInformation($data);
        if (!$checkDuplicate) {
            header('location: /profile');
            exit();
        }

        $errors = UserValidation::updateUserInfoValidation($data);
        if (is_array($errors) && !empty($errors)) {
            foreach ($errors as $error) {
                Notification::error("Cập nhật thông tin", $error);
            }
            header('location: /profile');
            exit();
        }

        AuthHelper::update($data);
        header('location: /profile');
    }



    public function forgotPassword() {
        echo $this->view->render('Client/Pages/ForgotPassword');
    }

    public function forgotPasswordSubmit() {
        $email = $_POST['email'];
        $sendMail = new SendMailHelper();
        if($sendMail->sendMail($email)) {
            Notification::success('Gửi mail thành công', 'Vui lòng check mail');
            header('location: /forgot-password');
            exit();
        } else {
            Notification::error('Gửi mail thất bại', 'Vui lòng kiểm tra lại thông tin tài khoản');
            header('location: /forgot-password');
            exit();
        }
    }

    public function loadResetPage() {
        $UserModel = new UserModel();
        $token = $_GET['token'];
        $user = $UserModel->getUserByToken($token);
        if($user) {

                $expires = date("U");
                date_default_timezone_set('Asia/Ho_Chi_Minh');
                $expiresTime = date("Y-m-d H:i:s", $expires);
                $timeNow = new DateTime($expiresTime);
                $userExpired = new DateTime($user['reset_token_expires']);
            if($userExpired < $timeNow) {
                Notification::error('Truy cập thất bại', 'Link đã hết hạn, vui lòng gửi mail mới');
                header('location: /forgot-password');
                exit();
            } else {
                echo $this->view->render('Client/Pages/ResetPassword', ['token' => $token]);
            }
        } else {
            Notification::error('Không thể truy cập', 'Bạn không thể truy cập trang này');
            header('location :/');
            exit();
        }
    }

    public function resetPassword($params) {
        $token = $params['token'];
        $password = $_POST['password'];
        $passVerify = $_POST['password-verify'];
        if(strcmp($password, $passVerify) != 0) {
            Notification::error('Không thể khôi phục', 'Mật khẩu xác nhận không chính xác');
            header('location: /forgot-password');
            exit();
        }

        $UserModel = new UserModel();
        $user = $UserModel->getUserByToken($token);
        $data = [
            'password' => password_hash($password = $_POST['password'], PASSWORD_DEFAULT)
        ];
        $updateResult = $UserModel->updateUser($user['id'], $data);

        if($updateResult) {
            Notification::success('Thành công', 'Đã thay đổi mật khẩu thành công');
            header('location: /login');
            exit();
        } else {
            Notification::error('Thất bại', 'Thay đổi mật khẩu thất bại');
            header('location: /login');
            exit();
        }
    }

    public static function updatePasswordAction()
    {
        $data = [
            'currentPassword' => $_POST['currentPassword'],
            'newPassword' => $_POST['newPassword'],
            'confirmPassword' => $_POST['confirmPassword']
        ];

        AuthHelper::updatePassword($data);
        header('location:/profile');
    }
}

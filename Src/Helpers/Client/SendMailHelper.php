<?php
namespace Src\Helpers\Client;

use Exception;
use PHPMailer\PHPMailer\PHPMailer;
use Src\Models\Client\UserModel;
use Src\Notifications\Notification;

class SendMailHelper {
    public function sendMail($email) {
        $UserModel = new UserModel;
        $user = $UserModel->getAccountByEmail($email);
        if($user !== null) {
            if(isset($user['google_id']) || isset($user['facebook_id'])) {
                Notification::error('Gửi mail thất bại', 'Thông tin tài khoản không hợp lệ');
                header('location: /forgot-password');
                exit();
            } else {
                $time = 'reset_token_expires';
                $token = bin2hex(random_bytes(32));
                $expires = date("U") + 1800;
                date_default_timezone_set('Asia/Ho_Chi_Minh');
                $expiresFormatted = date("Y-m-d H:i:s", $expires);

                $result = $UserModel->updateToken($token, $expiresFormatted, $email);
                if($result) {
                    $mail = new PHPMailer(true);
                    try {
                        //Server settings
                        $mail->isSMTP();
                        $mail->Host       = 'smtp.gmail.com';
                        $mail->SMTPAuth   = true;
                        $mail->Username   = $_ENV['APP_EMAIL'];
                        $mail->Password   = $_ENV['APP_PASS'];
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                        $mail->Port = 587;
        
                        //Recipients
                        $mail->setFrom($_ENV['APP_EMAIL']);
                        $mail->addAddress($email);
        
        
                        //Content
                        $mail->isHTML(true);
                        $mail->Subject = 'Khôi phục mật khẩu';
                        $mail->Body = "Chào bạn, <br> Chúng tôi đã nhận được yêu cầu khôi phục mật khẩu từ email của bạn. <br> Nếu đó là bạn, hãy nhấn vào liên kết sau để khôi phục mật khẩu: <a href='" . $_ENV['APP_URL'] . "/reset-password?token=" . $token . "'>Đặt lại mật khẩu</a>";
                        $mail->CharSet = 'UTF-8';
        
                        $mail->send();
                        return true;
                    } catch (Exception $th) {
                        error_log('Đã có lỗi xảy ra trong quá trình gửi mail: ' . $th->getMessage());
                        return false;
                    }
                }
            }
        } else {
            return false;
        }
    }
}
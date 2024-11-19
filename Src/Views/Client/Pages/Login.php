<?php $this->layout('Client/Components/Layout'); ?>



<?php $this->start('main_content') ?>

<div class="login-wrapper">
    <div class="login-img">
        <img src="<?= $_ENV['APP_URL'] ?>/public/Assets/Client/Images/Login/LoginPage.png" alt="Login">

    </div>
    <div class="login">
        <div class="form-wrapper">
            <form action="/user-login" method="post" class="login-form" id="loginForm">
                <h2 class="login-title">Đăng nhập</h2>
                <div class="col-md-12">
                    <input type="text" placeholder="Địa chỉ Email" class="login-form-input " name="email" id="email">
                    <span class="text-danger email-required" style="display:none" id="email-required">Vui lòng điền Email *</span>
                </div>
                <div class="col-md-12">
                    <input type="password" placeholder="Mật khẩu" class="login-form-input" name="password" id="password">
                    <span class="text-danger password-required" style="display:none" id="password-required">Vui lòng điền mật khẩu *</span>

                </div>
                <div class="extended-options">
                    <div class="remember-tick">
                        <input type="checkbox" name="remember-account" class="remember-checkbox" id="remember-account" value="remember">
                        <label for="remember-account" class="remember-box"></label>
                        <span>Nhớ tài khoản</span>
                    </div>
                    <div class="forgot-password">
                        <a href="">Quên mật khẩu</a>
                    </div>
                </div>
                <button class="login-btn" id="loginSubmit">Đăng nhập</button>

            </form>
            <div class="login-option">
                <p class="login-option-title">Hoặc đăng nhập bằng</p>
                <div class="d-flex justify-content-center">
                    <figure class="me-4">
                        <a href="/login-google"><img src="<?= $_ENV['APP_URL'] ?>/public/Assets/Client/Images/Login/Googlebg.png" alt="Google Icon" class="google-icon"></a>
                    </figure>
                    <figure>
                        <a href="/login-facebook"><img src="<?= $_ENV['APP_URL'] ?>/public/Assets/Client/Images/Login/fbicon-removebg-preview.png" alt="Facebook Icon" class="google-icon"></a>
                    </figure>
                </div>
            </div>
            <p class="register-link">Chưa có tài khoản? Đăng ký ngay <a href="/register">Tại đây</a></p>
        </div>


    </div>
</div>

<?php $this->stop() ?>

<?php
$this->push('scripts');
?>
<script src="<?= $_ENV['APP_URL'] ?>/public/Assets/Client/js/AuthValidation.js"></script>
<?php
$this->end();
?>
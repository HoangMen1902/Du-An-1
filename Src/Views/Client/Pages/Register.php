<?php $this->layout('Client/Components/Layout'); ?>



<?php $this->start('main_content') ?>

<div class="login-wrapper">
    <div class="login-img">
        <img src="<?= $_ENV['APP_URL'] ?>/public/Assets/Client/Images/Login/RegisterPage.png" alt="Register">

    </div>
    <div class="login">
        <div class="form-wrapper">
            <form action="" class="login-form" id="registerForm" onsubmit="return registerValidate()">
                <h2 class="login-title">Đăng Ký</h2>
                <div class="col-md-12">
                    <input type="email" placeholder="Email" class="login-form-input " name="email" id="email">
                    <span class="text-danger email-required" style="display:none" id="email-required">Vui lòng điền Email *</span>
                </div>
                <div class="col-md-12">
                    <input type="text" placeholder="Tài khoản" class="login-form-input " name="username" id="username">
                    <span class="text-danger username-required" style="display:none" id="username-required">Vui lòng điền tài khoản *</span>
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
                        <a href="/login">Đăng nhập</a>
                    </div>
                </div>
                <button class="login-btn" id="loginSubmit">Đăng ký</button>

            </form> 
            <div class="login-option">
                <p class="login-option-title">Hoặc đăng ký bằng</p>
                <figure>
                    <a href=""><img src="<?=$_ENV['APP_URL']?>/public/Assets/Client/Images/Login/Googlebg.png" alt="Google Icon" class="google-icon"></a>
                </figure>
            </div>
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
<?php $this->layout('Client/Components/Layout'); ?>



<?php $this->start('main_content') ?>

<?php if (isset($errors) && !empty($errors)) : ?>
    <div class="alert alert-danger mt-3">
        <ul>
            <?php foreach ($errors as $error) : ?>
                <li><?= htmlspecialchars($error['name']) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<div class="login-wrapper">
    <div class="login-img">
        <img src="<?= $_ENV['APP_URL'] ?>/public/Assets/Client/Images/Login/RegisterPage.png" alt="Register">

    </div>
    <div class="login">
        <div class="form-wrapper">
            <form  action="/register-action" class="login-form" id="registerForm" method="POST"  onsubmit="return registerValidate()">
                <h2 class="login-title">Đăng Ký</h2>
                <div class="col-md-12">
                    <input type="email" placeholder="Email" class="login-form-input " name="email" id="email">
                    <span class="text-danger email-required" style="display:none" id="email-required">Vui lòng điền Email *</span>
                </div>
                <div class="col-md-12">
                    <input type="text" placeholder="Tên" class="login-form-input " name="firstname" id="firstname">
                    <span class="text-danger username-required" style="display:none" id="firstname-required">Vui lòng điền Tên của bạn *</span>
                </div>
                <div class="col-md-12">
                    <input type="text" placeholder="Họ" class="login-form-input " name="lastname" id="lastname">
                    <span class="text-danger username-required" style="display:none" id="lastname-required">Vui lòng điền Họ của bạn *</span>
                </div>
                <div class="col-md-12">
                    <input type="password" placeholder="Mật khẩu" class="login-form-input" name="password" id="password">
                    <span class="text-danger password-required" style="display:none" id="password-required">Vui lòng điền mật khẩu *</span>

                </div>
                <div class="col-md-12">
                    <input type="password" placeholder="Nhập lại mật khẩu" class="login-form-input" name="passwordhash" id="passwordhash">
                    <span class="text-danger password-required" style="display:none" id="passwordhash-required">Vui lòng nhập lại mật khẩu *</span>

                </div>
                <div class="extended-options">
                    <div class="forgot-password">
                        <a href="/login">Đăng nhập</a>
                    </div>
                </div>
                <button class="login-btn" id="loginSubmit">Đăng ký</button>

            </form>
            <div class="login-option">
                <p class="login-option-title">Hoặc đăng ký bằng</p>
                <figure>
                    <a href=""><img src="<?= $_ENV['APP_URL'] ?>/public/Assets/Client/Images/Login/Googlebg.png" alt="Google Icon" class="google-icon"></a>
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
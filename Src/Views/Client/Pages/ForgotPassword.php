<?php $this->layout('Client/Components/Layout'); ?>


<?php $this->start('main_content') ?>
<div class="login-wrapper justify-content-center align-items-center">
    <div class="login" style="width: fit-content;">
        <div class="form-wrapper">
            <form action="/send-mail" method="post" class="mail-form" id="loginForm">
                <h2 class="login-title text-center">Quên mật khẩu</h2>
                <div class="col-md-12">
                    <input type="text" placeholder="Địa chỉ Email" class="login-form-input" name="email" id="email">
                    <span class="text-danger email-required" style="display:none" id="email-required">Vui lòng điền Email *</span>
                </div>
                <button class="login-btn" id="loginSubmit">Gửi mail</button>
            </form>
            <p class="register-link">Chưa có tài khoản? Đăng ký ngay <a href="/register">Tại đây</a></p>
        </div>


    </div>
</div>

<?php $this->stop() ?>

<?php
$this->push('scripts')
?>
<script src="<?=$_ENV['APP_URL']?>/public\Assets\Client\js\ResetValidation.js"></script>

<?php
$this->end();
?>
<?php $this->layout('Client/Components/Layout'); ?>


<?php $this->start('main_content') ?>
<div class="login-wrapper justify-content-center align-items-center">
    <div class="login" style="width: fit-content;">
        <div class="form-wrapper">
            <form action="/reset-password/<?=$token?>" method="post" class="reset-form" id="reset-form">
                <h2 class="login-title text-center">Quên mật khẩu</h2>
                <div class="col-md-12">
                    <input type="password" placeholder="Mật khẩu mới" class="login-form-input" name="password" id="password">
                    <span class="text-danger password-required" style="display:none" id="password-required">Vui lòng điền mật khẩu *</span>
                    <input type="password" placeholder="Nhập lại mật khẩu mới" class="login-form-input" name="password-verify" id="password-verify">
                    <span class="text-danger password-required" style="display:none" id="password-verify-required">Vui lòng điền mật khẩu*</span>
                    <span class="text-danger password-false" style="display:none" id="password-false">Mật khẩu mới không khớp *</span>
                </div>
                <button class="login-btn" id="loginSubmit">Gửi đổi mật khẩu</button>
            </form>
        </div>


    </div>
</div>

<?php $this->stop() ?>

<?php
$this->push('scripts')
?>
<script src="<?= $_ENV['APP_URL'] ?>/public\Assets\Client\js\ResetValidation.js"></script>

<?php
$this->end();
?>
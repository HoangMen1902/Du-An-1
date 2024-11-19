<?php $this->layout('Client/Components/Layout');

$this->start('main_content');
?>
<section class="account">
    <div class="container-fluid">
        <div class="row g-0">
            <?php $this->Insert('Client/Pages/UserProfile/Particals/sidebar'); ?>

            <div class="col-lg-9">
                <div class="change-password" style="padding-left: 80px;">
                    <div class="change-password-title">
                        <p>THAY ĐỔI MẬT KHẨU</p>
                    </div>
                    <div class="change-password-form">
                        <form method="POST" action="/change-user-password">
                            <input type="hidden" name="method" value="POST">
                            <div class="form-group">
                                <label for="currentPassword" class="form-label">Mật khẩu hiện tại</label>
                                <input type="password" id="currentPassword" name="currentPassword" class="form-control form-control-lg">
                                <div id="currentPassword-error" style="display: none;" class="text-danger">Mật khẩu hiện tại không được để trống.</div>
                            </div>

                            <div class="form-group">
                                <label for="newPassword" class="form-label">Mật khẩu mới</label>
                                <input type="password" id="newPassword" name="newPassword" class="form-control form-control-lg">
                                <div id="newPassword-error" style="display: none;" class="text-danger">Mật khẩu mới không được để trống.</div>
                            </div>

                            <div class="form-group">
                                <label for="confirmPassword" class="form-label">Xác nhận mật khẩu mới</label>
                                <input type="password" id="confirmPassword" name="confirmPassword" class="form-control form-control-lg">
                                <div id="confirmPassword-error" style="display: none;" class="text-danger">Xác nhận mật khẩu không được để trống.</div>
                            </div>

                            <div class="form-group">
                                <button type="submit" name="submit" class="btn btn-success btn-lg">
                                    Đổi mật khẩu
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $this->stop()
?>

<?php
$this->push('scripts')
?>
<script src="<?= $_ENV['APP_URL'] ?>/public/Assets/Client/js/ChangePasswordValidation.js"></script>
<?php
$this->end();
?>
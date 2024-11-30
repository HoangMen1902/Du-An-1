<?php $this->layout('Client/Components/Layout'); ?>

<?php $this->start('main_content'); ?>

<section class="account">
    <div class="container-fluid">
        <div class="row g-0">
            <?php $this->Insert('Client/Pages/UserProfile/Particals/sidebar'); ?>
            <div class="col-lg-9">
                <div class="account-info">
                    <div class="account-info-title">
                        <p>THÔNG TIN CÁ NHÂN</p>
                    </div>
                    <div class="account-info-form">
                        <form method="POST" action="/update-information">
                            <input type="hidden" name="method" value="POST">
                            <div class="form-group">
                                <label for="fullname" class="form-label">Tên đầy đủ</label>
                                <input type="text" id="fullname" name="fullname" class="form-control form-control-lg"
                                    value="<?= isset($_SESSION['user']['fullname']) ? htmlspecialchars($_SESSION['user']['fullname']) : '' ?>"
                                    placeholder="Ex: NguyenVanA, ....">
                                <div id="fullname-error" style="display: none;" class="text-danger">Tên đầy đủ không được để trống.</div>
                            </div>

                            <div class="form-group">
                                <label for="firstname" class="form-label">Tên</label>
                                <input type="text" id="firstname" name="firstname" class="form-control form-control-lg"
                                    value="<?= isset($_SESSION['user']['firstname']) ? htmlspecialchars($_SESSION['user']['firstname']) : '' ?>">
                                <div id="firstname-error" style="color: red; display: none;">Tên không được để trống *</div>
                            </div>

                            <div class="form-group">
                                <label for="lastname" class="form-label">Họ</label>
                                <input type="text" id="lastname" name="lastname" class="form-control form-control-lg"
                                    value="<?= isset($_SESSION['user']['lastname']) ? htmlspecialchars($_SESSION['user']['lastname']) : '' ?>">
                                <div id="lastname-error" style="display: none;" class="text-danger">Họ không được để trống *</div>
                            </div>

                            <div class="form-group">
                                <label for="phone" class="form-label">Số điện thoại</label>
                                <input type="text" id="phone" name="phone" class="form-control form-control-lg"
                                    value="<?= isset($_SESSION['user']['phone']) ? htmlspecialchars($_SESSION['user']['phone']) : '' ?>">
                                <div id="phone-error" style="display: none;" class="text-danger">Số điện thoại không được để trống *</div>
                            </div>
                            <div class="form-group" id="email-group"
                                style="display: <?= isset($_SESSION['user']['google_id']) && !empty($_SESSION['user']['google_id']) ? 'none' : 'block'; ?>;">
                                <label for="email" class="form-label">Địa chỉ Email</label>
                                <?php if (isset($_SESSION['user']['google_id']) && !empty($_SESSION['user']['google_id'])): ?>
                                    <input type="text" id="email" name="email" class="form-control form-control-lg"
                                        value="<?= htmlspecialchars($_SESSION['user']['email']) ?>" readonly>
                                    <small class="text-muted">Email được liên kết với Google, không thể chỉnh sửa.</small>
                                <?php else: ?>
                                    <input type="text" id="email" name="email" class="form-control form-control-lg"
                                        value="<?= isset($_SESSION['user']['email']) ? htmlspecialchars($_SESSION['user']['email']) : '' ?>">
                                    <div id="email-error" style="display: none;" class="text-danger">Email không được để trống *</div>
                                <?php endif; ?>
                            </div>



                            <div class="form-group">
                                <button type="submit" name="submit" class="btn btn-success btn-lg">
                                    Lưu thay đổi
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $this->stop(); ?>

<?php
$this->push('scripts')
?>
<script src="<?= $_ENV['APP_URL'] ?>/public/Assets/Client/js/UpdateUserValidation.js"></script>
<?php
$this->end();
?>
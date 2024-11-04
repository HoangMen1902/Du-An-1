<?php $this->layout('Client/Components/Layout');

$this->start('main_content');
?>
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
                                        <label for="username" class="form-label">Tên đăng nhập</label>
                                        <input type="text" id="username" name="username" class="form-control form-control-lg"  placeholder="Ex: NguyenVanA, ....">
                                    </div>
                                    <div class="form-group">
                                        <label for="firstName" class="form-label">Họ</label>
                                        <input type="text" id="firstName" name="firstName" class="form-control form-control-lg" value="">
                                    </div>
                                    <div class="form-group">
                                        <label for="lastName" class="form-label">Tên</label>
                                        <input type="text" id="lastName" name="lastName" class="form-control form-control-lg" value="">
                                    </div>
                                    <div class="form-group">
                                        <label for="phone" class="form-label">Số điện thoại</label>
                                        <input type="text" id="phone" name="phone" class="form-control form-control-lg" value="">
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="form-label">Địa chỉ Email</label>
                                        <input type="text" id="email" name="email" class="form-control form-control-lg" value="">
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
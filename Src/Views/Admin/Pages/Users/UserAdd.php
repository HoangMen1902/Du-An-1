<?php $this->layout('Admin/Layouts/Layout') ?>


<?php
$this->start('main_content');
?>

<?php

if(isset($_GET['status']) && $_GET['status'] === 'success') {
    ?>
            <div class="alert alert-success mt-5">
                <p class="m-0">Đã thêm thành công</p>
            </div>
    <?php
}
?>
<div class="row mt-4">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Thêm người dùng</h4>
                <form class="form-sample" id="addForm" action="/admin/add-user" method="POST">
                    <p class="card-description">Thông tin cá nhân</p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Họ</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="firstName" id="firstName" />
                                    <small class="text-danger" style="display: none;" id="firstName-validate">* Vui lòng nhập Họ</small>
                                    <small class="text-danger" style="display: none;" id="firstName-invalid">* Họ phải dưới 50 ký tự, không ký tự đặc biệt</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tên</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="lastName" id="lastName" />
                                    <small class="text-danger" style="display: none;" id="lastName-validate">* Vui lòng nhập tên</small>
                                    <small class="text-danger" style="display: none;" id="lastName-invalid">* Tên phải dưới 50 ký tự, không ký tự đặc biệt</small>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control" name="email" id="email" />
                                    <small class="text-danger" style="display: none;" id="email-validate">* Vui lòng nhập địa chỉ Email</small>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Số điện thoại</label>
                                <div class="col-sm-9">
                                    <input type="tel" class="form-control" name="phone" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Username</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="username" id="username" />
                                    <small class="text-danger" style="display: none;" id="username-validate">* Vui lòng nhập mật Username</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Mật khẩu</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" name="password" />
                                    <small class="text-danger" style="display: none;" id="password-validate">* Vui lòng nhập mật khẩu</small>
                                    <small class="text-danger" style="display: none;" id="password-invalid">* Mật khẩu ít nhất phải 8 ký tự</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Ngày sinh</label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control" name="birthday" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Vai trò</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="role" id="role">
                                        <option value="1">Client</option>
                                        <option value="2">Admin</option>
                                    </select>
                                    <small class="text-danger" style="display: none;" id="role-validate">* Vai trò không được trống</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="card-description">Địa chỉ</p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tỉnh/thành</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="province_id" id="province">
                                        <option value="0">Tạm thời trống</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Quận/Huyện</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="district_id" id="district">
                                        <option value="0">Tạm thời trống</option>

                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group row">
                            <label class="col-sm-12 col-form-label p-0">Phường/Xã</label>
                            <div class="col-sm-12 p-0">
                                <select class="form-control" name="ward_id" id="ward">
                                    <option value="0">Tạm thời trống</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Địa chỉ chi tiết</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" name="address" placeholder="ABC, Phường Hưng Thạnh, ..." />
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Trạng thái</label>
                                <div class="col-sm-2">
                                    <select class="form-control" name="status" id="status">
                                        <option value="1">Hoạt động</option>
                                        <option value="2">Khóa</option>
                                    </select>
                                    <small class="text-danger" style="display: none;" id="role-validate">* Vai trò không được trống</small>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <button type="submit" class="btn btn-primary" id="submitUserBtn">Thêm</button>
                        </div>
                </form>

            </div>
            <?php
            if (isset($_GET['status']) && $_GET['status'] === 'failed' && isset($_GET['error'])) {
                switch ($_GET['error']) {
                    case 1:
            ?>
                        <div class="alert alert-danger mt-5">
                            <strong>Lỗi!</strong> Vui lòng nhập đầy đủ thông tin cần thiết!
                        </div>
                    <?php
                        break;
                    case 2:
                    ?>
                        <div class="alert alert-danger mt-5">
                            <strong>Lỗi!</strong> Độ dài dữ liệu không hợp lệ!
                        </div>
            <?php
                        break;
                }
            } 

            ?>
        </div>
    </div>
</div>



<?php

$this->stop();
$this->push('scripts') ?>
<script src="<?=$_ENV['APP_URL']?>/public\Assets\Admin\js\Pages\UserScript.js"></script>

<?php
$this->end()
?>
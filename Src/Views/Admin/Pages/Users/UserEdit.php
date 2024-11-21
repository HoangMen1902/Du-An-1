<?php $this->layout('Admin/Layouts/Layout') ?>


<?php 
$this->start('main_content');
?>
<div class="row mt-4">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Chỉnh sửa người dùng</h4>
                <form class="form-sample" id="addForm" action="/admin/edit-user/<?=$data['id']?>" method="POST">
                    <p class="card-description">Thông tin cá nhân</p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Họ</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="firstName" id="firstName"  value="<?=$data['firstname']?>"/>
                                    <small class="text-danger" style="display: none;" id="firstName-validate">* Vui lòng nhập Họ</small>
                                    <small class="text-danger" style="display: none;" id="firstName-invalid">* Họ phải dưới 50 ký tự, không ký tự đặc biệt</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tên</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="lastName" id="lastName" value="<?=$data['lastname']?>"/>
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
                                    <input type="email" class="form-control" name="email" id="email" value="<?=$data['email']?>"/>
                                    <small class="text-danger" style="display: none;" id="email-validate">* Vui lòng nhập địa chỉ Email</small>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Số điện thoại</label>
                                <div class="col-sm-9">
                                    <input type="tel" class="form-control" name="phone" value="<?=$data['phone']?>"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Vai trò</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="role" id="role">
                                        <option value="1" <?=$data['role'] = 1 ? 'selected' : ''?>>Client</option>
                                        <option value="2" <?=$data['role'] = 2 ? 'selected' : ''?>>Admin</option>
                                    </select>
                                    <small class="text-danger" style="display: none;" id="role-validate">* Vai trò không được trống</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Trạng thái</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="status" id="status">
                                        <option value="1">Hoạt động</option>
                                        <option value="2">Khóa</option>
                                    </select>
                                    <small class="text-danger" style="display: none;" id="role-validate">* Vai trò không được trống</small>
                                </div>
                            </div>
                        </div>
                    </div>


                        
                        <div class="row justify-content-end">
                            <button type="submit" class="btn btn-primary" id="submitUserBtn" >Sửa</button>
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
$this->start('scripts');
?>
    <script src="<?=$_ENV['APP_URL']?>/public/assets/client/js/provinceAPI.js"></script>
    <script src="<?=$_ENV['APP_URL']?>/public/assets/Admin/js/Pages/UserScript.js"></script>

<?php
$this->end()
?>
<?php $this->layout('Admin/Layouts/Layout') ?>


<?php 
$this->start('main_content');
?>

<div class="content-wrapper">
        <div class="row mt-4">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Chỉnh sửa người dùng</h4>
                        <form class="form-sample" action="/admin/update-user" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<!-- id của người dùng -->">
                            <input type="hidden" name="method" value="POST">

                            <p class="card-description">Thông tin cá nhân</p>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Họ</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="lastName" value="<!-- họ của người dùng -->" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Tên</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="firstName" value="<!-- tên của người dùng -->" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Email</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="email" value="<!-- email của người dùng -->" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Số điện thoại</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="phone" value="<!-- số điện thoại của người dùng -->" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Username</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="username" value="<!-- username của người dùng -->" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Password</label>
                                        <div class="col-sm-9">
                                            <input type="password" class="form-control" name="password" value="" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <p class="card-description">Địa chỉ</p>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Tỉnh/Thành</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="province_id" id="city">
                                                <!-- Các tùy chọn tỉnh/thành sẽ được thêm vào đây -->
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Quận/Huyện</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="district_id" id="district">
                                                <!-- Các tùy chọn quận/huyện sẽ được thêm vào đây -->
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Địa chỉ chi tiết</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" name="address" value="<!-- địa chỉ chi tiết của người dùng -->" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Role</label>
                                        <div class="col-sm-12">
                                            <select class="form-control" name="role" id="role">
                                                <option value="1"> >client</option>
                                                <option value="2" > >admin</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-end">
                                <button type="submit" class="btn btn-primary" name="submit">Cập nhật</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/public/assets/client/js/provinceAPI.js"></script>
<?php

$this->stop();
?>
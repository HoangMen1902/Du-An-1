<?php

namespace App\Views\Admin\Pages\Users;

use App\Views\BaseView;

class UserAdd extends BaseView
{
    public static function render($data = null)
    {


?>

        <div class="row mt-4">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Thêm người dùng</h4>
                        <form class="form-sample" action="/admin/add-user" method="POST">
                            <input type="hidden" name="method" value="POST" id="">
                            <p class="card-description">Thông tin cá nhân</p>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Họ</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="lastName" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Tên</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="firstName" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Email</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="email" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Số điện thoại</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="phone" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Username</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="username" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Mật khẩu</label>
                                        <div class="col-sm-9">
                                            <input type="password" class="form-control" name="password" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p class="card-description">Địa chỉ</p>
                            <!-- <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Tỉnh/Thành</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="province_id" id="city">
                                                <option value="">Tỉnh/Thành Phố</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Quận/Huyện</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="district_id" id="district">
                                                <option value="">Quận/Huyện</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Địa chỉ chi tiết</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" name="address" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Role</label>
                                        <div class="col-sm-12">
                                            <select class="form-control" name="role" id="role">
                                                <option value="1">client</option>
                                                <option value="2">admin</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-end">
                                <button type="submit" class="btn btn-primary" name="submit"> Thêm</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>



<?php

    }
}

?>
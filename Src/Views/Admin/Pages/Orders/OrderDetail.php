<?php $this->layout('Admin/Layouts/Layout') ?>


<?php 
$this->start('main_content');
?>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row mt-4">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Chi Tiết Đơn Hàng</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Tên người mua</label>
                                    <div class="col-sm-9">
                                        <input disabled type="text" class="form-control" name="name" value="" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Số điện thoại</label>
                                    <div class="col-sm-9">
                                        <input disabled type="text" class="form-control" name="phone" value="" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-sm-9">
                                        <input disabled type="text" class="form-control" name="email" value="" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Địa chỉ</label>
                                    <div class="col-sm-9">
                                        <input disabled type="text" class="form-control" name="address" value="" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Tổng giá đơn hàng</label>
                                    <div class="col-sm-9">
                                        <input disabled type="text" class="form-control" name="price" value="" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Trạng thái</label>
                                    <div class="col-sm-9">
                                        <input disabled type="text" class="form-control" name="status" value="" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Giá</th>
                                        <th>Số lượng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="alert alert-warning" role="alert" style="display: none;">
                            Không có thông tin chi tiết sản phẩm cho đơn hàng này.
                        </div>

                        <div class="row justify-content-end">
                            <a href="?url=orders" class="btn btn-primary">Trở về</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php

$this->stop();
?>
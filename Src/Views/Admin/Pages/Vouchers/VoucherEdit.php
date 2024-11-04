<?php $this->layout('Admin/Layouts/Layout') ?>


<?php 
$this->start('main_content');
?>
<div class="content-wrapper">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Sửa Voucher</h4>
                <form class="forms-sample" method="POST" action="/admin/update-voucher">
                    <input type="hidden" name="method" value="POST">
                    <div class="form-group">
                        <label for="id">ID</label>
                        <input type="text" class="form-control" id="id" placeholder="id" name="id" value="1" readonly>
                    </div>
                    <div class="form-group">
                        <label for="name">Tên</label>
                        <input type="text" class="form-control" id="name" placeholder="Name" name="name" value="Voucher Name">
                    </div>
                    <div class="form-group">
                        <label for="code">Mã Voucher</label>
                        <input type="text" class="form-control" id="code" name="code" value="VOUCHER123"></input>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Giá giảm</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" value="50000" name="discountAmount" id="discountAmount">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">VNĐ</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="">Giá giảm với đơn trên</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" value="200000" name="orderValueDiscount" id="orderValueDiscount">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">VNĐ</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label class="col-sm-6 col-form-label">Ngày hết hạn</label>
                            <div class="col-sm-9" style="padding: 0">
                                <input class="form-control" type="datetime-local" id="dueAt" name="dueAt" value="2024-11-30T12:00">
                                <div id="invalidDate" style="display: none; color: red;">Vui lòng nhập ngày hợp lệ</div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Trạng thái</label>
                        <div class="form-check form-check-success ">
                            <select class="form-control form-control-sm col-lg-2" name="status">
                                <option value="1" selected>Hoạt động</option>
                                <option value="2">Không hoạt động</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary mr-2">Xác nhận</button>
                </form>
            </div>
        </div>
    </div>
</div>


<?php

$this->stop();
?>
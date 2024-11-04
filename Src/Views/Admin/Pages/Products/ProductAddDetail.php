<?php $this->layout('Admin/Layouts/Layout') ?>


<?php 
$this->start('main_content');
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="table-responsive pt-3">
                <table class="table table-striped project-orders-table">
                    <thead>
                        <tr>
                            <th class="ml-5">ID</th>
                            <th>Tên người mua</th>
                            <th>Số điện thoại</th>
                            <th>Địa chỉ</th>
                            <th>Tổng giá sản phẩm</th>
                            <th>Trạng thái</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Nguyễn Văn A</td>
                            <td>0123456789</td>
                            <td>123 Đường ABC, Quận 1</td>
                            <td>500.000 VNĐ</td>
                            <td>Đã thanh toán</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <a href="/admin/order-detail/1">
                                        <button type="button" class="btn btn-info btn-sm btn-icon-text mr-3">
                                            Chi tiết
                                            <i class="typcn typcn-edit btn-icon-append"></i>
                                        </button>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="7" class="text-center">Không có đơn hàng.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php

$this->stop();
?>
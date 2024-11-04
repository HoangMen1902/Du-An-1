<?php $this->layout('Admin/Layouts/Layout') ?>


<?php 
$this->start('main_content');
?>

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Mã giảm giá</h4>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên</th>
                            <th>Mã giảm giá</th>
                            <th>Giá giảm</th>
                            <th>Giảm với đơn trên</th>
                            <th>Ngày tạo</th>
                            <th>Ngày hết hạn</th>
                            <th>Trạng thái</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Voucher Giảm Giá</td>
                            <td>VOUCHER123</td>
                            <td><?= number_format(50000) ?></td>
                            <td><?= number_format(200000) ?></td>
                            <td>2024-01-01</td>
                            <td>2024-12-31</td>
                            <td>Hoạt động</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <a href="/admin/edit-voucher/1" class="btn btn-success btn-sm btn-icon-text mr-3">
                                        Sửa
                                        <i class="typcn typcn-edit btn-icon-append"></i>
                                    </a>
                                    <a href="/admin/delete-voucher/1" onclick="return confirm('Bạn chắc chứ?')" class="btn btn-danger btn-sm btn-icon-text">
                                        Xóa
                                        <i class="typcn typcn-delete-outline btn-icon-append"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <!-- Thêm các voucher khác ở đây -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php

$this->stop();
?>
<?php $this->layout('Admin/Layouts/Layout') ?>


<?php
$this->start('main_content');
?>
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Danh sách đơn trả góp</h4>

            <div class="table-responsive pt-3">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Mã Kế Hoạch</th>
                            <th>Mã Đơn Hàng</th>
                            <th>Lãi Suất (%)</th>
                            <th>Kỳ Hạn (Tháng)</th>
                            <th>Số Tiền Thanh Toán Hàng Tháng</th>
                            <th>Ngày Bắt Đầu</th>
                            <th>Ngày Kết Thúc</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>KP001</td>
                            <td>DH123</td>
                            <td>5.0</td>
                            <td>12</td>
                            <td>1,000,000 VND</td>
                            <td>2024-01-01</td>
                            <td>2024-12-31</td>
                            <td>Hoạt động</td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-three-dots"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" style="display: flex;" href="#">
                                            <p>Sửa</p>
                                            <i class="typcn typcn-edit btn-icon-append"></i>
                                        </a>
                                        <a class="dropdown-item" href="#" onclick="return confirm('Bạn chắc chứ?')">
                                            <p>Xóa</p>
                                            <i class="typcn typcn-delete-outline btn-icon-append"></i>
                                        </a>
                                        <a class="dropdown-item" href="#">
                                            <p>Chi tiết</p>
                                            <i class="typcn typcn-edit btn-icon-append"></i>
                                        </a>
                                        <a class="dropdown-item" href="#">
                                            <p>Thêm thông số kỹ thuật</p>
                                            <i class="typcn typcn-edit btn-icon-append"></i>
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="5" class="text-center text-danger">Không có dữ liệu</td>
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
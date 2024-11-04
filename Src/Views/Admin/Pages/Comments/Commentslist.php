<?php $this->layout('Admin/Layouts/Layout') ?>


<?php 
$this->start('main_content');
?>

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Danh sách Bình luận</h4>
            <div class="table-responsive pt-3">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên người Bình luận</th>
                            <th>Nội dung</th>
                            <th>Ngày Và giờ</th>
                            <th>Trạng thái</th>
                            <th>ID sản phẩm</th>
                            <th>ID người dùng</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Nguyễn Văn A</td>
                            <td>Nội dung bình luận ở đây.</td>
                            <td>2024-11-03 10:00</td>
                            <td>1</td>
                            <td>2</td>
                            <td>Hoạt động</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <a href="/admin/commentEdit/1" class="btn btn-success btn-sm btn-icon-text mr-3">
                                        Sửa
                                        <i class="typcn typcn-edit btn-icon-append"></i>
                                    </a>
                                    <a href="/admin/delete-comment/1" onclick="return confirm('Bạn chắc chứ?')"
                                        class="btn btn-danger btn-sm btn-icon-text">
                                        Xóa
                                        <i class="typcn typcn-delete-outline btn-icon-append"></i>
                                    </a>
                                    <a href="/admin/approve-comment/1" class="btn btn-primary btn-sm btn-icon-text ml-3">
                                        Duyệt
                                        <i class="typcn typcn-tick-outline btn-icon-append"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Trần Thị B</td>
                            <td>Nội dung bình luận thứ hai.</td>
                            <td>2024-11-03 11:00</td>
                            <td>0</td>
                            <td>3</td>
                            <td>Không hoạt động</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <a href="/admin/commentEdit/2" class="btn btn-success btn-sm btn-icon-text mr-3">
                                        Sửa
                                        <i class="typcn typcn-edit btn-icon-append"></i>
                                    </a>
                                    <a href="/admin/delete-comment/2" onclick="return confirm('Bạn chắc chứ?')"
                                        class="btn btn-danger btn-sm btn-icon-text">
                                        Xóa
                                        <i class="typcn typcn-delete-outline btn-icon-append"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <!-- Thêm các bình luận khác ở đây -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php

$this->stop();
?>
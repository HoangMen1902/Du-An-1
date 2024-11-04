<?php $this->layout('Admin/Layouts/Layout') ?>


<?php 
$this->start('main_content');
?>
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Danh sách Loại sản phẩm</h4>
            <div class="table-responsive pt-3">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên Loại sản phẩm</th>
                            <th>Trạng thái</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Giả định có dữ liệu -->
                        <tr>
                            <td>1</td>
                            <td>Tên loại sản phẩm 1</td>
                            <td>Hoạt động</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <a href="/admin/edit-category/1" class="btn btn-success btn-sm btn-icon-text mr-3">
                                        Sửa
                                        <i class="typcn typcn-edit btn-icon-append"></i>
                                    </a>
                                    <a href="/admin/delete-category/1" onclick="return confirm('Bạn chắc chứ?')"
                                        class="btn btn-danger btn-sm btn-icon-text">
                                        Xóa
                                        <i class="typcn typcn-delete-outline btn-icon-append"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Tên loại sản phẩm 2</td>
                            <td>Không hoạt động</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <a href="/admin/edit-category/2" class="btn btn-success btn-sm btn-icon-text mr-3">
                                        Sửa
                                        <i class="typcn typcn-edit btn-icon-append"></i>
                                    </a>
                                    <a href="/admin/delete-category/2" onclick="return confirm('Bạn chắc chứ?')"
                                        class="btn btn-danger btn-sm btn-icon-text">
                                        Xóa
                                        <i class="typcn typcn-delete-outline btn-icon-append"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <!-- Kết thúc giả định có dữ liệu -->
                    </tbody>
                </table>
                <h4 class="text-center text-danger">Không có dữ liệu</h4>
            </div>
        </div>
    </div>
</div>


<?php

$this->stop();
?>
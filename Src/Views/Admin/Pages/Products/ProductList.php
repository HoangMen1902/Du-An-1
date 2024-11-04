<?php $this->layout('Admin/Layouts/Layout') ?>


<?php 
$this->start('main_content');
?>
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Danh sách Sản phẩm</h4>
            
            <div class="table-responsive pt-3">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên Sản phẩm</th>
                            <th>Hình ảnh</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Sản phẩm mẫu</td>
                            <td><img src="/public/uploads/sample.jpg" alt="Hình ảnh sản phẩm" width="100%"></td>
                            <td>Hoạt động</td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-three-dots"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" style="display: flex;" href="#"><p>Sửa</p>
                                            <i class="typcn typcn-edit btn-icon-append"></i>
                                        </a>
                                        <a class="dropdown-item" href="#" onclick="return confirm('Bạn chắc chứ?')"><p>Xóa</p>
                                            <i class="typcn typcn-delete-outline btn-icon-append"></i>
                                        </a>
                                        <a class="dropdown-item" href="#"><p>Chi tiết</p>
                                            <i class="typcn typcn-edit btn-icon-append"></i>
                                        </a>
                                        <a class="dropdown-item" href="#"><p>Thêm thông số kỹ thuật</p>
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
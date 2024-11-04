<?php $this->layout('Admin/Layouts/Layout') ?>


<?php 
$this->start('main_content');
?>
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Danh sách thương hiệu</h4>
            <div class="table-responsive pt-3">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên thương hiệu</th>
                            <th>Hình ảnh</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Dữ liệu sẽ được chèn vào đây bằng cách sử dụng JavaScript hoặc một ngôn ngữ phía máy chủ -->
                        <tr>
                            <td>1</td>
                            <td>Bàn phím</td>
                            <td>
                                <img src="/public/uploads/brands/brand-image.png" 
                                     alt="Brand Image" 
                                     style="object-fit: contain; width: 100px; height: auto;">
                            </td>
                            <td>Hoạt động</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <a href="/admin/edit-brand/1" class="btn btn-success btn-sm btn-icon-text mr-3">
                                        Sửa
                                        <i class="typcn typcn-edit btn-icon-append"></i>
                                    </a>
                                    <a href="/admin/delete-brand/1" onclick="return confirm('Bạn chắc chứ?')" class="btn btn-danger btn-sm btn-icon-text">
                                        Xóa
                                        <i class="typcn typcn-delete-outline btn-icon-append"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <!-- Thêm các hàng khác tương tự ở đây -->
                        <tr>
                            <td>2</td>
                            <td>Chuột</td>
                            <td>
                                <img src="/public/uploads/brands/brand-image2.png" 
                                     alt="Brand Image" 
                                     style="object-fit: contain; width: 100px; height: auto;">
                            </td>
                            <td>Không hoạt động</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <a href="/admin/edit-brand/2" class="btn btn-success btn-sm btn-icon-text mr-3">
                                        Sửa
                                        <i class="typcn typcn-edit btn-icon-append"></i>
                                    </a>
                                    <a href="/admin/delete-brand/2" onclick="return confirm('Bạn chắc chứ?')" class="btn btn-danger btn-sm btn-icon-text">
                                        Xóa
                                        <i class="typcn typcn-delete-outline btn-icon-append"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <!-- Thêm các hàng khác nếu cần -->
                    </tbody>
                </table>
            </div>
            <h4 class="text-center text-danger">Không có dữ liệu</h4>
        </div>
    </div>
</div>

<?php
$this->stop();
?>

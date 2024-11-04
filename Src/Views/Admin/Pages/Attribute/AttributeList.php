<?php $this->layout('Admin/Layouts/Layout') ?>


<?php 
$this->start('main_content');
?>
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Danh sách Loại thuộc tính</h4>

            <!-- If there is data, display the table -->
            <div class="table-responsive pt-3" id="attribute-list">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên Loại thuộc tính</th>
                            <th>Trạng thái</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Replace the content here with dynamically loaded rows using JavaScript, if applicable -->
                        <tr>
                            <td>1</td>
                            <td>Example Attribute Name</td>
                            <td>Hoạt động</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <a href="/admin/edit-category/1" class="btn btn-success btn-sm btn-icon-text mr-3">
                                        Sửa
                                        <i class="typcn typcn-edit btn-icon-append"></i>
                                    </a>
                                    <a href="/admin/delete-category/1" onclick="return confirm('Bạn chắc chứ?')" class="btn btn-danger btn-sm btn-icon-text">
                                        Xóa
                                        <i class="typcn typcn-delete-outline btn-icon-append"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- If there is no data, display this message -->
            <h4 class="text-center text-danger" id="no-data-message" style="display: none;">Không có dữ liệu</h4>
        </div>
    </div>
</div>
<?php
$this->stop();
?>




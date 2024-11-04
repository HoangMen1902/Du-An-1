<?php $this->layout('Admin/Layouts/Layout') ?>


<?php 
$this->start('main_content');
?>
<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Thêm Thương hiệu</h4>
            <form action="/admin/add-brand" method="post" enctype="multipart/form-data">
                <input type="hidden" name="method" value="POST">
                
                <div class="form-group">
                    <label>Tên Thương hiệu</label>
                    <input type="text" class="form-control form-control-lg" name="name" placeholder="Bàn phím.."
                        aria-label="Category Name">
                </div>
                
                <div class="form-group">
                    <label>Hình Ảnh Thương Hiệu</label>
                    <input type="file" class="form-control form-control-lg" name="image" aria-label="Category Name">
                </div>
                
                <div class="form-group">
                    <label>Mô tả</label>
                    <input type="text" class="form-control form-control-lg" name="description">
                </div>
                
                <div class="form-group">
                    <label>Trạng thái</label>
                    <div class="form-check form-check-success">
                        <select class="form-control form-control-sm col-lg-2" name="status">
                            <option value="1">Hoạt động</option>
                            <option value="2">Không hoạt động</option>
                        </select>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary" name="submit" style="justify-self: flex-end;">Thêm</button>

                <!-- Success and Error Alerts - Toggle display based on conditions -->
                <div id="alert-success" class="alert alert-success mt-5" style="display: none;">
                    Thêm thương hiệu thành công!
                </div>
                <div id="alert-error" class="alert alert-danger mt-5" style="display: none;">
                    Có lỗi xảy ra khi thêm thương hiệu.
                </div>
            </form>
        </div>
    </div>
</div>
<?php
$this->stop();
?>




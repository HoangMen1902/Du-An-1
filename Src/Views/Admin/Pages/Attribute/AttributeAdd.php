<?php $this->layout('Admin/Layouts/Layout') ?>


<?php
$this->start('main_content');
?>
<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Thêm phân thuộc tính</h4>
            <form action="/admin/attribute-add" method="post">
                <input type="hidden" name="method" value="POST">
                <div class="form-group">
                    <label>Tên thuộc tính</label>
                    <input type="text" class="form-control form-control-lg" placeholder="" aria-label="Category Name"
                        name="name">
                </div>
                <div class="form-group">
                    <label>Trạng thái</label>
                    <div class="form-check form-check-success ">
                        <select class="form-control form-control-sm col-lg-2" name="status">
                            <option value="1">Hoạt động</option>
                            <option value="2">Không hoạt động</option>
                        </select>
                    </div>
                </div>
                <button type="submit" name="submit" class="btn btn-primary"
                    style="justify-self: flex-end;">Thêm</button>
            </form>
            <!-- Error message section -->
            <div class="mt-5 alert alert-danger" role="alert" id="error-message" style="display: none;">
                <!-- Error content here -->
            </div>
        </div>
    </div>
</div>

<?php
$this->stop();
?>
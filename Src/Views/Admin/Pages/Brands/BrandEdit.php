<?php $this->layout('Admin/Layouts/Layout') ?>


<?php
$this->start('main_content');
?>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Sửa Thương hiệu</h4>
                    <form action="/admin/update-brand/1" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="method" value="POST">

                        <div class="form-group">
                            <label for="id">ID</label>
                            <input type="text" class="form-control" id="id" placeholder="id" name="id" value="1"
                                readonly>
                        </div>

                        <div class="form-group">
                            <label>Tên Thương hiệu</label>
                            <input type="text" class="form-control form-control-lg" name="name"
                                placeholder="Tên thương hiệu" value="Bàn phím" aria-label="Category Name">
                        </div>

                        <div class="form-group">
                            <label>Hình Ảnh Thương Hiệu</label>
                            <div class="mb-2">
                                <img src="/public/uploads/brands/brand-image.png" alt="Current Image"
                                    style="max-width: 150px;">
                            </div>
                            <input type="file" class="form-control form-control-lg" name="image"
                                aria-label="Category Image">
                        </div>

                        <div class="form-group">
                            <label>Mô tả Thương hiệu</label>
                            <textarea class="form-control form-control-lg" name="description"
                                placeholder="Mô tả">Mô tả về bàn phím.</textarea>
                        </div>

                        <div class="form-group">
                            <label>Trạng thái</label>
                            <div class="form-check form-check-success">
                                <select class="form-control form-control-sm col-lg-2" name="status">
                                    <option value="1" selected>Hoạt động</option>
                                    <option value="2">Không hoạt động</option>
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary" name="submit"
                            style="justify-self: flex-end;">Sửa</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$this->stop();
?>
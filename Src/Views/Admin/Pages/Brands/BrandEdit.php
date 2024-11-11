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
                    <form action="/admin/update-brand/<?=$data['id']?>" id="brandEdit" method="post" enctype="multipart/form-data">
                       

                        <div class="form-group">
                            <label>Tên Thương hiệu</label>
                            <input type="text" class="form-control form-control-lg" name="name"
                                placeholder="Tên thương hiệu" value="<?=$data['name']?>" aria-label="Category Name">
                        <small class="text-danger" style="display: none;" id="name-validate">* Vui lòng nhập tên thương hiệu</small>

                        </div>

                        <div class="form-group">
                            <label>Hình Ảnh Thương Hiệu</label>
                            <div class="mb-2">
                                <img src="<?=$_ENV['APP_URL']?>/public/Uploads/Brands/<?=$data['image']?>" alt="Current Image"
                                    style="max-width: 150px;">
                            </div>
                            <input type="file" class="form-control form-control-lg" name="image"
                                aria-label="Category Image">
                    <small class="text-danger" style="display: none;" id="image-validate">* Vui lòng tải hình thương hiệu</small>

                        </div>

                        <div class="form-group">
                            <label>Mô tả Thương hiệu</label>
                            <textarea class="form-control form-control-lg" name="description"
                                placeholder="Mô tả"><?=$data['description']?></textarea>
                    <small class="text-danger" style="display: none;" id="description-validate">* Vui lòng nhập mô tả thương hiệu</small>

                        </div>

                        <div class="form-group">
                            <label>Trạng thái</label>
                            <div class="form-check form-check-success">
                                <select class="form-control form-control-sm col-lg-2" name="status">
                                    <option value="1" <?=$data['status'] == 1 ? 'selected' : ''?>>Hoạt động</option>
                                    <option value="2" <?=$data['status'] == 2 ? 'selected' : ''?>>Không hoạt động</option>
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary"
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


<?php

$this->push('scripts')

?>

<script src="<?=$_ENV['APP_URL']?>/public\Assets\Admin\js\Pages\BrandScript.js"></script>


<?php
$this->end();
?>
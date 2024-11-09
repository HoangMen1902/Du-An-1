<?php $this->layout('Admin/Layouts/Layout') ?>


<?php 
$this->start('main_content');
?>

<div class="col-12 grid-margin">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Chỉnh sửa sản phẩm</h4>
            <form class="forms-sample" action="/admin/product/update/<?= $data['id'] ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $data['id'] ?>">
                <input type="hidden" name="method" value="POST">

                <div class="form-group">
                    <label for="name">Tên sản phẩm</label>
                    <input type="text" class="form-control" name="name" id="name" value="<?= htmlspecialchars($data['name']) ?>" placeholder="Tên sản phẩm">
                </div>

                <div class="form-group">
                    <label for="description">Mô tả sản phẩm</label>
                    <textarea class="form-control" id="description" rows="4" name="description"><?= htmlspecialchars($data['description']) ?></textarea>
                </div>

                <div class="form-group">
                    <label for="brand">Thương hiệu</label>
                    <input type="text" class="form-control" name="brand" id="brand" value="<?= htmlspecialchars($data['brand']) ?>" placeholder="Thương hiệu">
                </div>

                <div class="form-group">
                    <label for="total_quantity">Số lượng</label>
                    <input type="number" class="form-control" name="total_quantity" id="total_quantity" value="<?= $data['total_quantity'] ?>" placeholder="Số lượng">
                </div>

                <div class="form-group">
                    <label for="discount">Giảm giá (%)</label>
                    <input type="number" class="form-control" name="discount" id="discount" value="<?= $data['discount'] ?>" placeholder="Giảm giá">
                </div>

                <div class="form-group">
                    <label for="status">Trạng thái</label>
                    <select class="form-control" name="status" id="status">
                        <option value="1" <?= $data['status'] == 1 ? 'selected' : '' ?>>Hoạt động</option>
                        <option value="2" <?= $data['status'] == 2 ? 'selected' : '' ?>>Không hoạt động</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="image">Hình ảnh</label>
                    <input type="file" class="form-control" name="thumbnail" id="image" accept="image/*">

                    <?php if (!empty($data['thumbnail'])): ?>
                        <img src="<?=$_ENV['APP_URL'] ?>/public/Uploads/Products/<?= basename($data['thumbnail']) ?>" alt="Current Image" width="100px">
                    <?php endif; ?>
                </div>

                <button type="submit" class="btn btn-primary mr-2" name="submit">Cập nhật</button>
                <a href="/admin/products" class="btn btn-light">Hủy bỏ</a>
            </form>
            <?php if (!empty($errors)): ?>
                <div class="mt-5 alert alert-danger" role="alert">
                    <?php foreach ($errors as $error): ?>
                        <p><?= htmlspecialchars($error) ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>



<?php

$this->stop();
?>
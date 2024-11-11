<?php
include './src/views/admin/layouts/header.php';
?>
<?php
include './src/views/admin/layouts/navbar.php';
?>
<div class="container-fluid page-body-wrapper">
<?php
include './src/views/admin/layouts/sidebar.php';
?>

<div class="col-12 grid-margin">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Chỉnh sửa sản phẩm</h4>
            <form class="forms-sample" action="/admin/update-product" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $result['id']; ?>">
                <input type="hidden" name="method" value="POST">

                <div class="form-group">
                    <label for="name">Tên sản phẩm</label>
                    <input type="text" class="form-control" name="name" id="name" value="<?= $result['name']; ?>" placeholder="Name">
                </div>
                
                <div class="form-group">
                    <label for="description">Mô tả sản phẩm</label>
                    <textarea class="form-control" id="description" rows="4" name="description"><?= $result['description']; ?></textarea>
                </div>

                <div class="form-group">
                    <label for="price">Giá tiền</label>
                    <input type="number" class="form-control" name="price" id="price" value="<?= $result['price']; ?>" placeholder="Price">
                </div>

                <div class="form-group">
                    <label for="quantity">Số lượng</label>
                    <input type="number" class="form-control" name="quantity" id="quantity" value="<?= $result['quantity']; ?>" placeholder="Quantity">
                </div>
                <div class="form-group">
                    <label for="discountRate">Giá giảm (%)</label>
                    <input type="number" class="form-control" name="discountRate" id="discountRate" value="<?= $result['discountRate']; ?>" placeholder="Discount Rate">
                </div>

                <div class="form-group">
                    <label for="weight">Trọng lượng (kg)</label>
                    <input type="number" class="form-control" name="weight" id="weight" value="<?= $result['weight']; ?>" placeholder="Weight">
                </div>

                <div class="form-group">
                    <label for="height">Chiều cao (cm)</label>
                    <input type="number" class="form-control" name="height" id="height" value="<?= $result['height']; ?>" placeholder="Height">
                </div>

                <div class="form-group">
                    <label for="width">Chiều rộng (cm)</label>
                    <input type="number" class="form-control" name="width" id="width" value="<?= $result['width']; ?>" placeholder="Width">
                </div>

                <div class="form-group">
                    <label for="image">Hình ảnh</label>
                    <input type="file" name="image" class="form-control file-upload-info" placeholder="Upload Image">
                    <?php if ($result['image']): ?>
                        <img src="/public/uploads/<?= $result['image']; ?>" alt="Current Image" width="100px">
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="thumbnail">Thumbnail</label>
                    <input type="file" name="thumbnail" class="form-control file-upload-info" placeholder="Upload Thumbnail">
                    <?php if ($result['thumbnail']): ?>
                        <img src="/public/uploads/<?= $result['thumbnail']; ?>" alt="Current Thumbnail" width="100px">
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label>Trạng thái</label>
                    <div class="form-check form-check-success ">
                    <select class="form-control form-control-sm col-lg-2" name="status">
                        <option value="1" <?= ($result['status'] == 1) ? 'selected' : ''; ?>>Hoạt động</option>
                        <option value="2" <?= ($result['status'] == 2) ? 'selected' : ''; ?>>Không hoạt động</option>
                    </select>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary mr-2" name="submit">Cập nhật</button>
                <a href="/admin?url=products" class="btn btn-light">Hủy bỏ</a>
            </form>
        </div>
    </div>
</div>

<?php
include 'src/views/admin/layouts/footer.php';
?>


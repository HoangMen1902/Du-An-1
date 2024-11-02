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

    <div class="col-12 grid-margin ">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Chi tiết sản phẩm</h4>
                <form class="forms-sample" action="/admin?url=product-store" method="post" enctype="multipart/form-data"></form>
                <div class="form-group">
                    <label for="name">Tên sản phẩm</label>
                    <input type="text" class="form-control" name="name" id="name" value="<?= $result['name']; ?>" placeholder="Name" readonly>
                </div>
                <div class="form-group">
                    <label for="description">Mô tả sản phẩm</label>
                    <textarea class="form-control" id="description" rows="4" name="description" readonly><?= $result['description']; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="description">Thương hiệu</label>
                    <textarea class="form-control" id="description" rows="4" name="description" readonly><?= $result['brand_id']; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="description">Loại sản phẩm</label>
                    <textarea class="form-control" id="description" rows="4" name="description" readonly><?= $result['category_id']; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="price">Giá tiền</label>
                    <input type="number" class="form-control" name="price" id="price" value="<?= $result['priceAfterSale']; ?>" placeholder="Price" readonly>

                </div>
                <div class="form-group">
                    <label for="quantity">Số lượng</label>
                    <input type="number" class="form-control" name="quantity" id="quantity" value="<?= $result['quantity']; ?>" placeholder="Quantity" readonly>
                </div>
                <div class="form-group">
                    <label for="discountPrice">Giá giảm (VNĐ)</label>
                    <input type="number" class="form-control" name="discountPrice" id="discountPrice" value="<?= $result['reducedPrice']; ?>" placeholder="Discount Price" readonly>
                </div>
                <div class="form-group">
                    <label for="discountRate">Giá giảm (%)</label>
                    <input type="number" class="form-control" name="discountRate" id="discountRate" value="<?= $result['discountRate']; ?>" placeholder="Discount Rate" readonly>
                    <span class="text-danger"><?= $errors['discountRate'] ?? ''; ?></span>
                </div>
                <div class="form-group">
                    <label for="weight">Trọng lượng (kg)</label>
                    <input type="number" class="form-control" name="weight" id="weight" value="<?= $result['weight']; ?>" placeholder="Weight" readonly>
                </div>
                <div class="form-group">
                    <label for="height">Chiều cao (cm)</label>
                    <input type="number" class="form-control" name="height" id="height" value="<?= $result['height']; ?>" placeholder="Height" readonly>
                </div>
                <div class="form-group">
                    <label for="width">Chiều rộng (cm)</label>
                    <input type="number" class="form-control" name="width" id="width" value="<?= $$result['width']; ?>" placeholder="Width" readonly>
                </div>
                <div class="form-group">
                    <label for="image">Hình ảnh</label> <br>
                    <img src="/public/uploads/<?= $result['image']; ?>" alt="Current Image" width="100px">
                </div>
                <div class="form-group">
                    <label for="thumbnail">Thumbnail</label> <br>
                    <img src="/public/uploads/<?= $result['thumbnail']; ?>" alt="Current Thumbnail" width="100px">
                </div>
                <div class="form-group">
                    <label>Trạng thái</label>
                    <div class="form-check form-check-success ">
                    <input type="text" class="form-control" name="status" value="<?= ($result['status'] == 1) ? "Hoạt động" : "Không hoạt động" ?>" readonly>
                    </div>
                </div>
                <a href="/admin/products" class="btn btn-light">Quay lại</a>
                </form>
            </div>
        </div>

    </div>
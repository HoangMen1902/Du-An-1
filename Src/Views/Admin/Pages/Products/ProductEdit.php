<?php

namespace App\Views\Admin\Pages\Products;

use App\Views\BaseView;

class ProductEdit extends BaseView
{
    public static function render($data = null, $brands = null, $categories = null)
    {


?>

        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Chỉnh sửa sản phẩm</h4>
                    <form class="forms-sample" action="/admin/update-product/<?= $data['id'] ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= $data['id']; ?>">
                        <input type="hidden" name="method" value="POST">

                        <div class="form-group">
                            <label for="name">Tên sản phẩm</label>
                            <input type="text" class="form-control" name="name" id="name" value="<?= $data['name']; ?>"
                                placeholder="Name">
                        </div>

                        <div class="form-group">
                            <label for="description">Mô tả sản phẩm</label>
                            <textarea class="form-control" id="description" rows="4"
                                name="description"><?= $data['description']; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="brand_id">Thương hiệu</label>
                            <select readonly class="form-control" id="brand_id" name="brand_id">
                                <?php
                                if ($brands):
                                ?>
                                    <option value="<?= $data['brand_id']; ?>"><?= $data['brand_name']; ?></option>
                                    <?php foreach ($brands as $brand): ?>
                                        <option disabled value="<?= $brand['id']; ?>" <?= (isset($_POST['brand_id']) && $_POST['brand_id'] == $brand['id']) ? 'selected' : ''; ?>><?= $brand['name']; ?></option>
                                <?php
                                    endforeach;
                                endif;
                                ?>

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="category_id">Phân loại sản phẩm</label>
                            <select readonly class="form-control" id="category_id" name="category_id">
                                <?php
                                if ($categories):
                                ?>
                                    <option value="<?= $data['category_id']; ?>"><?= $data['category_name']; ?></option>
                                    <?php foreach ($categories as $category): ?>
                                        <option disabled value="<?= $category['id']; ?>" <?= (isset($_POST['category_id']) && $_POST['category_id'] == $category['id']) ? 'selected' : ''; ?>><?= $category['name']; ?>
                                        </option>
                                <?php
                                    endforeach;
                                endif;
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="price">Giá tiền</label>
                            <input type="number" class="form-control" name="price" id="price" value="<?= $data['price']; ?>"
                                placeholder="Price">
                        </div>

                        <div class="form-group">
                            <label for="quantity">Số lượng</label>
                            <input type="number" class="form-control" name="quantity" id="quantity"
                                value="<?= $data['quantity']; ?>" placeholder="Quantity">
                        </div>
                        <div class="form-group">
                            <label for="discountRate">Giá giảm (%)</label>
                            <input type="number" class="form-control" name="discountRate" id="discountRate"
                                value="<?= $data['discountRate']; ?>" placeholder="Discount Rate">
                        </div>

                        <div class="form-group">
                            <label for="weight">Trọng lượng (kg)</label>
                            <input type="number" class="form-control" name="weight" id="weight" value="<?= $data['weight']; ?>"
                                placeholder="Weight">
                        </div>

                        <div class="form-group">
                            <label for="height">Chiều cao (cm)</label>
                            <input type="number" class="form-control" name="height" id="height" value="<?= $data['height']; ?>"
                                placeholder="Height">
                        </div>

                        <div class="form-group">
                            <label for="width">Chiều rộng (cm)</label>
                            <input type="number" class="form-control" name="width" id="width" value="<?= $data['width']; ?>"
                                placeholder="Width">
                        </div>

                        <div class="form-group">
                            <label for="image">Hình ảnh</label>
                            <input type="file" name="image" class="form-control file-upload-info" placeholder="Upload Image">
                            <?php if ($data['image']): ?>
                                <img src="/public/uploads/<?= $data['image']; ?>" alt="Current Image" width="100px">
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="thumbnail">Thumbnail</label>
                            <input type="file" name="thumbnail[]" multiple class="form-control file-upload-info"
                                placeholder="Upload Thumbnail">
                            <?php if ($data['thumbnail']): ?>
                                <img src="/public/uploads/<?= $data['thumbnail']; ?>" alt="Current Thumbnail" width="100px">
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label>Trạng thái</label>
                            <div class="form-check form-check-success ">
                                <select class="form-control form-control-sm col-lg-2" name="status">
                                    <option value="1" <?= ($data['status'] == 1) ? 'selected' : ''; ?>>Hoạt động</option>
                                    <option value="2" <?= ($data['status'] == 2) ? 'selected' : ''; ?>>Không hoạt động</option>
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary mr-2" name="submit">Cập nhật</button>
                        <a href="/admin/products" class="btn btn-light">Hủy bỏ</a>
                    </form>
                </div>
            </div>
        </div>

<?php

    }
}

?>
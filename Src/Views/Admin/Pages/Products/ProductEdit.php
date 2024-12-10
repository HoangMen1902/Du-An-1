<?php $this->layout('Admin/Layouts/Layout') ?>

<?php
$this->push('styles');
?>
<style>
    .cke_notification {
        display: none !important;
    }
</style>
<?php
$this->end();
?>
<?php
$this->start('main_content');
$thumbnail = explode(',', $data['thumbnail']);
?>
<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Sửa sản phẩm</h4>
            <form action="/admin/product/update/<?= $data['product_id'] ?>" id="productAddForm" method="post" enctype="multipart/form-data">

                <p class="card-description">Thông tin sản phẩm</p>
                <div class="form-group">
                    <label for="name">Tên sản phẩm</label>
                    <input type="text" class="form-control" name="name" placeholder="Tên sản phẩm" value="<?= htmlspecialchars($data['product_name'] ?? '') ?>">
                    <small id="name-required" class="text-danger" style="display:none">Vui lòng nhập tên sản phẩm</small>
                </div>
                <div class="form-group">
                    <label for="description">Mô tả ngắn</label>
                    <textarea class="form-control" name="short_description" id="short_description" rows="2" placeholder="Mô tả sản phẩm"><?= htmlspecialchars($data['short_description'] ?? '') ?></textarea>
                    <small id="description-required" class="text-danger" style="display:none">Vui lòng nhập mô tả sản phẩm</small>
                </div>

                <div class="form-group">
                    <label for="description">Mô tả sản phẩm</label>
                    <textarea class="form-control" name="description" rows="4" placeholder="Mô tả sản phẩm"><?= $data['product_description'] ?></textarea>
                    <small id="description-required" class="text-danger" style="display:none">Vui lòng nhập mô tả sản phẩm</small>
                </div>

                <div class="form-group">
                    <label for="brand">Thương hiệu</label>
                    <select class="form-control" name="brand_id">
                        <?php
                        if (isset($brands) && !empty($brands)):
                            foreach ($brands as $brand):
                        ?>
                                <option value="<?= $brand['id'] ?>" <?= $brand['id'] == $data['brand_id'] ? 'selected' : '' ?>><?= $brand['name'] ?></option>
                            <?php
                            endforeach;
                        else :
                            ?>
                            <option value="">Không có thương hiệu</option>

                        <?php
                        endif;
                        ?>
                    </select>
                    <small id="brand-required" class="text-danger" style="display:none">Vui lòng chọn thương hiệusản phẩm</small>

                </div>
                <div class="form-group">
                    <label for="categories">Danh mục cha:</label>
                    <select class="form-control" id="categories" name="categories">
                        <option value="">Chọn danh mục cha</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= $category['id'] ?>" <?= $product_category['category_id'] == $category['id'] ? 'selected' : '' ?>><?= $category['name'] ?></option>
                        <?php endforeach; ?>
                    </select>

                    <div id="child_category">
                        <label for="child_category">Danh mục con:</label>
                        <select class="form-control" id="child_category" name="child_category">
                            <option value="">Chọn danh mục con</option>
                            <?php
                            foreach ($child_category as $index => $child):
                            ?>
                                <option value="<?= $child['id'] ?>" <?= $child['id'] === $data['category_values_id'] ? 'selected' : '' ?>><?= $child['name'] ?></option>
                            <?php
                            endforeach;
                            ?>
                        </select>
                    </div>
                    <small id="categories-required" class="text-danger" style="display:none">Vui lòng chọn danh mục sản phẩm</small>
                </div>



                <div class="form-group">
                    <label for="discount">Giá giảm (%)</label>
                    <input type="number" class="form-control" name="discount" placeholder="Giảm giá" min="0" max="100" value="<?= htmlspecialchars($data['discount'] ?? '') ?>">
                    <small id="discount-required" class="text-danger" style="display:none">Vui lòng nhập giá giảm</small>
                </div>

                <div class="form-group">
                    <label for="thumbnail">Hình ảnh sản phẩm</label>
                    <input type="file" class="form-control" name="thumbnail[]" accept="image/*" multiple id="thumbnail">
                    <img id="blah" src="#" alt="your image" style="display: none; max-width:15%" />


                    <?php
                    foreach ($thumbnail as $item):
                    ?>
                        <img src="<?= $_ENV['APP_URL'] ?>/public\Uploads\Products/<?= $item ?>" style="max-width: 15%" class="current-thumbnail">
                    <?php
                    endforeach;
                    ?>
                </div>
                <div class="form-group">

                </div>
                <div class="form-group">
                    <label for="status">Trạng thái</label>
                    <select class="form-control" name="status">
                        <option value="1" <?= isset($data['status']) && $data['status'] == 1 ? 'selected' : '' ?>>Hoạt động</option>
                        <option value="2" <?= isset($data['status']) && $data['status'] == 2 ? 'selected' : '' ?>>Không hoạt động</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Sửa</button>
            </form>
        </div>
    </div>
</div>



<?php

$this->stop();
?>

<?php

$this->push('scripts');

?>
<script src="<?= $_ENV['APP_URL'] ?>/node_modules\ckeditor4\ckeditor.js"></script>

<script>
    CKEDITOR.replace('description', {
        height: 300,
    });

    thumbnail.onchange = evt => {
        let [file] = thumbnail.files
        if (file) {
            console.log(file);
            blah.src = URL.createObjectURL(file)
            $('.current-thumbnail').hide();
            $('#blah').show();
        }
    }
</script>
<script src="<?= $_ENV['APP_URL'] ?>/public\Assets\Admin\js\Pages\ProductValidate.js"></script>

<?php
$this->end();
?>
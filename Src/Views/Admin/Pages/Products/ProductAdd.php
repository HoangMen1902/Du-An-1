<?php $this->layout('Admin/Layouts/Layout') ?>

<?php
$this->start('main_content');
?>

<?php
if (isset($_GET['status']) && $_GET['status'] === 'success') {
?>
    <div class="alert alert-success mt-5">
        <p class="m-0">Đã thêm thành công</p>
    </div>
<?php
} else if (isset($_GET['status']) && $_GET['status'] === 'failed') {
?>
    <div class="alert alert-danger mt-5">
        <p class="m-0">Đã thêm thất bại</p>
    </div>
<?php
}
?>

<?php if (!empty($errors)): ?>
    <div class="alert alert-danger" role="alert">
        <?php foreach ($errors as $error): ?>
            <p><?= htmlspecialchars($error) ?></p>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Thêm sản phẩm</h4>
            <form action="/admin/product/store" method="post" enctype="multipart/form-data">

                <p class="card-description">Thông tin sản phẩm</p>
                <div class="form-group">
                    <label for="name">Tên sản phẩm</label>
                    <input type="text" class="form-control" name="name" placeholder="Tên sản phẩm" value="<?= htmlspecialchars($data['name'] ?? '') ?>">
                </div>

                <div class="form-group">
                    <label for="description">Mô tả sản phẩm</label>
                    <textarea class="form-control" name="description" rows="4" placeholder="Mô tả sản phẩm"><?= htmlspecialchars($data['description'] ?? '') ?></textarea>
                </div>

                <div class="form-group">
                    <label for="brand">Thương hiệu</label>
                    <select class="form-control" name="brand">
                        <?php
                        if (isset($brands) && !empty($brands)):
                            foreach ($brands as $brand):
                        ?>
                                <option value="<?= $brand['id'] ?>"><?= $brand['name'] ?></option>
                            <?php
                            endforeach;
                        else :
                            ?>
                            <option value="">Không có thương hiệu</option>

                        <?php
                        endif;
                        ?>
                    </select>
                </div>
                    <div class="form-group">
                        <label for="categories">Danh mục cha:</label>
                        <select class="form-control" id="categories" name="categories" required>
                            <option value="">Chọn danh mục cha</option>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                            <?php endforeach; ?>
                        </select>

                        <div id="child_category" style="display:none;">
                            <label for="child_category">Danh mục con:</label>
                            <select class="form-control" id="child_category" name="child_category">
                                <option value="">Chọn danh mục con</option>
                            </select>
                        </div>
                    </div>



                <div class="form-group">
                    <label for="discount">Giá giảm (%)</label>
                    <input type="number" class="form-control" name="discount" placeholder="Giảm giá" min="0" max="100" value="<?= htmlspecialchars($data['discount'] ?? '') ?>">
                </div>

                <div class="form-group">
                    <label for="thumbnail">Hình ảnh sản phẩm</label>
                    <input type="file" class="form-control" name="thumbnail" accept="image/*">
                </div>

                <div class="form-group">
                    <label for="specifications_file">Tải lên file Excel cho thông số kỹ thuật (.xls hoặc .xlsx)</label>
                    <input type="file" class="form-control" name="specifications_file" accept=".xls, .xlsx">
                </div>

                <div class="form-group">
                    <label for="status">Trạng thái</label>
                    <select class="form-control" name="status">
                        <option value="1" <?= isset($data['status']) && $data['status'] == 1 ? 'selected' : '' ?>>Hoạt động</option>
                        <option value="2" <?= isset($data['status']) && $data['status'] == 2 ? 'selected' : '' ?>>Không hoạt động</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Thêm biến thể</label>
                    <div id="sku_section">
                        
                    </div>
                    <a href="javascript:void(0)" onclick="addSku()" class="btn btn-success mt-3">Thêm SKU</a>
                </div>

                <button type="submit" name="submit" class="btn btn-primary">Thêm sản phẩm</button>
            </form>
        </div>
    </div>
</div>



<?php $this->stop(); ?>
<?php

$this->push('scripts');
?>
<script>
    let skuIndex = 0;
    let optionIndex = 0
    let optionValueIndex = 0

    function addSku() {
        skuIndex++;
        $('#sku_section').append(`
            <div class="sku-item row mb-3" id="sku-item-${skuIndex}">
                <div class="col-md-3">
                    <label>Mã SKU</label>
                    <input type="text" name="sku[${skuIndex}][sku]" class="form-control" placeholder="SKU">
                </div>
                <div class="col-md-3">
                    <label>Giá gốc</label>
                    <input type="number" name="sku[${skuIndex}][price]" class="form-control" placeholder="Giá">
                </div>
                <div class="col-md-3">
                    <label>Số lượng</label>
                    <input type="number" name="sku[${skuIndex}][quantity]" class="form-control" placeholder="Số lượng">
                </div>
                <div class="col-md-3">
                    <label>Hình ảnh</label>
                    <input type="file" name="sku[${skuIndex}][images]" class="form-control" >
                </div>
                <div class="col-12 properties-container mt-2">
                    <!-- Dynamic property fields go here -->
                </div>
                <div class="col-12 mt-3">
                    <a href="javascript:void(0)" onclick="addProperty(this)" class="btn btn-primary">Thêm Thuộc tính</a>
                    <a href="javascript:void(0)" onclick="removeSku(${skuIndex})" class="btn btn-danger">Xóa SKU</a>
                </div>
            </div>
        `);
    }

    function addProperty(element) {
        optionIndex++;
        const propertyContainer = $(element).closest('.sku-item').find('.properties-container');
        propertyContainer.append(`
            <div class="row mb-2">
                <div class="col-md-5">
                    <label>Tên thuộc tính</label>
                    <select name="sku[${skuIndex}][option][${optionIndex}][option_id]" class="form-control">
                        <option value="">Chọn thuộc tính</option>
                        <?php foreach ($options as $attribute): ?>
                            <option value="<?= $attribute['id'] ?>"><?= htmlspecialchars($attribute['name']) ?></option>
                        <?php endforeach; ?>
                    </select>

                </div>
                <div class="col-md-5">t
                    <label>Giá trị</label>
                    <input type="text" name="sku[${skuIndex}][option][${optionIndex}][value_name]" class="form-control" placeholder="Đen, trắng, ...">
                </div>
                <div class="col-md-2 d-flex align-items-end justify-content-center">
                    <a href="javascript:void(0)" onclick="removeProperty(this)" class="btn btn-danger">Xóa</a>
                </div>
            </div>
        `);
    }

    function removeProperty(element) {
        $(element).closest('.row').remove();
        optionIndex--;
    }

    function removeSku(skuIndex) {
        $('#sku-item-' + skuIndex).remove();
        skuIndex--;
    }
</script>
<script src="<?= $_ENV['APP_URL'] ?>/public\Assets\Admin\js\Pages\ProductValidate.js"></script>
<?php

$this->end();

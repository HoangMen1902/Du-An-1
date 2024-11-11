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
                    <input type="text" class="form-control form-control-lg" placeholder="Tên sản phẩm" name="name"
                        value="<?= htmlspecialchars($data['name'] ?? '') ?>">
                </div>

                <div class="form-group">
                    <label for="description">Mô tả sản phẩm</label>
                    <textarea class="form-control" name="description" rows="4"
                        placeholder="Mô tả sản phẩm"><?= htmlspecialchars($data['description'] ?? '') ?></textarea>
                </div>

                <div class="form-group">
                    <label for="total_quantity">Số lượng</label>
                    <input type="number" class="form-control" name="total_quantity" placeholder="Số lượng sản phẩm"
                        value="<?= htmlspecialchars($data['total_quantity'] ?? '') ?>">
                </div>

                <div class="form-group">
                    <label for="brand">Thương hiệu</label>
                    <input type="text" class="form-control" name="brand" placeholder="Nhập tên thương hiệu"
                        value="<?= htmlspecialchars($data['brand'] ?? '') ?>">
                </div>

                <div class="form-group">
                    <label for="discount">Giá giảm (%)</label>
                    <input type="number" class="form-control" name="discount" placeholder="Giảm giá" min="0" max="100"
                        value="<?= htmlspecialchars($data['discount'] ?? '') ?>">
                </div>
                <div class="form-group">
                    <label for="image">Hình ảnh sản phẩm</label>
                    <input type="file" class="form-control" name="thumbnail" id="image" accept="image/*">

                    <?php if (!empty($data['thumbnail'])): ?>
                        <div class="mt-2">
                            <p>Hình ảnh hiện tại:</p>
                            <img src="<?= htmlspecialchars($data['thumbnail']) ?>" alt="Hình ảnh sản phẩm"
                                style="max-width: 200px;">
                        </div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="specifications_file">Tải lên file Excel cho thông số kỹ thuật <span class="text-danger">(.xls hoặc .xlsx)</span></label>
                    <input type="file" class="form-control" name="specifications_file" id="specifications_file" accept=".xls, .xlsx">
                </div>

                <div class="form-group">
                    <label for="status">Trạng thái</label>
                    <select class="form-control form-control-sm col-lg-2" name="status">
                        <option value="1" <?= isset($data['status']) && $data['status'] == 1 ? 'selected' : '' ?>>Hoạt động</option>
                        <option value="2" <?= isset($data['status']) && $data['status'] == 2 ? 'selected' : '' ?>>Không hoạt động</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="properties">Thuộc tính</label>
                    <a href="javascript:void(0)" onclick="createProperty()" class="btn btn-primary btn-sm">Thêm thuộc tính</a>
                    <div id="multi_properties">
                        <div class="row items_properties mb-3">
                            <div class="col-5">
                                <label for="option_id">Tên thuộc tính</label>
                                <select name="option_id[]" class="form-control">
                                    <option value="">Chọn thuộc tính</option>
                                    <?php foreach ($attributes as $attribute): ?>
                                        <option value="<?= $attribute['id'] ?>"><?= htmlspecialchars($attribute['name']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-5">
                                <label for="option_vl_name">Giá trị</label>
                                <input type="text" class="form-control" name="option_vl_name[]" placeholder="Giá trị thuộc tính">
                            </div>
                            <div class="col-1">
                                <label for="">&nbsp;</label>
                                <a href="javascript:void(0)" onclick="deleteProperty(this)" class="btn btn-danger btn-sm d-block">Xóa</a>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" name="submit" class="btn btn-primary">Thêm sản phẩm</button>
            </form>


        </div>
    </div>
</div>

<script>
    function createProperty() {
        $("#multi_properties").append(`
            <div class="row items_properties mb-3">
                <div class="col-5">
                    <label for="option_id">Tên thuộc tính</label>
                    <select name="option_id[]" class="form-control">
                        <option value="">Chọn thuộc tính</option>
                        <?php foreach ($attributes as $attribute): ?>
                            <option value="<?= $attribute['id'] ?>"><?= htmlspecialchars($attribute['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-5">
                    <label for="option_vl_name">Giá trị</label>
                    <input type="text" class="form-control" name="option_vl_name[]" placeholder="Giá trị thuộc tính">
                </div>
                <div class="col-1">
                    <label for="">&nbsp;</label>
                    <a href="javascript:void(0)" onclick="deleteProperty(this)" class="btn btn-danger btn-sm d-block">Xóa</a>
                </div>
            </div>
        `);
    }

    function deleteProperty(element) {
        $(element).closest(".items_properties").remove();
    }
</script>

<?php
$this->stop();
?>
<?php
$this->push('scripts');
?>
<script src="<?= $_ENV['APP_URL'] ?>/public/Assets/Admin/js/Pages/ProductValidate.js"></script>
<?php
$this->end();
?>
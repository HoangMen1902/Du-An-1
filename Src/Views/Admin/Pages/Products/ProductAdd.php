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
            <h4 class="card-title">
                Thêm Option cho Thuộc Tính
            </h4>

            <form action="/admin/option-add" method="post">
                <input type="hidden" name="method" value="POST">

                <div class="form-group">
                    <label>Chọn Thuộc Tính</label>
                    <select name="attribute_id" class="form-control">
                        <option value="">Chọn thuộc tính</option>
                        <?php foreach ($attributes as $attribute): ?>
                            <option value="<?= $attribute['id'] ?>" <?= isset($attribute_id) && $attribute_id == $attribute['id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($attribute['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <!-- Display error for attribute_id -->
                    <?php if (isset($errors['attribute_id'])): ?>
                        <div class="text-danger"><?= htmlspecialchars($errors['attribute_id']) ?></div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label>Tên Option</label>
                    <input type="text" class="form-control form-control-lg" placeholder="Tên option"
                           name="option_name" value="<?= isset($option_name) ? htmlspecialchars($option_name) : '' ?>">
                    <!-- Display error for option_name -->
                    <?php if (isset($errors['option_name'])): ?>
                        <div class="text-danger"><?= htmlspecialchars($errors['option_name']) ?></div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label>Trạng Thái</label>
                    <div class="form-check form-check-success">
                        <select class="form-control form-control-sm col-lg-2" name="status">
                            <option value="1" <?= isset($status) && $status == 1 ? 'selected' : '' ?>>Hoạt động</option>
                            <option value="2" <?= isset($status) && $status == 2 ? 'selected' : '' ?>>Không hoạt động</option>
                        </select>
                    </div>
                </div>

                <button type="submit" name="submit" class="btn btn-primary" style="justify-self: flex-end;">
                    Thêm Option
                </button>
            </form>

            <!-- Error Message Section -->
            <?php if (!empty($errors)): ?>
                <div class="mt-5 alert alert-danger" role="alert">
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li><?= htmlspecialchars($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

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

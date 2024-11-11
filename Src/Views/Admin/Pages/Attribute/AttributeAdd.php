<?php $this->layout('Admin/Layouts/Layout') ?>

<?php
$this->start('main_content');
?>

<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <?= isset($isOption) && $isOption ? 'Thêm Option cho Thuộc Tính' : 'Thêm Thuộc Tính' ?>
            </h4>

            <?php if (isset($_SESSION['status_message'])): ?>
                <div class="alert alert-success">
                    <?= htmlspecialchars($_SESSION['status_message']) ?>
                </div>
                <?php unset($_SESSION['status_message']); ?>
            <?php endif; ?>

            <form action="<?= isset($isOption) && $isOption ? '/admin/option-add' : '/admin/attribute-add' ?>" method="post">
                <input type="hidden" name="method" value="POST">

                <?php if (isset($isOption) && $isOption): ?>
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
                        <?php if (isset($errors['attribute_id'])): ?>
                            <div class="text-danger"><?= htmlspecialchars($errors['attribute_id']) ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label>Tên Option</label>
                        <input type="text" class="form-control form-control-lg" placeholder="Tên option"
                               name="option_name" value="<?= isset($option_name) ? htmlspecialchars($option_name) : '' ?>">
                        <?php if (isset($errors['option_name'])): ?>
                            <div class="text-danger"><?= htmlspecialchars($errors['option_name']) ?></div>
                        <?php endif; ?>
                    </div>
                <?php else: ?>
                    <div class="form-group">
                        <label>Tên Thuộc Tính</label>
                        <input type="text" class="form-control form-control-lg" placeholder="Tên thuộc tính"
                               name="name" value="<?= isset($name) ? htmlspecialchars($name) : '' ?>">
                        <?php if (isset($errors['name'])): ?>
                            <div class="text-danger"><?= htmlspecialchars($errors['name']) ?></div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

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
                    <?= isset($isOption) && $isOption ? 'Thêm Option' : 'Thêm Thuộc Tính' ?>
                </button>
            </form>

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

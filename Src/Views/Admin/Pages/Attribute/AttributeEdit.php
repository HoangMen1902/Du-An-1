<?php $this->layout('Admin/Layouts/Layout') ?>

<?php 
$this->start('main_content');
?>

<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Sửa Thuộc Tính</h4>

            <!-- Hiển thị thông báo thành công nếu có -->
            <?php if (isset($_SESSION['status_message'])): ?>
                <div class="alert alert-success">
                    <?= htmlspecialchars($_SESSION['status_message']) ?>
                </div>
                <?php unset($_SESSION['status_message']); // Xóa thông báo sau khi hiển thị ?>
            <?php endif; ?>

            <form action="/admin/attribute-update/<?= $data['id'] ?>" method="post">
                <input type="hidden" name="method" value="POST">

                <div class="form-group">
                    <label>Tên Thuộc Tính</label>
                    <input type="text" class="form-control form-control-lg" placeholder="Tên thuộc tính"
                           name="name" value="<?= isset($data['name']) ? htmlspecialchars($data['name']) : '' ?>">
                    <?php if (isset($errors['name'])): ?>
                        <div class="text-danger"><?= htmlspecialchars($errors['name']) ?></div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label>Trạng Thái</label>
                    <div class="form-check form-check-success">
                        <select class="form-control form-control-sm col-lg-2" name="status">
                            <option value="1" <?= isset($data['status']) && $data['status'] == 1 ? 'selected' : '' ?>>Hoạt động</option>
                            <option value="2" <?= isset($data['status']) && $data['status'] == 2 ? 'selected' : '' ?>>Không hoạt động</option>
                        </select>
                    </div>
                </div>

                <button type="submit" name="submit" class="btn btn-primary" style="justify-self: flex-end;">
                    Cập nhật Thuộc Tính
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

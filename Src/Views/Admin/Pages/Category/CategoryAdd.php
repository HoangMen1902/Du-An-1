<?php $this->layout('Admin/Layouts/Layout') ?>


<?php
$this->start('main_content');
?>
<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Thêm phân loại</h4>
            <form action="/admin/category/store" method="post">
                <input type="hidden" name="method" value="POST">
                <div class="form-group">
                    <label>Tên phân loại</label>
                    <input type="text" class="form-control form-control-lg" placeholder="Bàn phím.." aria-label="Category Name" name="name" value="<?= htmlspecialchars($data['name'] ?? '') ?>">
                </div>

                <div class="form-group">
                    <label>Trạng thái</label>
                    <select class="form-control form-control-sm col-lg-2" name="status">
                        <option value="1" <?= (isset($data['status']) && $data['status'] == 1) ? 'selected' : '' ?>>Hoạt động</option>
                        <option value="2" <?= (isset($data['status']) && $data['status'] == 2) ? 'selected' : '' ?>>Không hoạt động</option>
                    </select>
                </div>
                
                <button type="submit" name="submit" class="btn btn-primary" style="justify-self: flex-end;">Thêm</button>
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




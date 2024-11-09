<?php $this->layout('Admin/Layouts/Layout') ?>

<?php $this->start('main_content'); ?>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Sửa danh mục con</h4>
                    
                    <?php if (!empty($errors)): ?>
                        <div class="alert alert-danger">
                            <?php foreach ($errors as $error): ?>
                                <p><?= htmlspecialchars($error) ?></p>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <form action="/admin/category/value/update/<?= $categoryValue['id'] ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="method" value="POST">

                        <div class="form-group">
                            <label for="id">ID</label>
                            <input type="text" class="form-control" id="id" name="id" value="<?= htmlspecialchars($categoryValue['id']) ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label for="name">Tên danh mục con</label>
                            <input type="text" class="form-control" name="name" value="<?= htmlspecialchars($categoryValue['name']) ?>" placeholder="Nhập tên giá trị..." aria-label="Category Value Name">
                        </div>

                        <div class="form-group">
                            <label for="status">Trạng thái</label>
                            <select class="form-control form-control-sm col-lg-2" name="status">
                                <option value="1" <?= $categoryValue['status'] == 1 ? 'selected' : '' ?>>Hoạt động</option>
                                <option value="0" <?= $categoryValue['status'] == 0 ? 'selected' : '' ?>>Không hoạt động</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="category_id">Danh mục</label>
                            <select class="form-control" name="category_id">
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?= $category['id'] ?>"
                                        <?= $category['id'] == $categoryValue['category_id'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($category['name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary" name="submit">Sửa</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php $this->stop(); ?>
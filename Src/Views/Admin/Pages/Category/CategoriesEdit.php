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
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Sửa phân loại</h4>
                <form action="/admin/category-edit" method="post">
                    <input type="hidden" name="method" value="POST">
                    <div class="form-group">
                        <label>Tên phân loại</label>
                        <input type="text" class="form-control form-control-lg" placeholder="ID" aria-label="ID" name="id" value="<?= $categoriesData['id'];?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Tên phân loại</label>
                        <input type="text" class="form-control form-control-lg" placeholder="Bàn phím.." aria-label="Category Name" name="name" value="<?= $categoriesData['name']; ?>">
                    </div>
                    <div class="form-group">
                    <label>Mô tả loại sản phẩm</label>
                    <input type="text" class="form-control form-control-lg" placeholder="Bàn phím.." aria-label="Category Name" name="description">
                </div>
                    <div class="form-group">
                        <label>Trạng thái</label>
                        <div class="form-check form-check-success ">
                            <select class="form-control form-control-sm col-lg-2" name="status">
                                <option value="1" <?= $categoriesData['status'] == 1 ? 'selected' : ''; ?>>Hoạt động</option>
                                <option value="2" <?= $categoriesData['status'] == 2 ? 'selected' : ''; ?>>Không hoạt động</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary" style="justify-self: flex-end;">Sửa</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
include './src/views/admin/layouts/footer.php';
?>
<?php $this->layout('Admin/Layouts/Layout') ?>



<?php $this->start('main_content'); ?>
<?php

if(isset($_GET['status']) && $_GET['status'] === 'success') {
    ?>
            <div class="alert alert-success mt-5">
                <p class="m-0">Thao tác thành công</p>
            </div>
    <?php
 
}   else if(isset($_GET['status']) && $_GET['status'] === 'failed'){
   ?>
    <div class="alert alert-danger mt-5">
                <p class="m-0">Thao tác thất bại</p>
            </div>
<?php
}
?>
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Danh sách danh mục con</h4>
            <div class="table-responsive pt-3">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên danh mục cha</th>
                            <th>Tên danh mục con</th>
                            <th>Trạng thái</th>
                            <th>Thao Tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($categoryValues)): ?>
                            <?php foreach ($categoryValues as $categoryValue): ?>
                                <tr>
                                    <td><?= htmlspecialchars($categoryValue['id']) ?></td>
                                    <td><?= htmlspecialchars($categoryValue['category_name']) ?></td> 
                                    <td><?= htmlspecialchars($categoryValue['name']) ?></td>
                                    <td><?= $categoryValue['status'] == 1 ? 'Hoạt động' : 'Không hoạt động' ?></td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item d-flex" href="/admin/category/value/edit/<?= $categoryValue['id'] ?>">
                                                    <p>Sửa</p>
                                                    <i class="typcn typcn-edit btn-icon-append"></i>
                                                </a>
                                                <form action="/admin/category/value/delete/<?= $categoryValue['id'] ?>" method="post" style="display:inline;">
                                                    <button type="submit" class="dropdown-item d-flex" onclick="return confirm('Bạn chắc chắn muốn xóa?')">
                                                        <p>Xóa</p>
                                                        <i class="typcn typcn-delete-outline btn-icon-append"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center text-danger">Không có dữ liệu</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $this->stop(); ?>
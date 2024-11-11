<?php $this->layout('Admin/Layouts/Layout') ?>

<?php 
$this->start('main_content');
?>

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Danh sách Loại thuộc tính</h4>

            <?php if (isset($_SESSION['status_message'])): ?>
                <div class="alert alert-success">
                    <?= htmlspecialchars($_SESSION['status_message']) ?>
                </div>
                <?php unset($_SESSION['status_message']);  ?>
            <?php endif; ?>

            <div class="table-responsive pt-3" id="attribute-list">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên Loại thuộc tính</th>
                            <th>Trạng thái</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($data)): ?>
                            <?php foreach ($data as $attribute): ?>
                                <tr>
                                    <td><?= htmlspecialchars($attribute['id']) ?></td>
                                    <td><?= htmlspecialchars($attribute['name']) ?></td>
                                    <td><?= $attribute['status'] == 1 ? 'Hoạt động' : 'Không hoạt động' ?></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="/admin/attribute-edit/<?= htmlspecialchars($attribute['id']) ?>" class="btn btn-success btn-sm btn-icon-text mr-3">
                                                Sửa
                                                <i class="typcn typcn-edit btn-icon-append"></i>
                                            </a>
                                            <a href="/admin/delete-attribute/<?= htmlspecialchars($attribute['id']) ?>" onclick="return confirm('Bạn chắc chứ?')" class="btn btn-danger btn-sm btn-icon-text">
                                                Xóa
                                                <i class="typcn typcn-delete-outline btn-icon-append"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="text-center">Không có dữ liệu</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <?php if (empty($data)): ?>
                <h4 class="text-center text-danger" id="no-data-message" style="display: block;">Không có dữ liệu</h4>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php
$this->stop();
?>

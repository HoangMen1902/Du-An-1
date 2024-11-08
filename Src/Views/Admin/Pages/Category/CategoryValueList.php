<?php $this->layout('Admin/Layouts/Layout') ?>

<?php $this->start('main_content'); ?>
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Danh sách Loại sản phẩm con</h4>
            <div class="table-responsive pt-3">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên loại sản phẩm cha</th>
                            <th>Tên Loại sản phẩm con</th>
                            <th>Trạng thái</th>
                            <th>Thao Tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($categoryValues)): ?>
                            <?php foreach ($categoryValues as $categoryValue): ?>
                                <tr>
                                    <td><?= htmlspecialchars($categoryValue['id']) ?></td>
                                    <td><?= htmlspecialchars($categoryValue['parent_name']) ?></td>
                                    <td><?= htmlspecialchars($categoryValue['sub_name']) ?></td>
                                    <td><?= $categoryValue['status'] == 1 ? 'Hoạt động' : 'Không hoạt động' ?></td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item d-flex" style="display: flex;" href="#">
                                                    <p>Sửa</p>
                                                    <i class="typcn typcn-edit btn-icon-append"></i>
                                                </a>
                                                <a class="dropdown-item d-flex" href="#" onclick="return confirm('Bạn chắc chứ?')">
                                                    <p>Xóa</p>
                                                    <i class="typcn typcn-delete-outline btn-icon-append"></i>
                                                </a>
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

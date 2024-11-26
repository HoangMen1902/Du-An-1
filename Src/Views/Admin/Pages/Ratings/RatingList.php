<?php $this->layout('Admin/Layouts/Layout') ?>


<?php
$this->start('main_content');
?>

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Danh sách Bình luận</h4>
            <div class="table-responsive pt-3">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên người Bình luận</th>
                            <th>Nội dung</th>
                            <th>Ngày Và giờ</th>
                            <th>Trạng thái</th>
                            <th>ID sản phẩm</th>
                            <th>ID người dùng</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($ratingData)): ?>
                            <?php foreach ($ratingData as $rating): ?>
                                <tr>
                                    <td><?= htmlspecialchars($rating['id']) ?></td>
                                    <td><?= htmlspecialchars($rating['preview']) ?></td>
                                    <td><?= htmlspecialchars($rating['created_at']) ?></td>
                                    <td>
                                        <?php
                                        // Hiển thị trạng thái
                                        echo ($rating['status'] == '1') ? 'Hoạt động' : 'Không hoạt động';
                                        ?>
                                    </td>
                                    <td><?= htmlspecialchars($rating['product_id']) ?></td>
                                    <td><?= htmlspecialchars($rating['user_id']) ?></td>
                                    <td>
                                        <div class="d-flex align-items-center">

                                            <a href="/admin/delete-rating/<?= htmlspecialchars($rating['id']) ?>"
                                                onclick="return confirm('Bạn chắc chứ?')"
                                                class="btn btn-danger btn-sm btn-icon-text">
                                                Xóa
                                                <i class="typcn typcn-delete-outline btn-icon-append"></i>
                                            </a>

                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center">Không có bình luận nào</td>
                            </tr>
                        <?php endif; ?>




                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php

$this->stop();
?>
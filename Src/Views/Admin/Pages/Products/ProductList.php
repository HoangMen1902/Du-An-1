<?php $this->layout('Admin/Layouts/Layout') ?>

<?php
$this->start('main_content');
?>
<?php
if (isset($_GET['status'])) {
    $status = $_GET['status'];
    $message = '';
    $alertClass = '';

    switch ($status) {
        case 'success':
            $message = 'Thao tác thành công';
            $alertClass = 'alert-success';
            break;
        case 'failed':
            $message = 'Thao tác thất bại';
            $alertClass = 'alert-danger';
            break;
        case 'added':
            $message = 'Sản phẩm đã được thêm thành công';
            $alertClass = 'alert-success';
            break;
        case 'updated':
            $message = 'Sản phẩm đã được cập nhật thành công';
            $alertClass = 'alert-success';
            break;
        case 'deleted':
            $message = 'Sản phẩm đã được xóa thành công';
            $alertClass = 'alert-success';
            break;
    }

    if ($message) {
        echo '<div class="alert ' . $alertClass . ' mt-5" id="alert-box">';
        echo '<p class="m-0">' . $message . '</p>';
        echo '<button type="button" class="close" aria-label="Close" onclick="closeAlert()">';
        echo '<span aria-hidden="true">&times;</span>';
        echo '</button>';
        echo '</div>';
    }
}
?>


<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Danh sách Sản phẩm</h4>

            <div class="table-responsive pt-3">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên Sản phẩm</th>
                            <th>Hình ảnh</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($data) && !empty($data)):
                            foreach ($data as $product):
                        ?>
                                <tr>
                                    <td><?= $product['id'] ?></td>
                                    <td><?= $product['name'] ?></td>
                                    <td><img src="/public/Uploads/Products/<?= $product['thumbnail'] ?>" alt="Hình ảnh sản phẩm" width="100%"></td>
                                    <td><?= $product['status'] == 1 ? 'Hoạt động' : 'Ẩn' ?></td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item d-flex align-items-center" href="/admin/product/edit/<?=$product['id']?>">
                                                    <span>Sửa</span>
                                                    <i class="typcn typcn-edit ms-auto"></i>
                                                </a>
                                                <a class="dropdown-item d-flex align-items-center" href="/admin/delete-product/<?=$product['id']?>" onclick="return confirm('Bạn chắc chứ?')">
                                                    <span>Xóa</span>
                                                    <i class="typcn typcn-delete-outline ms-auto"></i>
                                                </a>
                                                <a class="dropdown-item d-flex align-items-center" href="/admin/product/detail/<?=$product['id']?>">
                                                    <span>Chi tiết</span>
                                                    <i class="typcn typcn-document ms-auto"></i>
                                                </a>
                                                <a class="dropdown-item d-flex align-items-center" href="/admin/product/add-specs/<?=$product['id']?>">
                                                    <span>Thêm thông số kỹ thuật</span>
                                                    <i class="typcn typcn-cog ms-auto"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                        <?php
                            endforeach;
                        else:
                        ?>
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

<script>
    function closeAlert() {
        // Đóng thông báo khi người dùng nhấn nút đóng
        document.getElementById('alert-box').style.display = 'none';
    }
</script>

<?php
$this->stop();
?>

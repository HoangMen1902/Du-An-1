<?php $this->layout('Admin/Layouts/Layout') ?>

<?php
$this->start('main_content');
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
                                $product['thumbnail'] = explode(',', $product['thumbnail']);
                        ?>
                                <tr>
                                    <td><?= $product['id'] ?></td>
                                    <td><?= $product['name'] ?></td>
                                    <td><img src="/public/Uploads/Products/<?= $product['thumbnail'][0] ?>" alt="Hình ảnh sản phẩm" width="100%"></td>
                                    <td><?= $product['status'] == 1 ? 'Hoạt động' : 'Ẩn' ?></td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item d-flex align-items-center" href="/admin/delete-product/<?=$product['id']?>" onclick="return confirm('Bạn chắc chứ?')">
                                                    <span>Xóa</span>
                                                    <i class="typcn typcn-delete-outline ms-auto"></i>
                                                </a>
                                                <a class="dropdown-item d-flex align-items-center" href="/admin/product/detail/<?=$product['id']?>">
                                                    <span>Chi tiết/Sửa</span>
                                                    <i class="typcn typcn-document ms-auto"></i>
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

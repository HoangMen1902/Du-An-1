<?php

namespace App\Views\Admin\Pages\Products;

use App\Views\BaseView;

class ProductsList extends BaseView
{
    public static function render($data = null)
    {


?>

        <?php
        // include './src/views/admin/layouts/header.php';
        ?>

        <div class="container-scroller">
            <?php
            // include './src/views/admin/layouts/navbar.php';
            ?>
            <div class="container-fluid page-body-wrapper">
                <?php
                // include './src/views/admin/layouts/sidebar.php';
                ?>
                <?php
                $errors = $_SESSION['errors'] ?? [];
                unset($_SESSION['errors']);
                ?>


                <div class="main-panel">
                    <div class="content-wrapper">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="container">
                                        <?php
                                        if (isset($_SESSION['success'])) :
                                        ?>
                                            <div class="alert alert-success btn-close">
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                                <strong>Success!</strong> <?= $_SESSION['success'] ?>
                                            </div>
                                        <?php
                                        endif;
                                        ?>
                                        <?php
                                        if (isset($_SESSION['error'])) :
                                        ?>

                                            <div class="alert alert-danger btn-close">
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                                <strong>Success!</strong> <?= $_SESSION['error'] ?>
                                            </div>
                                        <?php
                                        endif;
                                        ?>
                                    </div>
                                    <div class="mb-5" style="display: flex; justify-content:space-between; align-items:center">
                                        <h4 class="m-0 card-title">Danh sách sản phẩm</h4>
                                        <a class="btn btn-primary text-light" href="/admin/products/new">Thêm mới</a>
                                    </div>

                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>

                                                    <th>
                                                        Name
                                                    </th>
                                                    <th>
                                                        Price
                                                    </th>
                                                    <th>
                                                        Description
                                                    </th>

                                                    <th>
                                                        Image
                                                    </th>
                                                    <th>
                                                        Status
                                                    </th>
                                                </tr>
                                            </thead>
                                            <?php
                                            if (isset($data) && is_array($data) && count($data) > 0) {
                                                foreach ($data as $item) :
                                            ?>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <?= $item['name']; ?>
                                                            </td>
                                                            <td><?= number_format($item['price'], 0, ',', '.'); ?> VNĐ</td>
                                                            <td>
                                                                <?= $item['description']; ?>
                                                            </td>

                                                            <td class="product-img">
                                                                <img src="/public/uploads/<?= $item['image'];
                                                                                            ?>" alt="<?= $item['name']; ?>" width="100px">
                                                            </td>
                                                            <td>
                                                                <?= $item['quantity']; ?>
                                                            </td>

                                                            <td>
                                                            <td><?= ($item['status'] == 1) ? "Hoạt động" : "Không hoạt động" ?></td>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <a href="/admin/detail-product/<?= $item['id']; ?>">
                                                                        <button type="button" class="btn btn-info btn-sm btn-icon-text mr-3">
                                                                            Chi tiết
                                                                            <i class="typcn typcn-edit btn-icon-append"></i>
                                                                        </button>
                                                                    </a>
                                                                    <a href="/admin/edit-product/<?= $item['id'] ?>">
                                                                        <button type="button" class="btn btn-warning btn-sm btn-icon-text mr-3 text-light">
                                                                            Chỉnh sửa
                                                                            <i class="typcn typcn-edit btn-icon-append"></i>
                                                                        </button>
                                                                    </a>
                                                                    <a href="/admin/delete-product/<?= $item['id'] ?>">
                                                                        <button type="button" class="btn btn-danger btn-sm btn-icon-text" onclick="return confirm('Are you sure you want to delete this product?');">
                                                                            Xóa
                                                                            <i class="typcn typcn-delete-outline btn-icon-append"></i>
                                                                        </button>
                                                                    </a>
                                                                </div>
                                                            </td>
                                                        </tr>

                                                    </tbody>
                                                <?php
                                                endforeach;
                                            } else {
                                                ?>
                                                <tr>
                                                    <td colspan="10" style="text-align: center;">Không có sản phẩm</td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
                                var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
                                    return new bootstrap.Popover(popoverTriggerEl, {
                                        html: true,
                                        sanitize: false
                                    })
                                })
                            });
                        </script>
                        <?php
                        // include './src/views/admin/layouts/footer.php';
                        ?>
                    </div>
                </div>
            </div>
            <?php
            // include './src/views/admin/layouts/script.php';
            ?>
            <?php
            unset($_SESSION['success']);
            unset($_SESSION['error']);
            ?>





    <?php

    }
}

    ?>
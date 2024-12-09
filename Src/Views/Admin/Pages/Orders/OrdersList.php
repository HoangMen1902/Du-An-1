<?php $this->layout('Admin/Layouts/Layout') ?>

<?php
$this->start('main_content');
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="table-responsive pt-3">
                <table class="table table-striped project-orders-table">
                    <thead>
                        <tr>
                            <th class="ml-5">ID</th>
                            <th>Tên sản phẩm</th>
                            <th>Số điện thoại</th>
                            <th>Địa chỉ</th>
                            <th>Tổng giá sản phẩm</th>
                            <th>Trạng thái</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($orderData)): ?>
                            <?php foreach ($orderData as $order): ?>
                                <tr>
                                    <td><?= htmlspecialchars($order['order_id']) ?></td>
                                    <td>
                                        <?php if (!empty($order['products'])): ?>
                                            <ul>
                                                <?php
                                         
                                                $products = explode(';', $order['products']);
                                                foreach ($products as $productData):
                                       
                                                    list($productName, $image, $quantity) = explode('|', $productData);
                                                ?>
                                                    <li>
                                                        <img src="<?=$_ENV['APP_URL']?>/public/Uploads/Products/<?= htmlspecialchars($image) ?>" alt="<?= htmlspecialchars($productName) ?>" style="width: 50px; height: 50px;">
                                                        <?= htmlspecialchars($productName) ?> (Số lượng: <?= htmlspecialchars($quantity) ?>)
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        <?php else: ?>
                                            Không có sản phẩm.
                                        <?php endif; ?>
                                    </td>
                                    <td><?= htmlspecialchars($order['phone']) ?></td>
                                    <td><?= htmlspecialchars($order['address']) ?></td>
                                    <td><?= number_format($order['order_price'], 0, ',', '.') ?> VND</td>
                                    <td>
                                        <?php
                                        switch ($order['order_status']) {
                                            case 1:
                                                echo 'Đang xử lý';
                                                break;
                                            case 2:
                                                echo 'Chờ thanh toán';
                                                break;
                                            case 3:
                                                echo 'Đã thanh toán';
                                                break;
                                            case 4:
                                                echo 'Đang vận chuyển';
                                                break;
                                            case 5:
                                                echo 'Đã giao';
                                                break;
                                            default:
                                                echo 'Đã hủy';
                                                break;
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="/admin/order-detail/<?= htmlspecialchars($order['order_id']) ?>">
                                                <button type="button" class="btn btn-info btn-sm btn-icon-text mr-3">
                                                    Chi tiết
                                                    <i class="typcn typcn-edit btn-icon-append"></i>
                                                </button>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center">Không có đơn hàng.</td>
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
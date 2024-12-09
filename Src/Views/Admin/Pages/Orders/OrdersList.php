<?php $this->layout('Admin/Layouts/Layout') ?>

<?php
$this->start('main_content');
?>
<form action="/admin/order-search" class="mb-3" method="post" id="order-search">
    <div class="row">
        <div class="col-lg-12">
            <label for="order">Tìm kiếm đơn hàng</label>
            <input type="text" class="form-control" placeholder="Tìm kiếm đơn hàng" name="order" id="orderSearch">
        </div>
    </div>
</form>
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
                    <tbody id="orderTable">
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
                                                        <img src="<?= $_ENV['APP_URL'] ?>/public/Uploads/Products/<?= htmlspecialchars($image) ?>" alt="<?= htmlspecialchars($productName) ?>" style="width: 50px; height: 50px;">
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
                                        <form action="/admin/update-order-status" method="post" id="statusForm-<?= htmlspecialchars($order['order_id']) ?>">
                                            <input type="hidden" name="order_id" value="<?= htmlspecialchars($order['order_id']) ?>">
                                            <select name="order_status" class="form-control order-status" data-order-id="<?= htmlspecialchars($order['order_id']) ?>" style="width: 200px;">
                                                <option value="1" <?= $order['order_status'] == 1 ? 'selected' : '' ?>>Đang xử lý</option>
                                                <option value="2" <?= $order['order_status'] == 2 ? 'selected' : '' ?>>Chờ thanh toán</option>
                                                <option value="3" <?= $order['order_status'] == 3 ? 'selected' : '' ?>>Đã thanh toán</option>
                                                <option value="4" <?= $order['order_status'] == 4 ? 'selected' : '' ?>>Đang vận chuyển</option>
                                                <option value="5" <?= $order['order_status'] == 5 ? 'selected' : '' ?>>Đã giao</option>
                                                <option value="6" <?= $order['order_status'] == 6 ? 'selected' : '' ?>>Đã hủy</option>
                                            </select>
                                        </form>
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

<?php
$this->push('scripts');
?>
<script src="<?= $_ENV['APP_URL'] ?>/public/Assets/Admin/js/Pages/OrderScript.js"></script>
<?php

$this->end();
?>
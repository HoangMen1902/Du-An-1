<?php $this->layout('Admin/Layouts/Layout') ?>

<?php
$this->start('main_content');
?>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row mt-4">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Chi Tiết Đơn Hàng</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Tên người mua</label>
                                    <div class="col-sm-9">
                                        <input disabled type="text" class="form-control"
                                            name="name"
                                            value="<?= htmlspecialchars($orderData['customer_name'] ?? 'N/A') ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Số điện thoại</label>
                                    <div class="col-sm-9">
                                        <input disabled type="text" class="form-control"
                                            name="phone"
                                            value="<?= htmlspecialchars($orderData['customer_phone'] ?? 'N/A') ?>" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Ngày Đặt Hàng</label>
                                    <div class="col-sm-9">
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="order_date"
                                            value="<?= isset($orderData['order_date']) ? (new DateTime($orderData['order_date']))->format('d-m-Y H:i') : 'N/A'; ?>"
                                            disabled />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Địa chỉ</label>
                                    <div class="col-sm-9">
                                        <input disabled type="text" class="form-control"
                                            name="address"
                                            value="<?= htmlspecialchars($orderData['customer_address'] ?? 'N/A') ?>" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Tổng giá đơn hàng</label>
                                    <div class="col-sm-9">
                                        <input disabled type="text" class="form-control"
                                            name="price"
                                            value="<?= number_format($orderData['total_price'] ?? 0) ?> VNĐ" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Trạng thái</label>
                                    <div class="col-sm-9">
                                        <input disabled type="text" class="form-control"
                                            name="status"
                                            value="<?php
                                                    switch ($orderData['order_status']) {
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
                                                    ?>" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Tên sản phẩm</th>
                                        <th>Mã SKU</th>
                                        <th>Giá</th>
                                        <th>Số lượng</th>
                                        <th>Loại</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($orderData['products'])) {
                                        foreach ($orderData['products'] as $product) {
                                    ?>
                                            <tr>
                                                <td><?= htmlspecialchars($product['product_name'] ?? 'N/A') ?></td>
                                                <td><?= htmlspecialchars($product['sku_code'] ?? 'N/A') ?></td>
                                                <td><?= number_format($product['price'] ?? 0) ?> VNĐ</td>
                                                <td><?= htmlspecialchars($product['product_quantity'] ?? 0) ?></td>
                                                <td><?= htmlspecialchars($product['category_name'] ?? 'N/A') ?></td>

                                            </tr>
                                    <?php
                                        }
                                    } else { ?>
                                        <tr>
                                            <td colspan="5" class="text-center">Không có thông tin chi tiết sản phẩm.</td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex align-items-center justify-content-end mt-3">
                            <a href="/admin/orders" class="btn btn-primary ">Trở về</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$this->stop();
?>

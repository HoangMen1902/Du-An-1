<?php $this->layout('Client/Components/Layout'); ?>



<?php $this->start('main_content') ?>


<section class="account">
    <div class="container-fluid">
        <div class="row g-0">
            <?php include __DIR__ . '/Particals/Sidebar.php'; ?>
            <div class="col-lg-9">
                <div class="order-info">
                    <div class="order-info-add">
                        <div class="order-info-add-title">
                            <p>Thông tin Đơn Hàng</p>
                        </div>
                        <ul class="order-details">
                            <li>Email: <?= htmlspecialchars($data['email']) ?></li>
                            <li>Thành phố: <?= htmlspecialchars($data['city']) ?></li>
                            <li>Quận/Huyện: <?= htmlspecialchars($data['district']) ?></li>
                            <li>Phường/Xã: <?= htmlspecialchars($data['ward']) ?></li>
                            <li>Địa chỉ: <?= htmlspecialchars($data['address']) ?></li>
                            <li>Số điện thoại: <?= htmlspecialchars($data['phone']) ?></li>
                            <li>Phương thức giao hàng: <?= htmlspecialchars($data['delivery-method']) ?></li>
                            <li>Phương thức thanh toán: <?= htmlspecialchars($data['payment-method']) ?></li>
                            <li>Tổng giá: <?= number_format($data['price'], 0, ',', '.') ?> VNĐ</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>







<?php $this->stop() ?>

<?php
$this->push('scripts');
?>
<script src="<?= $_ENV['APP_URL'] ?>/public/Assets/Client/js/AuthValidation.js"></script>
<?php
$this->end();
?>
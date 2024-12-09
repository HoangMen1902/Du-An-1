<?php

$this->push('styles');

?>
<link rel="stylesheet" href="<?= $_ENV['APP_URL'] ?>/node_modules\datatables.net-dt\css\dataTables.dataTables.min.css">


<?php

$this->end();

?>
<?php $this->layout('Client/Components/Layout');

$this->start('main_content');
?>
<?php
$status_int = $data[0]['order_status'];
switch ($status_int) {
    case 1:
        $status = 'Đang xử lý';
        break;
    case 2:
        $status = 'Chờ thanh toán';
        break;
    case 3:
        $status = 'Đã thanh toán';
        break;
    case 4:
        $status = 'Đang vận chuyển';
        break;
    case 5:
        $status = 'Đã giao';
        break;
    default:
        $status = 'Đã hủy';
        break;
}
?>
<section class="account">
    <div class="container-fluid" style="padding: 0px !important">
        <div class="row g-0">
            <div class="col-lg-12">
                <div class="order-detail account-info">
                    <div class="order-detail__actions back d-none d-lg-block mb-5">
                        <a href="/profile/orders-list">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.4375 18.75L4.6875 12L11.4375 5.25M5.625 12H19.3125" stroke="#2E2E2E"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                            <a class="btn btn-primary" href="/profile/orders-list">Quay về</a>
                        </a>
                    </div>
                    <div class="order-detail__meta">
                        <div class="order-detail__content">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5 class="order-detail__ord-number">
                                        <div>
                                            Đơn hàng <span style="display: inline-block;"><strong
                                                    class="js-hook">#<?= $data[0]['order_id'] ?></strong>
                                                <svg class="clipboard" width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M13.125 13.125H16.875V3.125H6.875V6.875" stroke="#2E2E2E"
                                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path d="M13.125 6.875H3.125V16.875H13.125V6.875Z" stroke="#2E2E2E"
                                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                                </svg>
                                            </span>
                                        </div>
                                    </h5>
                                </div>
                                <div class="col-md-6 text-end">
                                    <p class="order-detail__payment-sts">
                                        Trạng thái: <span><strong class="js-hook"><?= $status ?></strong></span>
                                    </p>

                                </div>
                            </div>


                        </div>

                    </div>
                    <table id="myTable" class="display">
                        <thead>
                            <tr>
                                <th>Số thứ tự</th>
                                <th>Mã SKU</th>
                                <th>Giá tiền</th>
                                <th>Số lượng</th>
                                <th>Thuộc tính</th>
                                <th>Hình ảnh</th>
                            </tr>
                        </thead>
                        <h4>Sản phẩm</h4>
                        <tbody id="orderBody">
                            <?php foreach ($data as $index => $item): ?>
                                <tr>
                                    <?php $price = explode('.', $item['sku_price'])[0] ?>
                                    <th><?= $index + 1 ?></th>
                                    <th><?= $item['sku_code'] ?></th>
                                    <th><?= number_format($price, 0, ',', '.') ?> VNĐ</th>
                                    <th><?= $item['sku_quantity'] ?></th>
                                    <th><?= $item['option_name'] . ': ' . $item['option_value'] ?></th>
                                    <th>
                                        <img src="<?= $_ENV['APP_URL'] ?>/public\Uploads\Products/<?= $item['sku_images'] ?>" alt="Hình sku" style="max-width: 100px">
                                    </th>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                    <div class="order-detail__items">
                        <a href="javascript:void(0)" class="order">
                            <div test="0" data-id="1106150626" class="order__product" data-refund="true">
                                <div class="product list-item">
                                    <div class="image-wrapper"><a href="javascript:void(0)">

                                        </a>
                                    </div>

                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="order-detail__summary row">
                        <div class="col-md-6">
                            <h3>
                                <strong>Tóm tắt đơn hàng</strong>
                            </h3>
                            <div class="order-detail__subtotal">
                            </div>
                            <div class="order-detail__total">
                                <span>
                                    Tổng đơn hàng:
                                </span>
                                <span class="js-hook">
                                    <strong><?=number_format($data[0]['total_price'], 0 ,',', '.')?> VNĐ</strong>
                                </span>
                            </div>
                            <div class="order-detail__content-2">
                                <p class="order-detail__shipment-detail">
                                </p>
                                <p class="order-detail__customer"><strong><?= $_SESSION['user']['fullname'] ?></strong> - <?= $data[0]['customer_phone'] ?></p>
                                <p class="order-detail__address"><?= $data[0]['customer_address'] ?></p>
                            </div>
                        </div>
                        <?php
                        if($data[0]['order_status'] === 3 || $data[0]['order_status'] === 5):
                        ?>
                        <div class="col-md-6 text-end">
                            <a href="/get-invoice/<?=$data[0]['order_id']?>" class="btn btn-primary">Tải hóa đơn</a>
                        </div>
                        <?php
                        endif;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
$this->stop();
$this->push('scripts')
?>
<script src="<?= $_ENV['APP_URL'] ?>/public/Assets/Client/js/ChangePasswordValidation.js"></script>
<script src="<?= $_ENV['APP_URL'] ?>/node_modules/datatables.net/js/datatables.js"></script>
<script>
    let table = new DataTable('#myTable', {
        responsive: true,
        language: {
            decimal: ",",
            thousands: ".",
            search: "Tìm kiếm:",
            lengthMenu: "Hiển thị _MENU_ dòng mỗi trang",
            info: "Hiển thị _START_ đến _END_ trong tổng số _TOTAL_ dòng",
            infoEmpty: "Không có dữ liệu",
            infoFiltered: "(lọc từ _MAX_ dòng)",
            loadingRecords: "Đang tải...",
            zeroRecords: "Không tìm thấy kết quả phù hợp",
            emptyTable: "Không có dữ liệu trong bảng",
            paginate: {
                first: "Đầu",
                last: "Cuối",
                next: "Tiếp",
                previous: "Trước"
            },
            aria: {
                sortAscending: ": kích hoạt để sắp xếp cột tăng dần",
                sortDescending: ": kích hoạt để sắp xếp cột giảm dần"
            }
        }

    });
</script>
<?php
$this->end();
?>
<?php $this->layout('Admin/Layouts/Layout') ?>


<?php

$this->push('styles');

?>
<link rel="stylesheet" href="<?= $_ENV['APP_URL'] ?>/node_modules\datatables.net-dt\css\dataTables.dataTables.min.css">
<?php
$this->end();
?>
<?php
$this->start('main_content');
?>
<?php
$status_int = $order[0]['order_status'];
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
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h4>Đơn hàng <?= $order[0]['order_id'] ?></h4>
                    </div>
                    <div class="col-md-6" style="text-align: end;">
                        <a href="/admin/users" class="btn btn-primary">Quay lại</a>
                    </div>
                </div>
                <div class="table-responsive pt-3">
                    <div class="row">
                        <div class="col-md-6">
                            <p style="font-size: 16px;">Tên khách hàng: <?= $user['firstname'] . ' ' . $user['lastname'] ?></p>
                        </div>
                        <div class="col-md-6" style="text-align: end;">
                            <p style="font-size: 16px;">Địa chỉ giao hàng: <?= $order[0]['customer_address'] ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p style="font-size: 16px;">Số điện thoại giao hàng: <?= $order[0]['customer_phone'] ?></p>
                        </div>
                        <div class="col-md-6" style="text-align: end;">
                            <p style="font-size: 16px;">Trạng thái đơn hàng: <?= $status ?></p>
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
                        <tbody id="orderBody">
                            <?php foreach ($order as $index => $item): ?>
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
                </div>
            </div>
        </div>
    </div>
</div>


<?php

$this->stop();
$this->push('scripts');
?>

<script src="<?= $_ENV['APP_URL'] ?>/node_modules/datatables.net/js/datatables.js"></script>
<script src="<?= $_ENV['APP_URL'] ?>/public\Assets\Admin\js\Pages\UserScript.js"></script>
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
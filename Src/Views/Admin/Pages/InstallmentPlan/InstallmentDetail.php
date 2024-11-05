<?php $this->layout('Admin/Layouts/Layout') ?>


<?php
$this->start('main_content');
?>

<div class="col-12 grid-margin">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Thông tin sản phẩm</h4>
            <div class="table-responsive pt-3">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Mã đơn hàng</th>
                            <th>Mã Thanh Toán</th>
                            <th>Ngày Thanh Toán</th>
                            <th>Số Tiền Đã Thanh Toán</th>
                            <th>Số Dư Còn Lại</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>KP001</td>
                            <td>TP001</td>
                            <td>2024-02-01</td>
                            <td>1,000,000 VND</td>
                            <td>11,000,000 VND</td>
                        </tr>
                        <tr>
                            <td>KP001</td>
                            <td>TP002</td>
                            <td>2024-03-01</td>
                            <td>1,000,000 VND</td>
                            <td>10,000,000 VND</td>
                        </tr>
                        <tr>
                            <td colspan="5" class="text-center text-danger">Không có dữ liệu</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php

$this->stop();
?>
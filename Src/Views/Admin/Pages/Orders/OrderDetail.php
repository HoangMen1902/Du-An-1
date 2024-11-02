<?php

namespace App\Views\Admin\Pages\Orders;

use App\Views\BaseView;

class OrderDetail extends BaseView
{
    public static function render($data = null)
    {
?>
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row mt-4">
                    <div class="col-12 grid-margin">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Chi Tiết Đơn Hàng
                                    <?php echo htmlspecialchars($data['id']); ?></h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Tên người mua</label>
                                            <div class="col-sm-9">
                                                <input disabled type="text" class="form-control" name="name" value="<?php echo htmlspecialchars($data['name']); ?>" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Số điện thoại</label>
                                            <div class="col-sm-9">
                                                <input disabled type="text" class="form-control" name="phone" value="<?php echo htmlspecialchars($data['phone']); ?>" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Email</label>
                                            <div class="col-sm-9">
                                                <input disabled type="text" class="form-control" name="email" value="<?php echo htmlspecialchars($data['email']); ?>" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Địa chỉ</label>
                                            <div class="col-sm-9">
                                                <input disabled type="text" class="form-control" name="address" value="<?php echo htmlspecialchars($data['address']); ?>" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Tổng giá đơn hàng</label>
                                            <div class="col-sm-9">
                                                <input disabled type="text" class="form-control" name="price" value="<?php echo number_format($data['price']); ?> VNĐ" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Trạng thái</label>
                                            <div class="col-sm-9">
                                                <?php
                                                $status = $data['status'];
                                                $statusText = '';
                                                switch ($status) {
                                                    case 1:
                                                        $statusText = 'Đang chờ thanh toán';
                                                        break;
                                                    case 2:
                                                        $statusText = 'Đã thanh toán';
                                                        break;
                                                    case 3:
                                                        $statusText = 'Thành công';
                                                        break;
                                                    case 4:
                                                        $statusText = 'Đã hủy';
                                                        break;
                                                    default:
                                                        $statusText = 'Không xác định';
                                                }
                                                ?>
                                                <input disabled type="text" class="form-control" name="status" value="<?php echo htmlspecialchars($statusText); ?>" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php if (count($data)) : ?>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>STT</th>
                                                    <th>Tên sản phẩm</th>
                                                    <th>Giá</th>
                                                    <th>Số lượng</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($data['details'] as $index => $detail) : ?>
                                                    <tr>
                                                        <td><?php echo $index + 1; ?></td>
                                                        <td><?php echo htmlspecialchars($detail['product_name']); ?></td>
                                                        <td><?php echo number_format($detail['price']); ?> VNĐ</td>
                                                        <td><?php echo $detail['quantity']; ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php else : ?>
                                   
                                    <div class="alert alert-warning" role="alert">
                                        Không có thông tin chi tiết sản phẩm cho đơn hàng này.
                                    </div>
                                <?php endif; ?>

                                <div class="row justify-content-end">
                                    <a href="?url=orders" class="btn btn-primary">Trở về</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    <?php
    }
}
    ?>
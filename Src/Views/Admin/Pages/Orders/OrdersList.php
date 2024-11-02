<?php

namespace App\Views\Admin\Pages\Orders;

use App\Views\BaseView;

class OrdersList extends BaseView
{
    public static function render($data = null)
    {


        ?>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="table-responsive pt-3">
                        <table class="table table-striped project-orders-table">
                            <thead>
                                <tr>
                                    <th class="ml-5">ID</th>
                                    <th>Tên người mua</th>
                                    <th>Số điện thoại</th>
                                    <th>Địa chỉ</th>
                                    <th>Tổng giá sản phẩm</th>
                                    <th>Trạng thái</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (count($data)): ?>
                                    <?php foreach ($data as $order): ?>
                                        <tr>
                                            <td><?= $order['id'] ?></td>
                                            <td><?= $order['name'] ?></td>
                                            <td><?= $order['phone'] ?></td>
                                            <td><?= $order['address'] ?></td>
                                            <td><?= $order['price'] ?></td>
                                            <td>
                                                <?php
                                                switch ($order['status']) {
                                                    case 1:
                                                        echo "Đang chờ thanh toán";
                                                        break;
                                                    case 2:
                                                        echo "Đã thanh toán";
                                                        break;
                                                    case 3:
                                                        echo "Thành công";
                                                        break;
                                                    case 4:
                                                        echo "Đã hủy";
                                                        break;
                                                    default:
                                                        echo "Không xác định";
                                                        break;
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <!-- <div class="d-flex align-items-center">
                                                    <a href="/admin/order-detail/<?= $order['id'] ?>">
                                                        <button type="button" class="btn btn-info btn-sm btn-icon-text mr-3">
                                                            Chi tiết
                                                            <i class="typcn typcn-edit btn-icon-append"></i>
                                                        </button>
                                                    </a>

                                                </div> -->
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

    }
}

?>
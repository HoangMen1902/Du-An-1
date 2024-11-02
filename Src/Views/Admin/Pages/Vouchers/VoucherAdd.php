<?php

namespace App\Views\Admin\Pages\Vouchers;

use App\Views\BaseView;

class VoucherAdd extends BaseView
{
    public static function render($data = null)
    {


?>
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Thêm mã giảm giá</h4>
                    <form class="forms-sample" action="/admin/add-voucher" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="method" value="POST">
                        <div class="form-group">
                            <label for="name">Tên</label>
                            <input type="text" class="form-control" id="name" placeholder="Name" name="name">
                        </div>
                        <div class="form-group">
                            <label for="code">Mã Voucher</label>
                            <input type="text" class="form-control" id="code" name="code"></input>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Giá giảm</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" name="discountAmount" id="discountAmount">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">VNĐ</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Áp dụng cho đơn trên</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" name="orderValueDiscount" id="orderValueDiscount">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">VNĐ</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label class="col-sm-6 col-form-label">Ngày hết hạn</label>
                                <div class="col-sm-9" style="padding: 0">
                                    <!-- <input class="form-control" type="datetime-local" step="1" id="createdAt" name="createdAt"> -->
                                    <input class="form-control" type="datetime-local" step="1" id="dueAt" name="dueAt">
                                    <div id="invalidDate" style="display: none; color: red;">Vui lòng nhập ngày hợp lệ</div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Trạng thái</label>
                            <div class="form-check form-check-success ">
                                <select class="form-control form-control-sm col-lg-2" name="status">
                                    <option value="1">Hoạt động</option>
                                    <option value="2">Không hoạt động</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary mr-2">Thêm</button>
                        <?php
                        if (isset($_SESSION['voucher']['error'])) :
                        ?>
                            <div class="alert alert-danger mt-5" role="alert">
                                <?= $_SESSION['voucher']['error'] ?>
                            </div>
                        <?php
                            unset($_SESSION['voucher']);
                        endif;
                        ?>
                        <?php
                        if (isset($_SESSION['voucher']['success'])) :
                        ?>
                            <div class="alert alert-success mt-5" role="alert">
                                <?= $_SESSION['voucher']['success'] ?>
                            </div>
                        <?php
                            unset($_SESSION['voucher']['success']);
                        endif;
                        ?>

                        <?php
                        if (isset($_SESSION['voucher']['failDelete'])) :
                        ?>
                            <div class="alert alert-danger mt-5" role="alert">
                                <?= $_SESSION['voucher']['failDelete'] ?>
                            </div>
                        <?php
                            unset($_SESSION['voucher']);
                        endif;
                        ?>

                        <?php
                        if (isset($_SESSION['voucher']['successDelete'])) :
                        ?>
                            <div class="alert alert-success mt-5" role="alert">
                                <?= $_SESSION['voucher']['successDelete'] ?>
                            </div>
                        <?php
                            unset($_SESSION['voucher']);
                        endif;
                        ?>
                    </form>
                </div>
            </div>
        </div>
<?php

    }
}

?>
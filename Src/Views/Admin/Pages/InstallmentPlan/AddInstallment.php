<?php $this->layout('Admin/Layouts/Layout') ?>


<?php 
$this->start('main_content');
?>
<div class="col-12 grid-margin">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Thêm Kế Hoạch Trả Góp</h4>
            <form class="forms-sample" action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="method" value="POST">

                <div class="form-group">
                    <label for="order_id">Mã đơn hàng</label>
                    <input type="text" class="form-control" name="order_id" id="order_id" placeholder="order_id">
                </div>

                <div class="form-group">
                    <label for="interestRate">Lãi Suất (%)</label>
                    <input class="form-control" id="interestRate" rows="4" name="interestRate"></>
                </div>

                <div class="form-group">
                    <label for="term">Kỳ Hạn</label>
                    <select class="form-control" id="term" name="term">
                        <option value="">Chọn thương hiệu</option>
                        <option value="">6</option>
                        <option value="">12</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="monthlyPayment">Số Tiền Thanh Toán Hàng Tháng:</label>
                    <input type="text" class="form-control" name="monthlyPayment" id="monthlyPayment" placeholder="monthlyPayment">
                </div>

                <div class="form-group">
                    <label for="startDate">Ngày bắt đầu</label>
                    <input type="date" class="form-control" name="startDate" id="startDate" placeholder="startDate">
                </div>

                <div class="form-group">
                    <label for="endDate">Ngày kết thúc</label>
                    <input type="date" class="form-control" name="endDate" id="endDate" placeholder="Discount Rate">
                </div>

                <div class="border-top">
                    <div class="card-body">
                        <button type="reset" class="btn btn-danger text-white">Làm lại</button>
                        <button type="submit" class="btn btn-primary">Thêm</button>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary mr-2" name="submit">Thêm mới</button>
                <a href="/admin?url=products" class="btn btn-light">Hủy bỏ</a>
            </form>
        </div>
    </div>
</div>

<script>
    function create() {
        $("#multi_properties").append(`
            <div class="row items_properties mb-3">
                <div class="col-5">
                    <label for="">Tên thuộc tính</label>
                    <select name="option_id[]" class="form-select">
                        <option value="">Chọn thuộc tính</option>
                    </select>
                </div>
                <div class="col-5">
                    <label for="option_vl_name">Giá trị</label>
                    <input type="text" class="form-control" id="option_vl_name" name="option_vl_name[]" placeholder="Giá trị">
                </div>
                <div class="col-1">
                    <label for="">&nbsp;</label>
                    <a href="javascript:void(0)" onclick="delete_(this)" class="btn btn-danger btn-sm d-block">Xóa</a>
                </div>
            </div>
        `);
    }

    function delete_(__this) {
        $(__this).closest(".items_properties").remove();
    }
</script>

<?php

$this->stop();
?>
<?php $this->layout('Admin/Layouts/Layout') ?>


<?php
$this->start('main_content');
?>
<div class="col-12 grid-margin">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Thêm Kế Hoạch Trả Góp</h4>
            <form class="forms-sample" action="/admin/tragop/store" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="sku_name">Mã sản phẩm</label>
                    <input type="text" name="sku_name" id="sku_name" class="form-control" placeholder="Nhập SKU">
                </div>
                <div class="form-group">
                    <label for="interest_rate">Lãi suất (%)</label>
                    <input type="number" name="interest_rate" id="interest_rate" class="form-control" placeholder="Nhập lãi suất">
                </div>
                <div class="form-group">
                    <label for="term">Kỳ Hạn</label>
                    <select class="form-control" id="term" name="term">
                        <option value="1">3 tháng</option>
                        <option value="2">6 tháng</option>
                        <option value="3">1 năm</option>
                        <option value="4">2 năm</option>
                        <option value="5">3 năm</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Tỷ lệ trả trước (%)</label>
                    <div class="checkbox-group" style="display: flex; gap: 15px; align-items: center;">
                        <div>
                            <input type="checkbox" id="rate_0" name="down_payment_rate[]" value="0">
                            <label for="rate_0">0%</label>
                        </div>
                        <div>
                            <input type="checkbox" id="rate_1" name="down_payment_rate[]" value="1">
                            <label for="rate_1">10%</label>
                        </div>
                        <div>
                            <input type="checkbox" id="rate_3" name="down_payment_rate[]" value="3">
                            <label for="rate_3">30%</label>
                        </div>
                        <div>
                            <input type="checkbox" id="rate_5" name="down_payment_rate[]" value="5">
                            <label for="rate_5">50%</label>
                        </div>
                        <div>
                            <input type="checkbox" id="rate_7" name="down_payment_rate[]" value="7">
                            <label for="rate_7">70%</label>
                        </div>
                        <div>
                            <input type="checkbox" id="rate_9" name="down_payment_rate[]" value="9">
                            <label for="rate_9">90%</label>
                        </div>
                    </div>
                </div>


                <button type="submit" class="btn btn-primary">Thêm trả góp</button>
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
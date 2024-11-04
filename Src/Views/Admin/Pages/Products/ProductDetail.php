<?php $this->layout('Admin/Layouts/Layout') ?>


<?php 
$this->start('main_content');
?>

<div class="col-12 grid-margin">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Thông tin sản phẩm</h4>
            <form class="forms-sample" action="/admin/add-product-detail-action/" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="">
                <input type="hidden" name="method" value="POST">

                <div class="form-group">
                    <label for="name">Tên sản phẩm</label>
                    <input type="text" class="form-control" name="name" id="name" value="" disabled>
                </div>
                <div class="form-group">
                    <label for="description">Mô tả sản phẩm</label>
                    <input type="text" class="form-control" name="description" id="description" value="" disabled>
                </div>
                <div class="form-group">
                    <label for="brand_id">Thương hiệu</label>
                    <input type="text" class="form-control" name="brand_id" id="brand_id" value="" disabled>
                </div>
                <div class="form-group">
                    <label for="category_id">Phân loại sản phẩm</label>
                    <input type="text" class="form-control" name="category_id" id="category_id" value="" disabled>
                </div>
                <div class="form-group">
                    <label for="price">Giá tiền</label>
                    <input type="number" class="form-control" name="price" id="price" value="" disabled>
                </div>
                <div class="form-group">
                    <label for="quantity">Số lượng</label>
                    <input type="number" class="form-control" name="quantity" id="quantity" value="" disabled>
                </div>
                <div class="form-group">
                    <label for="discountRate">Giá giảm (%)</label>
                    <input type="number" class="form-control" name="discountRate" id="discountRate" value="" disabled>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="col-12 grid-margin">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Thông tin kỹ thuật</h4>
            <form class="forms-sample" method="post" enctype="multipart/form-data">
                <input type="hidden" name="method" value="POST">
                <div class="form-group">
                    <label for="cpu_technology">Công nghệ CPU</label>
                    <input type="text" class="form-control" name="cpu_technology" id="cpu_technology" value="" disabled>
                </div>
                <div class="form-group">
                    <label for="cores">Số Nhân</label>
                    <input type="number" class="form-control" name="cores" id="cores" value="" disabled>
                </div>
                <div class="form-group">
                    <label for="threads">Số luồng</label>
                    <input type="number" class="form-control" name="threads" id="threads" value="" disabled>
                </div>
                <div class="form-group">
                    <label for="cpu_speed">Tốc độ CPU</label>
                    <input type="text" class="form-control" name="cpu_speed" id="cpu_speed" value="" disabled>
                </div>
                <div class="form-group">
                    <label for="max_speed">Tốc độ tối đa</label>
                    <input type="text" class="form-control" name="max_speed" id="max_speed" value="" disabled>
                </div>
                <div class="form-group">
                    <label for="cache_size">Bộ nhớ đệm</label>
                    <input type="text" class="form-control" name="cache_size" id="cache_size" value="" disabled>
                </div>
                <div class="form-group">
                    <label for="ram_size">Ram</label>
                    <input type="text" class="form-control" name="ram_size" id="ram_size" value="" disabled>
                </div>
                <div class="form-group">
                    <label for="ram_type">Loại RAM</label>
                    <input type="text" class="form-control" name="ram_type" id="ram_type" value="" disabled>
                </div>
                <div class="form-group">
                    <label for="ram_speed">Tốc độ Bus RAM</label>
                    <input type="text" class="form-control" name="ram_speed" id="ram_speed" value="" disabled>
                </div>
                <div class="form-group">
                    <label for="max_ram_supported">Hỗ trợ RAM tối đa</label>
                    <input type="text" class="form-control" name="max_ram_supported" id="max_ram_supported" value="" disabled>
                </div>
                <div class="form-group">
                    <label for="storage">Ổ cứng</label>
                    <input type="text" class="form-control" name="storage" id="storage" value="" disabled>
                </div>
                <div class="form-group">
                    <label for="screen_size">Màn hình</label>
                    <input type="text" class="form-control" name="screen_size" id="screen_size" value="" disabled>
                </div>
                <div class="form-group">
                    <label for="resolution">Độ phân giải</label>
                    <input type="text" class="form-control" name="resolution" id="resolution" value="" disabled>
                </div>
                <div class="form-group">
                    <label for="refresh_rate">Tần số quét</label>
                    <input type="text" class="form-control" name="refresh_rate" id="refresh_rate" value="" disabled>
                </div>
                <div class="form-group">
                    <label for="screen_technology">Công nghệ màn hình</label>
                    <input type="text" class="form-control" name="screen_technology" id="screen_technology" value="" disabled>
                </div>
                <div class="form-group">
                    <label for="gpu">Card màn hình</label>
                    <input type="text" class="form-control" name="gpu" id="gpu" value="" disabled>
                </div>
                <div class="form-group">
                    <label for="audio_technology">Công nghệ âm thanh</label>
                    <input type="text" class="form-control" name="audio_technology" id="audio_technology" value="" disabled>
                </div>
                <div class="form-group">
                    <label for="wireless_connectivity">Kết nối không dây</label>
                    <input type="text" class="form-control" name="wireless_connectivity" id="wireless_connectivity" value="" disabled>
                </div>
                <div class="form-group">
                    <label for="card_reader">Khe đọc thẻ nhớ</label>
                    <input type="text" class="form-control" name="card_reader" id="card_reader" value="" disabled>
                </div>
                <div class="form-group">
                    <label for="webcam">Webcam</label>
                    <input type="text" class="form-control" name="webcam" id="webcam" value="" disabled>
                </div>
                <div class="form-group">
                    <label for="additional_features">Tính năng khác</label>
                    <input type="text" class="form-control" name="additional_features" id="additional_features" value="" disabled>
                </div>
                <div class="form-group">
                    <label for="keyboard_backlight">Đèn bàn phím</label>
                    <input type="text" class="form-control" name="keyboard_backlight" id="keyboard_backlight" value="" disabled>
                </div>
                <div class="form-group">
                    <label for="dimensions">Kích thước</label>
                    <input type="text" class="form-control" name="dimensions" id="dimensions" value="" disabled>
                </div>
                <div class="form-group">
                    <label for="weight">Khối lượng tịnh</label>
                    <input type="text" class="form-control" name="weight" id="weight" value="" disabled>
                </div>
                <div class="form-group">
                    <label for="material">Chất liệu</label>
                    <input type="text" class="form-control" name="material" id="material" value="" disabled>
                </div>
                <div class="form-group">
                    <label for="battery_info">Thông tin Pin</label>
                    <input type="text" class="form-control" name="battery_info" id="battery_info" value="" disabled>
                </div>
                <div class="form-group">
                    <label for="charger_power">Công suất bộ sạc</label>
                    <input type="text" class="form-control" name="charger_power" id="charger_power" value="" disabled>
                </div>
                <div class="form-group">
                    <label for="os">Hệ điều hành</label>
                    <input type="text" class="form-control" name="os" id="os" value="" disabled>
                </div>
                <a href

<?php

$this->stop();
?>
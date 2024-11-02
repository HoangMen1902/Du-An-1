<?php

namespace App\Views\Admin\Pages\Products;

use App\Views\BaseView;

class ProductDetail extends BaseView
{
    public static function render($data = null, $detail = null)
    {
        ?>
        <div class="col-12 grid-margin ">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Thông tin sản phẩm </h4>
                    <form class="forms-sample"
                        action="/admin/add-product-detail-action/<?= htmlspecialchars($data['id'] ?? ''); ?>" method="post"
                        enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= htmlspecialchars($data['id'] ?? ''); ?>">
                        <input type="hidden" name="method" value="POST">

                        <div class="form-group">
                            <label for="name">Tên sản phẩm</label>
                            <input type="text" class="form-control" name="name" id="name"
                                value="<?= htmlspecialchars($data['name'] ?? ''); ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="description">Mô tả sản phẩm</label>
                            <input type="text" class="form-control" name="description" id="description"
                                value="<?= htmlspecialchars($data['description'] ?? ''); ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="brand_id">Thương hiệu</label>
                            <input type="text" class="form-control" name="brand_id" id="brand_id"
                                value="<?= htmlspecialchars($data['brand_name'] ?? ''); ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="category_id">Phân loại sản phẩm</label>
                            <input type="text" class="form-control" name="category_id" id="category_id"
                                value="<?= htmlspecialchars($data['category_name'] ?? ''); ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="price">Giá tiền</label>
                            <input type="number" class="form-control" name="price" id="price"
                                value="<?= htmlspecialchars($data['price'] ?? ''); ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="quantity">Số lượng</label>
                            <input type="number" class="form-control" name="quantity" id="quantity"
                                value="<?= htmlspecialchars($data['quantity'] ?? ''); ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="discountRate">Giá giảm (%)</label>
                            <input type="number" class="form-control" name="discountRate" id="discountRate"
                                value="<?= htmlspecialchars($data['discountRate'] ?? ''); ?>" disabled>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-12 grid-margin ">
            <?php
            if (isset($detail)):
                ?>
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Thông tin kỹ thuật</h4>
                        <form class="forms-sample" method="post"
                            enctype="multipart/form-data">
                            <input type="hidden" name="method" value="POST">
                            <div class="form-group">
                                <label for="cpu_technology">Công nghệ CPU</label>
                                <input type="text" class="form-control" name="cpu_technology" id="cpu_technology"
                                    value="<?= htmlspecialchars($detail['cpu_technology'] ?? ''); ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="cores">Số Nhân</label>
                                <input type="number" class="form-control" name="cores" id="cores"
                                    value="<?= htmlspecialchars($detail['cores'] ?? ''); ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="threads">Số luồng</label>
                                <input type="number" class="form-control" name="threads" id="threads"
                                    value="<?= htmlspecialchars($detail['threads'] ?? ''); ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="cpu_speed">Tốc độ CPU</label>
                                <input type="text" class="form-control" name="cpu_speed" id="cpu_speed"
                                    value="<?= htmlspecialchars($detail['cpu_speed'] ?? ''); ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="max_speed">Tốc độ tối đa</label>
                                <input type="text" class="form-control" name="max_speed" id="max_speed"
                                    value="<?= htmlspecialchars($detail['max_speed'] ?? ''); ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="cache_size">Bộ nhớ đệm</label>
                                <input type="text" class="form-control" name="cache_size" id="cache_size"
                                    value="<?= htmlspecialchars($detail['cache_size'] ?? ''); ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="ram_size">Ram</label>
                                <input type="text" class="form-control" name="ram_size" id="ram_size"
                                    value="<?= htmlspecialchars($detail['ram_size'] ?? ''); ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="ram_type">Loại RAM</label>
                                <input type="text" class="form-control" name="ram_type" id="ram_type"
                                    value="<?= htmlspecialchars($detail['ram_type'] ?? ''); ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="ram_speed">Tốc độ Bus RAM</label>
                                <input type="text" class="form-control" name="ram_speed" id="ram_speed"
                                    value="<?= htmlspecialchars($detail['ram_speed'] ?? ''); ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="max_ram_supported">Hỗ trợ RAM tối đa</label>
                                <input type="text" class="form-control" name="max_ram_supported" id="max_ram_supported"
                                    value="<?= htmlspecialchars($detail['max_ram_supported'] ?? ''); ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="storage">Ổ cứng</label>
                                <input type="text" class="form-control" name="storage" id="storage"
                                    value="<?= htmlspecialchars($detail['storage'] ?? ''); ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="screen_size">Màn hình</label>
                                <input type="text" class="form-control" name="screen_size" id="screen_size"
                                    value="<?= htmlspecialchars($detail['screen_size'] ?? ''); ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="resolution">Độ phân giải</label>
                                <input type="text" class="form-control" name="resolution" id="resolution"
                                    value="<?= htmlspecialchars($detail['resolution'] ?? ''); ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="refresh_rate">Tần số quét</label>
                                <input type="text" class="form-control" name="refresh_rate" id="refresh_rate"
                                    value="<?= htmlspecialchars($detail['refresh_rate'] ?? ''); ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="screen_technology">Công nghệ màn hình</label>
                                <input type="text" class="form-control" name="screen_technology" id="screen_technology"
                                    value="<?= htmlspecialchars($detail['screen_technology'] ?? ''); ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="gpu">Card màn hình</label>
                                <input type="text" class="form-control" name="gpu" id="gpu"
                                    value="<?= htmlspecialchars($detail['gpu'] ?? ''); ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="audio_technology">Công nghệ âm thanh</label>
                                <input type="text" class="form-control" name="audio_technology" id="audio_technology"
                                    value="<?= htmlspecialchars($detail['audio_technology'] ?? ''); ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="wireless_connectivity">Kết nối không dây</label>
                                <input type="text" class="form-control" name="wireless_connectivity" id="wireless_connectivity"
                                    value="<?= htmlspecialchars($detail['wireless_connectivity'] ?? ''); ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="card_reader">Khe đọc thẻ nhớ</label>
                                <input type="text" class="form-control" name="card_reader" id="card_reader"
                                    value="<?= htmlspecialchars($detail['card_reader'] ?? ''); ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="webcam">Webcam</label>
                                <input type="text" class="form-control" name="webcam" id="webcam"
                                    value="<?= htmlspecialchars($detail['webcam'] ?? ''); ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="additional_features">Tính năng khác</label>
                                <input type="text" class="form-control" name="additional_features" id="additional_features"
                                    value="<?= htmlspecialchars($detail['additional_features'] ?? ''); ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="keyboard_backlight">Đèn bàn phím</label>
                                <input type="text" class="form-control" name="keyboard_backlight" id="keyboard_backlight"
                                    value="<?= htmlspecialchars($detail['keyboard_backlight'] ?? ''); ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="dimensions">Kích thước</label>
                                <input type="text" class="form-control" name="dimensions" id="dimensions"
                                    value="<?= htmlspecialchars($detail['dimensions'] ?? ''); ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="weight">Khối lượng tịnh</label>
                                <input type="text" class="form-control" name="weight" id="weight"
                                    value="<?= htmlspecialchars($detail['weight'] ?? ''); ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="material">Chất liệu</label>
                                <input type="text" class="form-control" name="material" id="material"
                                    value="<?= htmlspecialchars($detail['material'] ?? ''); ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="battery_info">Thông tin Pin</label>
                                <input type="text" class="form-control" name="battery_info" id="battery_info"
                                    value="<?= htmlspecialchars($detail['battery_info'] ?? ''); ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="charger_power">Công suất bộ sạc</label>
                                <input type="text" class="form-control" name="charger_power" id="charger_power"
                                    value="<?= htmlspecialchars($detail['charger_power'] ?? ''); ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="os">Hệ điều hành</label>
                                <input type="text" class="form-control" name="os" id="os"
                                    value="<?= htmlspecialchars($detail['os'] ?? ''); ?>" disabled>
                            </div>
                            <a href="/admin/products" class="btn btn-light">Trở về</a>
                        </form>
                    </div>
                </div>
                <?php
            else:
                ?>
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Thông tin kỹ thuật</h4>
                        <input type="text" class="form-control " name="os" id="os" value="sản phẩm chưa có thông tin kỹ thuật"
                            disabled>
                    </div>
                </div>
                <a href="/admin/products" class="btn btn-light">Trở về</a>
                <?php
            endif;
            ?>
        </div>

        <?php
    }
}

?>
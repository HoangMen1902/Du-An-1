<?php

namespace App\Views\Admin\Pages\Products;

use App\Views\BaseView;

class ProductAddDetail extends BaseView
{
    public static function render($data = null)
    {

        ?>
        <div class="col-12 grid-margin ">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Thêm thông số kỹ thuật</h4>
                    <form class="forms-sample" action="/admin/add-product-detail-action/<?= $data['id'] ?>" method="post"
                        enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= $data['id']; ?>">
                        <input type="hidden" name="method" value="POST">
                        <div class="form-group">
                            <label for="cpu_technology">Công nghệ CPU</label>
                            <input type="text" class="form-control" name="cpu_technology" id="cpu_technology"
                                value="<?= $_POST['cpu_technology'] ?? ''; ?>" placeholder="Intel Core 7 Raptor Lake - 150U...">
                        </div>
                        <div class="form-group">
                            <label for="description">Số Nhân</label>
                            <input type="number" class="form-control" name="cores" id="cores"
                                value="<?= $_POST['cores'] ?? ''; ?>" placeholder="10...">

                        </div>
                        <div class="form-group">
                            <label for="threads">Số luồng</label>
                            <input type="number" class="form-control" name="threads" id="threads"
                                value="<?= $_POST['threads'] ?? ''; ?>" placeholder="12">
                        </div>
                        <div class="form-group">
                            <label for="cpu_speed">Tốc độ CPU</label>
                            <input type="text" class="form-control" name="cpu_speed" id="cpu_speed"
                                value="<?= $_POST['	cpu_speed'] ?? ''; ?>" placeholder="Hãng không công bố">
                        </div>
                        <div class="form-group">
                            <label for="max_speed">Tốc độ tối đa</label>
                            <input type="text" class="form-control" name="max_speed" id="max_speed"
                                value="<?= $_POST['max_speed'] ?? ''; ?>" placeholder="Turbo Boost 5.40 GHz">
                        </div>
                        <div class="form-group">
                            <label for="cache_size">Bộ nhớ đệm</label>
                            <input type="text" class="form-control" name="cache_size" id="cache_size"
                                value="<?= $_POST['cache_size'] ?? ''; ?>" placeholder="12 MB">
                        </div>
                        <div class="form-group">
                            <label for="ram_size">Ram</label>
                            <input type="text" class="form-control" name="ram_size" id="ram_size"
                                value="<?= $_POST['ram_size'] ?? ''; ?>" placeholder="16 GB">
                        </div>
                        <div class="form-group">
                            <label for="ram_type">Loại RAM</label>
                            <input type="text" class="form-control" name="ram_type" id="ram_type"
                                value="<?= $_POST['ram_type'] ?? ''; ?>" placeholder="DDR5 2 khe (1 khe 8 GB + 1 khe 8 GB)">
                        </div>
                        <div class="form-group">
                            <label for="ram_speed">Tốc độ Bus RAM</label>
                            <input type="text" class="form-control" name="ram_speed" id="ram_speed"
                            value="<?= $_POST['ram_speed'] ?? ''; ?>" placeholder="5200 MHz">

                        </div>
                        <div class="form-group">
                            <label for="max_ram_supported">Hỗ trợ RAM tối đa</label>
                            <input type="text" class="form-control" name="  max_ram_supported" id="  max_ram_supported"
                            value="<?= $_POST['max_ram_supported'] ?? ''; ?>" placeholder="24 GB">

                              
                        </div>
                        <div class="form-group">
                            <label for="storage">Ổ cứng</label>
                            <input type="text" class="form-control" name="  storage" id="  storage"
                            value="<?= $_POST['storage'] ?? ''; ?>" placeholder="  1 TB SSD M.2 PCIe">
                          

                        </div>
                        <div class="form-group">
                            <label for="screen_size">Màn hình</label>
                            <input type="text" class="form-control" name="screen_size" id="screen_size"
                            value="<?= $_POST['screen_size'] ?? ''; ?>" placeholder="14 inch">
                        </div>
                        <div class="form-group">
                            <label for="resolution">Độ phân giải</label>
                         <input type="text" class="form-control" name="resolution" id="resolution"
                            value="<?= $_POST['resolution'] ?? ''; ?>" placeholder="Full HD+ (1920 x 1200) 16:10">
                        </div>
                        <div class="form-group">
                            <label for="refresh_rate">Tần số quét</label>
                         <input type="text" class="form-control" name="refresh_rate" id="refresh_rate"
                            value="<?= $_POST['refresh_rate'] ?? ''; ?>" placeholder="60 Hz">
                        </div>
                    
                        <div class="form-group">
                            <label for="screen_technology">Công nghệ màn hình</label>
                         <input type="text" class="form-control" name="screen_technology" id="screen_technology"
                            value="<?= $_POST['screen_technology'] ?? ''; ?>" placeholder="Chống chói Anti Glare, 250 nits, WVA">
                        </div>
                        <div class="form-group">
                            <label for="gpu">Card màn hình</label>
                         <input type="text" class="form-control" name="gpu" id="gpu"
                            value="<?= $_POST['gpu'] ?? ''; ?>" placeholder="Card tích hợp - Intel Graphics">
                        </div>
                        <div class="form-group">
                            <label for="audio_technology">Công nghệ âm thanh</label>
                         <input type="text" class="form-control" name="audio_technology" id="audio_technology"
                            value="<?= $_POST['audio_technology'] ?? ''; ?>" placeholder="Waves MaxxAudio ProDolby Atmos">
                        </div>
                        <div class="form-group">
                            <label for="wireless_connectivity">Kết nối không dây</label>
                         <input type="text" class="form-control" name="wireless_connectivity" id="wireless_connectivity"
                            value="<?= $_POST['wireless_connectivity'] ?? ''; ?>" placeholder="Wi-Fi 6 (802.11ax)Bluetooth 5.3">
                        </div>
                        <div class="form-group">
                            <label for="card_reader">Khe đọc thẻ nhớ</label>
                         <input type="text" class="form-control" name="card_reader" id="card_reader"
                            value="<?= $_POST['card_reader'] ?? ''; ?>" placeholder="SD">
                        </div>
                        <div class="form-group">
                            <label for="webcam">Webcam</label>
                         <input type="text" class="form-control" name="webcam" id="webcam"
                            value="<?= $_POST['webcam'] ?? ''; ?>" placeholder="Full HD Webcam">
                        </div>
                        <div class="form-group">
                            <label for="additional_features">Tính năng khác</label>
                         <input type="text" class="form-control" name="additional_features" id="additional_features"
                            value="<?= $_POST['additional_features'] ?? ''; ?>" placeholder="Bảo mật vân tay">
                        </div>
                        <div class="form-group">
                            <label for="keyboard_backlight">Đèn bàn phím</label>
                         <input type="text" class="form-control" name="keyboard_backlight" id="keyboard_backlight"
                            value="<?= $_POST['keyboard_backlight'] ?? ''; ?>" placeholder="Đơn sắc - Màu trắng">
                        </div>
                        <div class="form-group">
                            <label for="dimensions">Kích thước</label>
                         <input type="text" class="form-control" name="dimensions" id="dimensions"
                            value="<?= $_POST['dimensions'] ?? ''; ?>" placeholder="Dài 314 mm - Rộng 226.6 mm - Dày 18.9 mm">
                        </div>
                        <div class="form-group">
                            <label for="weight">Khối lượng tịnh</label>
                         <input type="text" class="form-control" name="weight" id="weight"
                            value="<?= $_POST['weight'] ?? ''; ?>" placeholder="1.56 kg">
                        </div>
                        <div class="form-group">
                            <label for="material">Chất liệu</label>
                         <input type="text" class="form-control" name="material" id="material"
                            value="<?= $_POST['material'] ?? ''; ?>" placeholder="Vỏ nhựa">
                        </div>
                        <div class="form-group">
                            <label for="battery_info">Thông tin Pin</label>
                         <input type="text" class="form-control" name="battery_info" id="battery_info"
                            value="<?= $_POST['battery_info'] ?? ''; ?>" placeholder="4-cell Li-ion, 54 Wh">
                        </div>
                        <div class="form-group">
                            <label for="charger_power">Công suất bộ sạc</label>
                         <input type="text" class="form-control" name="charger_power" id="charger_power"
                            value="<?= $_POST['charger_power'] ?? ''; ?>" placeholder="65 W">
                        </div>
                        <div class="form-group">
                            <label for="os">Hệ điều hành</label>
                         <input type="text" class="form-control" name="os" id="os"
                            value="<?= $_POST['os'] ?? ''; ?>" placeholder="Windows 11 Home SL + Office Home & Student vĩnh viễn">
                        </div>

                        <button type="submit" class="btn btn-primary mr-2" name="submit">Thêm thông tin</button>
                        <a href="/admin?url=products" class="btn btn-light">Hủy bỏ</a>
                    </form>
                </div>
            </div>

        </div>

        <?php

    }
}

?>
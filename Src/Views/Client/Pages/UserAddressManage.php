<?php $this->layout('Client/Components/Layout');

$this->start('main_content');
?>

<section class="account">
    <div class="container-fluid">
        <div class="row g-0">
            <?php $this->Insert('Client/Pages/UserProfile/Particals/sidebar'); ?>
            <div class="col-lg-9 hiden">
                <div class="address-info">
                    <div class="address-info-add">
                        <div class="address-info-add-title">
                            <p>Địa chỉ</p>
                        </div>
                        <div class="address-info-add-modal">
                            <?php
                            if (empty($results)):
                            ?>
                                <div class="address-info-add-modal-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="0.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                    </svg>

                                </div>

                                <div class="address-info-add-modal-show">
                                    <span>Không có địa chỉ lưu sẵn!</span>
                                    <p>Lưu sẵn địa chỉ ở đây để rút ngắn thời gian đặt hàng.</p>
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                        <a href="#" class="text-decoration-none" class="modal-dialog modal-dialog-scrollable">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                            </svg>
                                            THÊM ĐỊA CHỈ
                                        </a>
                                    </button>
                                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog width-form">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title fw-bold" id="staticBackdropLabel">THÊM ĐỊA CHỈ
                                                    </h4>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form id="addressForm" method="post" action="/new-address">
                                                        <input type="hidden" name="method" value="POST">
                                                        <div class="form-group text-start">
                                                            <label for="" class="form-label">Tỉnh/thành</label>
                                                            <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="city" id="city">
                                                                <option>Chọn tỉnh thành</option>

                                                            </select>
                                                        </div>
                                                        <div class="form-group text-start">
                                                            <label for="" class="form-label">Quận/Hyện</label>
                                                            <select class="form-select form-select-lg mb-3" name="district" aria-label=".form-select-lg example" id="district">
                                                                <option>Chọn Quận/Huyện</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group text-start">
                                                            <label for="" class="form-label">Phường/xã</label>
                                                            <select class="form-select form-select-lg mb-3" id="wards" name="ward" aria-label=".form-select-lg example" id="ward">
                                                                <option>Phường/xã</option>

                                                            </select>
                                                        </div>
                                                        <div class="form-group text-start">
                                                            <label for="" class="form-label">Địa chỉ chi tiết</label>
                                                            <input type="text" class="form-control p-3" name="address" id="address">
                                                        </div>
                                                        <div class="form-group text-start">
                                                            <label for="" class="form-label">Số điện thoại của địa chỉ này</label>
                                                            <input type="text" class="form-control p-3" name="phone" id="phone">
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-success" form="addressForm" name="submit">Lưu địa chỉ</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            else:
                            ?>
                                <div class="address-info-add-modal-show">
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                        <a href="#" class="text-decoration-none" class="modal-dialog modal-dialog-scrollable">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                            </svg>
                                            THÊM ĐỊA CHỈ MỚI
                                        </a>
                                    </button>
                                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog width-form">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title fw-bold" id="staticBackdropLabel">THÊM ĐỊA CHỈ
                                                    </h4>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form id="addressForm" method="post" action="/new-address">
                                                        <input type="hidden" name="method" value="POST">
                                                        <div class="form-group text-start">
                                                            <label for="" class="form-label">Tỉnh/thành</label>
                                                            <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="city" id="city">
                                                                <option>Chọn tỉnh thành</option>

                                                            </select>
                                                        </div>
                                                        <div class="form-group text-start">
                                                            <label for="" class="form-label">Quận/Hyện</label>
                                                            <select class="form-select form-select-lg mb-3" name="district" aria-label=".form-select-lg example" id="district">
                                                                <option>Chọn Quận/Huyện</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group text-start">
                                                            <label for="" class="form-label">Phường/xã</label>
                                                            <select class="form-select form-select-lg mb-3" id="wards" name="ward" aria-label=".form-select-lg example" id="ward">
                                                                <option>Phường/xã</option>

                                                            </select>
                                                        </div>
                                                        <div class="form-group text-start">
                                                            <label for="" class="form-label">Địa chỉ chi tiết</label>
                                                            <input type="text" class="form-control p-3" name="address" id="address">
                                                        </div>
                                                        <div class="form-group text-start">
                                                            <label for="" class="form-label">Số điện thoại của địa chỉ này</label>
                                                            <input type="text" class="form-control p-3" name="phone" id="phone">
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-success" form="addressForm" name="submit">Lưu địa chỉ</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                foreach ($results as $item):
                                ?>
                                    <div class="address my-3">
                                        <h4 class="address__name d-flex gap-1 align-items-center">
                                            <span>
                                                Địa chỉ
                                            </span>
                                            <button type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop" style="border:none">

                                                <a href="javascript:void(0);">
                                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M7.5 16.8739H3.75C3.58424 16.8739 3.42527 16.8081 3.30806 16.6909C3.19085 16.5737 3.125 16.4147 3.125 16.2489V12.7578C3.125 12.6757 3.14117 12.5945 3.17258 12.5186C3.20398 12.4428 3.25002 12.3739 3.30806 12.3159L12.6831 2.94087C12.8003 2.82366 12.9592 2.75781 13.125 2.75781C13.2908 2.75781 13.4497 2.82366 13.5669 2.94087L17.0581 6.43199C17.1753 6.5492 17.2411 6.70817 17.2411 6.87393C17.2411 7.03969 17.1753 7.19866 17.0581 7.31587L7.5 16.8739Z" stroke="#2E2E2E" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        <path d="M10.625 5L15 9.375" stroke="#2E2E2E" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    </svg>
                                                </a>
                                            </button>
                                            <form action="/profile/delete-address/  <?= $item['id']; ?>" method="post">
                                                <button onclick="return confirm('Bạn chắc chứ?')" name="method" value="DELETE" style="border:none">
                                            </form>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#2E2E2E" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                                                <circle cx="12" cy="12" r="10"></circle>
                                                <line x1="15" y1="9" x2="9" y2="15"></line>
                                                <line x1="9" y1="9" x2="15" y2="15"></line>
                                            </svg>

                                            </button>
                                        </h4>
                                        <p>SĐT: <?= $item['phone'] ?></p>
                                        </p>
                                        <p>Tỉnh/thành:<?= $item['province_name'] ?> </p>
                                        <p>Quận/Huyện: <?= $item['district_name'] ?></p>
                                        <p>Phường/Xã:<?= $item['ward_name'] ?> </p>
                                        <p class="mb-0">
                                            Địa chỉ chi tiết:<?= $item['address'] ?>
                                        </p>
                                    </div>
                                <?php
                                endforeach;
                                ?>
                        </div>
                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog width-form">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title fw-bold" id="staticBackdropLabel">Sửa
                                        </h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="addressForm" method="post" action="/change-user-address">
                                            <input type="hidden" name="method" value="POST">
                                            <div class="form-group text-start">
                                                <label for="" class="form-label">Tỉnh/Thành</label>
                                                <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="city" id="city">
                                                    <option>Tỉnh/Thành</option>

                                                </select>
                                            </div>
                                            <div class="form-group text-start">
                                                <label for="" class="form-label">Quận/Huyện</label>
                                                <select class="form-select form-select-lg mb-3" id="district" name="district" aria-label=".form-select-lg example" id="district">
                                                    <option>Quận/Huyện</option>

                                                </select>
                                            </div>
                                            <div class="form-group text-start">
                                                <label for="" class="form-label">Phường/xã</label>
                                                <select class="form-select form-select-lg mb-3" id="wards" name="ward" aria-label=".form-select-lg example" id="ward">
                                                    <option>Phường/xã</option>

                                                </select>
                                            </div>
                                            <div class="form-group text-start">
                                                <label for="" class="form-label">Địa chỉ chi tiết</label>
                                                <input type="text" class="form-control p-3" name="address" id="address">
                                            </div>
                                            <div class="form-group text-start">
                                                <label for="" class="form-label">Số điện thoại của địa chỉ này</label>
                                                <input type="text" class="form-control p-3" name="phone" id="phone">
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success" form="addressForm" name="submit">Lưu địa chỉ</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                            endif;
                    ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>

<?php $this->stop(); ?>
<?php $this->push('scripts') ?>
<script src="<?= getenv('APP_URL') ?>/public/assets/client/js/ProvinceAPI.js"></script>
<?php $this->end(); ?>
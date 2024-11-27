<?php $this->layout('Client/Components/Layout'); ?>
<?php $this->start('main_content');

$specs = json_decode($desc_specs['specifications']);
?>

<!-- Insert nội dung vào đây -->
<div class="product-detal__container" >
    <div class="product__carousel">
        <div class="product__main-carousel-ids">

            <?php
            $thumbnail = explode(',', $productData['thumbnail']);
            ?>
            <?php foreach ($thumbnail as $image): ?>
                <button onclick="changeImage1('<?= $_ENV['APP_URL'] ?>/public/Uploads/Products/<?= $image ?>')">
                    <img src="<?= $_ENV['APP_URL'] ?>/public/Uploads/Products/<?= $image ?>" alt="">
                </button>
                <!-- <?= $_ENV['APP_URL'] ?>/public/Uploads/Products/<?= $image ?> -->
            <?php endforeach; ?>


        </div>
        <div class="product__carousel-wrapper">
            <div style="display: block;" class="product__carousel-wrapper__slide">
                <?php
                $thumbnail = explode(',', $productData['thumbnail']);
                ?>
                <img id="mainImage" src="<?= $_ENV['APP_URL'] ?>/public/Uploads/Products/<?= $thumbnail[0] ?>" alt="">
            </div>

            <div class="product__carousel-wrapper__slide">
                <img src="/public/uploads/" alt="">
            </div>

        </div>
    </div>



    <div class="product__info">

        <?php
        $firstSku = reset($productData['skus']);
        ?>
        <h4 id="product-name-<?= $productData['product_id'] ?>">
            <?= $productData['product_name'] ?> - <?= $firstSku['sku'] ?>
        </h4>




        <!--  chức năng voucher phát triển sau -->
        <!-- <form action="/voucher" method="post">
            <input type="hidden" name="method" value="POST">
            <input type="hidden" name="id" value="">
            <input type="hidden" name="voucher_id" value="">
            <div class="product_discountCode">
                <div class="product_discountCode-transition"></div>

                <button>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
        </form> -->

        <p class="product__info__text">
            <span id="old-price-<?= $productData['product_id'] ?>" class="related-card__sub-price__delete"
                style="color: black;">
                <?= isset($firstSku['original_price']) ? number_format($firstSku['original_price']) : 'Giá liên hệ' ?> đ
            </span>
            <span id="current-price-<?= $productData['product_id'] ?>">
                <?= isset($firstSku['discounted_price']) ? number_format($firstSku['discounted_price']) : 'Giá liên hệ' ?>
                đ
            </span>
        </p>

        <hr>
        <p><?= $productData['short_description'] ?></p>

        <!-- <p>Mô tả</p> -->
        <!-- <div class="product__info__ultext">
            <ul>
                <li>Kích thước: 100
                </li>
            </ul>
        </div> -->
        <hr>

        <div class="product__info__buy row">
            <?php foreach ($productData['skus'] as $sku): ?>
                <div class="col-4 p-1">
                    <div class="border border-secondary rounded p-1">
                        <label class="w-100">
                            <input form="add-to-cart" class="hidden" type="radio" value="<?= $sku['sku_id'] ?> "
                                name="sku_options"
                                data-image="<?= $_ENV['APP_URL'] ?>/public/Uploads/Products/<?= htmlspecialchars($sku['images']) ?>"
                                data-price="<?= $sku['discounted_price'] ?>" data-old-price="<?= $sku['original_price'] ?>"
                                product-name="<?= $sku['sku'] ?>" onclick="onSkuSelect(this)">
                            <?php foreach ($sku['options'] as $option): ?>
                                <div>
                                    <?= htmlspecialchars($option['option_name']) . ': ' . htmlspecialchars($option['option_value']) ?>
                                </div>
                            <?php endforeach; ?>
                        </label>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>



        <p><svg style="width: 20px;" xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 576 512"><!--!Font Awesome Free 6.7.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                <path
                    d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z" />
            </svg> lượt xem:</p>
        <p>Số lượng:</p>
        <div class="product__info__buy__quantity">
            <button onclick="decrementProduct()" class="product__info__buy__button-l">-</button>
            <p id="quantityProduct">1</p>
            <button onclick="incrementProduct()" class="product__info__buy__button-r">+</button>
        </div>
        <p>Chọn mua:</p>

        <form id="add-to-cart" action="/add-to-cart" method="post">
            <input type="hidden" id="quantityInput" name="quantity" value="1">
            <input type="hidden" name="product_id" value="<?= $productData['product_id'] ?>">
            <button class="product__info__buy__button text-white" name="add-to-cart">Chọn mua</button>
        </form>

    </div>
</div>

</div>

<ul class="nav nav-pills mb-3 align-items-center justify-content-center" id="pills-tab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Thông số kỹ thuật</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Mô tả</button>
    </li>
</ul>



<section class="container container-des tab-content" id="pills-tabContent" style="margin: auto">
    <div class="feature-chart tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
        <h2>Thông số kỹ thuật</h2>
        <?php
        foreach($specs as $spec):
        ?>
        <div class="table-row">
            <div class="table-row__title">
                <p><?=$spec->spec_name?></p>
            </div>
            <div class="table-row__text">
                <p>
                    <span>
                        <?=$spec->spec_value?>
                    </span>
                </p>
            </div>
        </div>
        <?php
        endforeach;
        ?>
        <p class="feature-chart__more" id="moreButton">
            <a role="button" aria-expanded="false" aria-controls="collapseExample">
                <span>Xem thêm</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                </svg>
            </a>
        </p> 
        <div class="collapse" id="collapseExample">
            <div class="table-row">
                <div class="table-row__title">
                    <p>Ram</p>
                </div>
                <div class="table-row__text">
                    <p>
                        <span>

                        </span>
                    </p>
                </div>
            </div>
            <div class="table-row">
                <div class="table-row__title">
                    <p>Loại RAM</p>
                </div>
                <div class="table-row__text">
                    <p>
                        <span>

                        </span>
                    </p>
                </div>
            </div>
            <div class="table-row">
                <div class="table-row__title">
                    <p>Tốc độ Bus RAM</p>
                </div>
                <div class="table-row__text">
                    <p>
                        <span>

                        </span>
                    </p>
                </div>
            </div>
            <div class="table-row">
                <div class="table-row__title">
                    <p>Hỗ trợ RAM tối đa</p>
                </div>
                <div class="table-row__text">
                    <p>
                        <span>

                        </span>
                    </p>
                </div>
            </div>
            <div class="table-row">
                <div class="table-row__title">
                    <p>Ổ cứng</p>
                </div>
                <div class="table-row__text">
                    <p>
                        <span>

                        </span>
                    </p>
                </div>
            </div>
            <div class="table-row">
                <div class="table-row__title">
                    <p>Màn hình</p>
                </div>
                <div class="table-row__text">
                    <p>
                        <span>

                        </span>
                    </p>
                </div>
            </div>
            <div class="table-row">
                <div class="table-row__title">
                    <p>Độ phân giải</p>
                </div>
                <div class="table-row__text">
                    <p>
                        <span>

                        </span>
                    </p>
                </div>
            </div>
            <div class="table-row">
                <div class="table-row__title">
                    <p>Tần số quét</p>
                </div>
                <div class="table-row__text">
                    <p>
                        <span>

                        </span>
                    </p>
                </div>
            </div>
            <div class="table-row">
                <div class="table-row__title">
                    <p>Công nghệ màn hình</p>
                </div>
                <div class="table-row__text">
                    <p>
                        <span>

                        </span>
                    </p>
                </div>
            </div>
            <div class="table-row">
                <div class="table-row__title">
                    <p>Card màn hình</p>
                </div>
                <div class="table-row__text">
                    <p>
                        <span>

                        </span>
                    </p>
                </div>
            </div>
            <div class="table-row">
                <div class="table-row__title">
                    <p>Công nghệ âm thanh</p>
                </div>
                <div class="table-row__text">
                    <p>
                        <span>

                        </span>
                    </p>
                </div>
            </div>
            <div class="table-row">
                <div class="table-row__title">
                    <p>Kết nối không dây</p>
                </div>
                <div class="table-row__text">
                    <p>
                        <span>

                        </span>
                    </p>
                </div>
            </div>
            <div class="table-row">
                <div class="table-row__title">
                    <p>Khe đọc thẻ nhớ</p>
                </div>
                <div class="table-row__text">
                    <p>
                        <span>

                        </span>
                    </p>
                </div>
            </div>
            <div class="table-row">
                <div class="table-row__title">
                    <p>Webcam</p>
                </div>
                <div class="table-row__text">
                    <p>
                        <span>

                        </span>
                    </p>
                </div>
            </div>
            <div class="table-row">
                <div class="table-row__title">
                    <p>Tính năng khác</p>
                </div>
                <div class="table-row__text">
                    <p>
                        <span>

                        </span>
                    </p>
                </div>
            </div>
            <div class="table-row">
                <div class="table-row__title">
                    <p>Đèn bàn phím</p>
                </div>
                <div class="table-row__text">
                    <p>
                        <span>

                        </span>
                    </p>
                </div>
            </div>
            <div class="table-row">
                <div class="table-row__title">
                    <p>Kích thước</p>
                </div>
                <div class="table-row__text">
                    <p>
                        <span>

                        </span>
                    </p>
                </div>
            </div>
            <div class="table-row">
                <div class="table-row__title">
                    <p>Khối lượng tịnh</p>
                </div>
                <div class="table-row__text">
                    <p>
                        <span>

                        </span>
                    </p>
                </div>
            </div>
            <div class="table-row">
                <div class="table-row__title">
                    <p>Chất liệu</p>
                </div>
                <div class="table-row__text">
                    <p>
                        <span>

                        </span>
                    </p>
                </div>
            </div>
            <div class="table-row">
                <div class="table-row__title">
                    <p>Thông tin Pin</p>
                </div>
                <div class="table-row__text">
                    <p>
                        <span>

                        </span>
                    </p>
                </div>
            </div>
            <div class="table-row">
                <div class="table-row__title">
                    <p>Công suất bộ sạc</p>
                </div>
                <div class="table-row__text">
                    <p>
                        <span>

                        </span>
                    </p>
                </div>
            </div>
            <div class="table-row">
                <div class="table-row__title">
                    <p>Hệ điều hành</p>
                </div>
                <div class="table-row__text">
                    <p>
                        <span>

                        </span>
                    </p>
                </div>
            </div>
            <p class="feature-chart__more" id="lessButton">
                <a role="button" aria-expanded="false" aria-controls="collapseExample">
                    <span>Ẩn bớt</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                    </svg>
                </a>
            </p>
        </div>
    </div>
    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" style="max-width: 70%;">
        <?=$desc_specs['description']?>
    </div>
</section>



<div class="container related">
    <div class="related-title">
        <h1 class="related-title__item">
            Có thể bạn thích
        </h1>
    </div>
    <div class="col-xxl-12 col-md-12  my-4 p-0">






        <div class="col-12 ">



            <div class="row mt-3 d-flex justify-content-between">
                <div class="col-md-4 mb-4  col-xxl-3">
                    <div class="card position-relative" id="card-1">
                        <img class="product-img" id="main-img-1"
                            src="https://www.phongcachxanh.vn/cdn/shop/files/chu-t-khong-day-sieu-nh-fnatic-x-lamzu-maya-x-8k-di-kem-dongle-8khz-41690680787189.jpg?v=1726324338&width=800"
                            class="card-img-top" alt="ảnh sản phẩm">
                        <div class="card-body">
                            <h5 class="card-title mb-2 text-limit">Lót chuột Lethal Gaming Gear Jupiter PRO (V2)</h5>
                            <p class="card-text mb-2 text-limit">Thuộc phân loại Control - Slow, chậm nhất trong các
                                dòng PRO của Lethal Gaming.</p>

                            <div class="d-flex justify-content-star align-items-center">
                                <span class="price text-muted mb-2 text-decoration-line-through">1.500.000đ</span>
                                <span class="price mb-2 ms-2">1.000.000đ</span>
                            </div>
                            <button
                                class="btn btn-mainColor button-hover button-add text-white rounded-5 position-absolute ">Mua
                                ngay</button>

                            <div class="d-flex mt-3">
                                <button class="img-thumbnail col-3  me-1 product-thumbnail  "
                                    onclick="changeImage('main-img-1', 'https://www.phongcachxanh.vn/cdn/shop/files/chu-t-khong-day-sieu-nh-fnatic-x-lamzu-maya-x-8k-di-kem-dongle-8khz-41690680787189.jpg?v=1726324338&width=800')">
                                    <img class="col-12 "
                                        src="https://www.phongcachxanh.vn/cdn/shop/files/chu-t-khong-day-sieu-nh-fnatic-x-lamzu-maya-x-8k-di-kem-dongle-8khz-41690680787189.jpg?v=1726324338&width=800"
                                        alt="thumbnail">
                                </button>
                                <button class="img-thumbnail col-3 me-1 product-thumbnail"
                                    onclick="changeImage('main-img-1', 'https://www.phongcachxanh.vn/cdn/shop/files/lot-chu-t-lethal-gaming-gear-jupiter-pro-v2-41227243946229.jpg?v=1726313363&width=800')">
                                    <img class="col-12"
                                        src="https://www.phongcachxanh.vn/cdn/shop/files/lot-chu-t-lethal-gaming-gear-jupiter-pro-v2-41227243946229.jpg?v=1726313363&width=800"
                                        alt="thumbnail">
                                </button>
                                <button class="img-thumbnail col-3 me-1 product-thumbnail"
                                    onclick="changeImage('main-img-1', 'https://www.phongcachxanh.vn/cdn/shop/files/chu-t-khong-day-sieu-nh-fnatic-x-lamzu-maya-x-8k-di-kem-dongle-8khz-41690680787189.jpg?v=1726324338&width=800')">
                                    <img class="col-12"
                                        src="https://www.phongcachxanh.vn/cdn/shop/files/chu-t-khong-day-sieu-nh-fnatic-x-lamzu-maya-x-8k-di-kem-dongle-8khz-41690680787189.jpg?v=1726324338&width=800"
                                        alt="thumbnail">
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4  col-xxl-3">
                    <div class="card position-relative" id="card-2">
                        <img class="product-img" id="main-img-2"
                            src="https://www.phongcachxanh.vn/cdn/shop/files/chu-t-khong-day-sieu-nh-fnatic-x-lamzu-maya-x-8k-di-kem-dongle-8khz-41690680787189.jpg?v=1726324338&width=800"
                            class="card-img-top" alt="ảnh sản phẩm">
                        <div class="card-body">
                            <h5 class="card-title mb-2 text-limit">Lót chuột Lethal Gaming Gear Jupiter PRO (V2)</h5>
                            <p class="card-text mb-2 text-limit">Thuộc phân loại Control - Slow, chậm nhất trong các
                                dòng PRO của Lethal Gaming.</p>

                            <div class="d-flex justify-content-star align-items-center">
                                <span class="price text-muted mb-2 text-decoration-line-through">1.500.000đ</span>
                                <span class="price mb-2 ms-2">1.000.000đ</span>
                            </div>
                            <button
                                class="btn btn-mainColor button-hover button-add  text-white rounded-5 position-absolute">Mua
                                ngay</button>

                            <div class="d-flex mt-3">
                                <button class="img-thumbnail col-3 me-1 product-thumbnail"
                                    onclick="changeImage('main-img-2', 'https://www.phongcachxanh.vn/cdn/shop/files/chu-t-khong-day-sieu-nh-fnatic-x-lamzu-maya-x-8k-di-kem-dongle-8khz-41690680787189.jpg?v=1726324338&width=800')">
                                    <img class="col-12"
                                        src="https://www.phongcachxanh.vn/cdn/shop/files/chu-t-khong-day-sieu-nh-fnatic-x-lamzu-maya-x-8k-di-kem-dongle-8khz-41690680787189.jpg?v=1726324338&width=800"
                                        alt="thumbnail">
                                </button>
                                <button class="img-thumbnail col-3 me-1 product-thumbnail"
                                    onclick="changeImage('main-img-2', 'https://www.phongcachxanh.vn/cdn/shop/files/lot-chu-t-lethal-gaming-gear-jupiter-pro-v2-41227243946229.jpg?v=1726313363&width=800')">
                                    <img class="col-12"
                                        src="https://www.phongcachxanh.vn/cdn/shop/files/lot-chu-t-lethal-gaming-gear-jupiter-pro-v2-41227243946229.jpg?v=1726313363&width=800"
                                        alt="thumbnail">
                                </button>
                                <button class="img-thumbnail col-3 me-1 product-thumbnail"
                                    onclick="changeImage('main-img-2', 'https://www.phongcachxanh.vn/cdn/shop/files/chu-t-khong-day-sieu-nh-fnatic-x-lamzu-maya-x-8k-di-kem-dongle-8khz-41690680787189.jpg?v=1726324338&width=800')">
                                    <img class="col-12"
                                        src="https://www.phongcachxanh.vn/cdn/shop/files/chu-t-khong-day-sieu-nh-fnatic-x-lamzu-maya-x-8k-di-kem-dongle-8khz-41690680787189.jpg?v=1726324338&width=800"
                                        alt="thumbnail">
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4  col-xxl-3">
                    <div class="card position-relative" id="card-2">
                        <img class="product-img" id="main-img-2 product-img"
                            src="https://www.phongcachxanh.vn/cdn/shop/files/chu-t-khong-day-sieu-nh-fnatic-x-lamzu-maya-x-8k-di-kem-dongle-8khz-41690680787189.jpg?v=1726324338&width=800"
                            class="card-img-top" alt="ảnh sản phẩm">
                        <div class="card-body">
                            <h5 class="card-title mb-2 text-limit">Lót chuột Lethal Gaming Gear Jupiter PRO (V2)</h5>
                            <p class="card-text mb-2 text-limit">Thuộc phân loại Control - Slow, chậm nhất trong các
                                dòng PRO của Lethal Gaming.</p>

                            <div class="d-flex justify-content-star align-items-center">
                                <span class="price text-muted mb-2 text-decoration-line-through">1.500.000đ</span>
                                <span class="price mb-2 ms-2">1.000.000đ</span>
                            </div>
                            <button
                                class="btn btn-mainColor button-hover button-add  text-white rounded-5 position-absolute">Mua
                                ngay</button>

                            <div class="d-flex mt-3">
                                <button class="img-thumbnail col-3 me-1 product-thumbnail"
                                    onclick="changeImage('main-img-2', 'https://www.phongcachxanh.vn/cdn/shop/files/chu-t-khong-day-sieu-nh-fnatic-x-lamzu-maya-x-8k-di-kem-dongle-8khz-41690680787189.jpg?v=1726324338&width=800')">
                                    <img class="col-12"
                                        src="https://www.phongcachxanh.vn/cdn/shop/files/chu-t-khong-day-sieu-nh-fnatic-x-lamzu-maya-x-8k-di-kem-dongle-8khz-41690680787189.jpg?v=1726324338&width=800"
                                        alt="thumbnail">
                                </button>
                                <button class="img-thumbnail col-3 me-1 product-thumbnail"
                                    onclick="changeImage('main-img-2', 'https://www.phongcachxanh.vn/cdn/shop/files/lot-chu-t-lethal-gaming-gear-jupiter-pro-v2-41227243946229.jpg?v=1726313363&width=800')">
                                    <img class="col-12"
                                        src="https://www.phongcachxanh.vn/cdn/shop/files/lot-chu-t-lethal-gaming-gear-jupiter-pro-v2-41227243946229.jpg?v=1726313363&width=800"
                                        alt="thumbnail">
                                </button>
                                <button class="img-thumbnail col-3 me-1 product-thumbnail"
                                    onclick="changeImage('main-img-2', 'https://www.phongcachxanh.vn/cdn/shop/files/chu-t-khong-day-sieu-nh-fnatic-x-lamzu-maya-x-8k-di-kem-dongle-8khz-41690680787189.jpg?v=1726324338&width=800')">
                                    <img class="col-12"
                                        src="https://www.phongcachxanh.vn/cdn/shop/files/chu-t-khong-day-sieu-nh-fnatic-x-lamzu-maya-x-8k-di-kem-dongle-8khz-41690680787189.jpg?v=1726324338&width=800"
                                        alt="thumbnail">
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4  col-xxl-3">
                    <div class="card position-relative" id="card-2">
                        <img class="product-img" id="main-img-2"
                            src="https://www.phongcachxanh.vn/cdn/shop/files/chu-t-khong-day-sieu-nh-fnatic-x-lamzu-maya-x-8k-di-kem-dongle-8khz-41690680787189.jpg?v=1726324338&width=800"
                            class="card-img-top" alt="ảnh sản phẩm">
                        <div class="card-body">
                            <h5 class="card-title mb-2 text-limit">Lót chuột Lethal Gaming Gear Jupiter PRO (V2)</h5>
                            <p class="card-text mb-2 text-limit">Thuộc phân loại Control - Slow, chậm nhất trong các
                                dòng PRO của Lethal Gaming.</p>

                            <div class="d-flex justify-content-star align-items-center">
                                <span class="price text-muted mb-2 text-decoration-line-through">1.500.000đ</span>
                                <span class="price mb-2 ms-2">1.000.000đ</span>
                            </div>
                            <button
                                class="btn btn-mainColor button-hover button-add  text-white rounded-5 position-absolute">Mua
                                ngay</button>

                            <div class="d-flex mt-3">
                                <button class="img-thumbnail col-3 me-1 product-thumbnail"
                                    onclick="changeImage('main-img-2', 'https://www.phongcachxanh.vn/cdn/shop/files/chu-t-khong-day-sieu-nh-fnatic-x-lamzu-maya-x-8k-di-kem-dongle-8khz-41690680787189.jpg?v=1726324338&width=800')">
                                    <img class="col-12"
                                        src="https://www.phongcachxanh.vn/cdn/shop/files/chu-t-khong-day-sieu-nh-fnatic-x-lamzu-maya-x-8k-di-kem-dongle-8khz-41690680787189.jpg?v=1726324338&width=800"
                                        alt="thumbnail">
                                </button>
                                <button class="img-thumbnail col-3 me-1 product-thumbnail"
                                    onclick="changeImage('main-img-2', 'https://www.phongcachxanh.vn/cdn/shop/files/lot-chu-t-lethal-gaming-gear-jupiter-pro-v2-41227243946229.jpg?v=1726313363&width=800')">
                                    <img class="col-12"
                                        src="https://www.phongcachxanh.vn/cdn/shop/files/lot-chu-t-lethal-gaming-gear-jupiter-pro-v2-41227243946229.jpg?v=1726313363&width=800"
                                        alt="thumbnail">
                                </button>
                                <button class="img-thumbnail col-3 me-1 product-thumbnail"
                                    onclick="changeImage('main-img-2', 'https://www.phongcachxanh.vn/cdn/shop/files/chu-t-khong-day-sieu-nh-fnatic-x-lamzu-maya-x-8k-di-kem-dongle-8khz-41690680787189.jpg?v=1726324338&width=800')">
                                    <img class="col-12"
                                        src="https://www.phongcachxanh.vn/cdn/shop/files/chu-t-khong-day-sieu-nh-fnatic-x-lamzu-maya-x-8k-di-kem-dongle-8khz-41690680787189.jpg?v=1726324338&width=800"
                                        alt="thumbnail">
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4  col-xxl-3">
                    <div class="card position-relative" id="card-2">
                        <img class="product-img" id="main-img-2"
                            src="https://www.phongcachxanh.vn/cdn/shop/files/chu-t-khong-day-sieu-nh-fnatic-x-lamzu-maya-x-8k-di-kem-dongle-8khz-41690680787189.jpg?v=1726324338&width=800"
                            class="card-img-top" alt="ảnh sản phẩm">
                        <div class="card-body">
                            <h5 class="card-title mb-2 text-limit">Lót chuột Lethal Gaming Gear Jupiter PRO (V2)</h5>
                            <p class="card-text mb-2 text-limit">Thuộc phân loại Control - Slow, chậm nhất trong các
                                dòng PRO của Lethal Gaming.</p>

                            <div class="d-flex justify-content-star align-items-center">
                                <span class="price text-muted mb-2 text-decoration-line-through">1.500.000đ</span>
                                <span class="price mb-2 ms-2">1.000.000đ</span>
                            </div>
                            <button
                                class="btn btn-mainColor button-hover button-add  text-white rounded-5 position-absolute">Mua
                                ngay</button>

                            <div class="d-flex mt-3">
                                <button class="img-thumbnail col-3 me-1 product-thumbnail"
                                    onclick="changeImage('main-img-2', 'https://www.phongcachxanh.vn/cdn/shop/files/chu-t-khong-day-sieu-nh-fnatic-x-lamzu-maya-x-8k-di-kem-dongle-8khz-41690680787189.jpg?v=1726324338&width=800')">
                                    <img class="col-12"
                                        src="https://www.phongcachxanh.vn/cdn/shop/files/chu-t-khong-day-sieu-nh-fnatic-x-lamzu-maya-x-8k-di-kem-dongle-8khz-41690680787189.jpg?v=1726324338&width=800"
                                        alt="thumbnail">
                                </button>
                                <button class="img-thumbnail col-3 me-1 product-thumbnail"
                                    onclick="changeImage('main-img-2', 'https://www.phongcachxanh.vn/cdn/shop/files/lot-chu-t-lethal-gaming-gear-jupiter-pro-v2-41227243946229.jpg?v=1726313363&width=800')">
                                    <img class="col-12"
                                        src="https://www.phongcachxanh.vn/cdn/shop/files/lot-chu-t-lethal-gaming-gear-jupiter-pro-v2-41227243946229.jpg?v=1726313363&width=800"
                                        alt="thumbnail">
                                </button>
                                <button class="img-thumbnail col-3 me-1 product-thumbnail"
                                    onclick="changeImage('main-img-2', 'https://www.phongcachxanh.vn/cdn/shop/files/chu-t-khong-day-sieu-nh-fnatic-x-lamzu-maya-x-8k-di-kem-dongle-8khz-41690680787189.jpg?v=1726324338&width=800')">
                                    <img class="col-12"
                                        src="https://www.phongcachxanh.vn/cdn/shop/files/chu-t-khong-day-sieu-nh-fnatic-x-lamzu-maya-x-8k-di-kem-dongle-8khz-41690680787189.jpg?v=1726324338&width=800"
                                        alt="thumbnail">
                                </button>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>


    </div>
</div>


<section class="gradient-custom">
    <div class="container my-5 py-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12 col-lg-10 col-xl-8 py-5">
                <?php if (isset($allowRating[0]['total']) && $allowRating[0]['total'] == 1): ?>
                    <form action="/preview" method="post">
                        <input type="hidden" name="method" value="POST">
                        <div class="mb-3">
                            <label for="rating" class="form-label">Đánh giá:</label>
                            <div class="rating">
                                <span class="star" data-value="1">&#9733;</span>
                                <span class="star" data-value="2">&#9733;</span>
                                <span class="star" data-value="3">&#9733;</span>
                                <span class="star" data-value="4">&#9733;</span>
                                <span class="star" data-value="5">&#9733;</span>
                            </div>
                            <input type="hidden" name="rating_value" id="rating_value" value="0">
                        </div>
                        <textarea class="form-control mb-3" rows="5" placeholder="Hãy viết vào bình luận của bạn"
                            name="preview"></textarea>
                        <input type="hidden" name="product_id" value="<?= htmlspecialchars($productData['product_id']) ?>">
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-info text-white">Đánh giá</button>
                        </div>
                    </form>
                <?php endif; ?>
            </div>
        </div>

        <!-- Comments Display Section -->
        <div class="row d-flex justify-content-center">
            <div class="col-md-12 col-lg-10 col-xl-8">
                <div class="card">
                    <div class="card-body p-4">
                        <h4 class="text-center mb-4 pb-2">Comments</h4>
                        <?php if (!empty($ratingData)): ?>
                            <?php foreach ($ratingData as $rating): ?>
                                <div class="d-flex flex-start mb-4 comment-item">
                                    <img class="rounded-circle shadow-1-strong me-3"
                                        src="https://sinpo.id/storage/gambar/foto/wartawan/default_photo.jpg" alt="avatar"
                                        width="65" height="65" />
                                    <div class="flex-grow-1 flex-shrink-1">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <p class="mb-1"><?= htmlspecialchars($rating['name']) ?>
                                                <span class="separator">•</span>
                                                <span
                                                    class="small"><?= $ratingModel->getTimeAgo($rating['created_at']) ?></span>
                                            </p>
                                            <div>
                                                <?php if (isset($_SESSION['user']) && ($_SESSION['user']['id'] == $rating['user_id'] || $_SESSION['user']['role'] == 2)): ?>
                                                    <div>
                                                        <button type="button" class="btn btn-link btn-edit">
                                                            <i class="fas fa-edit fa-xs"></i><span class="small">Edit</span>
                                                        </button>
                                                        <form action="/deleteRating" method="POST" style="display: inline;">
                                                            <input type="hidden" name="rating_id"
                                                                value="<?= htmlspecialchars($rating['id']) ?>">
                                                            <input type="hidden" name="product_id"
                                                                value="<?= htmlspecialchars($productData['product_id']) ?>">
                                                            <button type="submit" class="btn btn-link btn-delete">
                                                                <i class="fas fa-trash fa-xs"></i><span class="small">Delete</span>
                                                            </button>
                                                        </form>
                                                    </div>
                                                <?php endif; ?>


                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <?php if (isset($rating['rating']) && is_numeric($rating['rating']) && $rating['rating'] > 0): ?>
                                                <div class="rating">
                                                    <?php for ($i = 0; $i < $rating['rating']; $i++): ?>
                                                        <span class="star-filled">&#9733;</span>
                                                    <?php endfor; ?>
                                                    <?php for ($i = $rating['rating']; $i < 5; $i++): ?>
                                                        <span class="stared">&#9734;</span>
                                                    <?php endfor; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <p class="small mb-0"><?= htmlspecialchars($rating['preview']) ?></p>
                                        <div class="edit-form mt-3" style="display: none;">
                                            <form action="/edit-preview" method="post">
                                                <input type="hidden" name="method" value="PUT">
                                                <div class="mb-3">
                                                    <label for="edit_rating_<?= htmlspecialchars($rating['id']) ?>"
                                                        class="form-label">Chỉnh sửa đánh giá:</label>
                                                    <div class="rating edit-rating">
                                                        <?php for ($i = 1; $i <= 5; $i++): ?>
                                                            <span
                                                                class="stars <?= $i <= $rating['rating'] ? 'star-filled' : 'stared' ?>"
                                                                data-value="<?= $i ?>">&#9733;</span>
                                                        <?php endfor; ?>
                                                    </div>
                                                    <input type="hidden" name="rating_value"
                                                        id="edit_rating_<?= htmlspecialchars($rating['id']) ?>"
                                                        value="<?= htmlspecialchars($rating['rating']) ?>">
                                                </div>
                                                <textarea class="form-control mb-2" placeholder="Chỉnh sửa bình luận của bạn"
                                                    name="preview"><?= htmlspecialchars($rating['preview']) ?></textarea>
                                                <input type="hidden" name="rating_id"
                                                    value="<?= htmlspecialchars($rating['id']) ?>">
                                                <input type="hidden" name="product_id"
                                                    value="<?= htmlspecialchars($productData['product_id']) ?>">
                                                <div class="d-flex justify-content-end">
                                                    <button class="btn btn-info w-15">Cập nhật</button>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="container text-center mt-5">
                                <h3 class="display-6">Không có bình luận nào</h3>
                                <p class="lead">Hãy bình luận cho chúng tôi nếu có phản hồi gì về sản phẩm!</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="gradient-custom">
    <div class="container my-5 py-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12 col-lg-10 col-xl-8 py-5">
                <form action="/comment" method="post">
                    <input type="hidden" name="method" value="POST">



                    <textarea class="form-control mb-3" rows="5" placeholder="Hãy viết vào bình luận của bạn"
                        name="content"></textarea>
                    <input type="hidden" name="product_id" value="<?= htmlspecialchars($productData['product_id']) ?>">

                    <div class="d-flex justify-content-end">
                        <button class="btn btn-info text-white">Bình luận</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Comments Display Section -->
        <div class="row d-flex justify-content-center">
            <div class="col-md-12 col-lg-10 col-xl-8">
                <div class="card">
                    <div class="card-body p-4">
                        <h4 class="text-center mb-4 pb-2">Comments</h4>
                        <?php if (!empty($commentData)): ?>
                            <?php foreach ($commentData as $comment): ?>
                                <div class="d-flex flex-start mb-4 comment-item">
                                    <img class="rounded-circle shadow-1-strong me-3"
                                        src="https://sinpo.id/storage/gambar/foto/wartawan/default_photo.jpg" alt="avatar"
                                        width="65" height="65" />
                                    <div class="flex-grow-1 flex-shrink-1">
                                        <div>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <p class="mb-1"><?= htmlspecialchars($comment['name']) ?>
                                                    <span class="separator">•</span>
                                                    <span
                                                        class="small"><?= $commentModel->getTimeAgo($comment['created_at']) ?></span>
                                                </p>
                                                <div>
                                                    <?php if (isset($_SESSION['user']) && ($_SESSION['user']['id'] == $comment['user_id'] || $_SESSION['user']['role'] == 2)): ?>

                                                        <button type="button" class="btn btn-link btn-edit"><i
                                                                class="fas fa-edit fa-xs"></i><span
                                                                class="small">edit</span></button>
                                                        <form action="/deleteComment" method="POST" style="display: inline;">
                                                            <input type="hidden" name="rating_id" value="<?= $comment['id'] ?>">
                                                            <input type="hidden" name="product_id"
                                                                value="<?= $productData['product_id'] ?>">
                                                            <button type="submit" class="btn btn-link btn-delete">
                                                                <i class="fas fa-trash fa-xs"></i><span class="small">Delete</span>
                                                            </button>
                                                        </form>
                                                    <?php endif; ?>
                                                    <button type="button" class="btn btn-link btn-reply"><i
                                                            class="fas fa-reply fa-xs"></i><span
                                                            class="small">reply</span></button>
                                                </div>
                                            </div>



                                            <p class="small mb-0"><?= htmlspecialchars($comment['content']) ?></p>

                                            <div class="reply-form mt-3" style="display: none;">
                                                <form action="/reply" method="post">
                                                    <textarea class="form-control mb-2" placeholder="Viết phản hồi của bạn"
                                                        name="content"></textarea>
                                                    <input type="hidden" name="product_id"
                                                        value="<?= htmlspecialchars($productData['product_id']) ?>">
                                                    <input type="hidden" name="parent_id"
                                                        value="<?= htmlspecialchars($comment['id']) ?>">
                                                    <div class="d-flex justify-content-end">
                                                        <button type="submit" class="btn btn-info w-15">Gửi phản hồi</button>
                                                    </div>
                                                </form>
                                            </div>

                                            <div class="edit-form mt-3" style="display: none;">
                                                <form action="/edit" method="post">
                                                    <input type="hidden" name="method" value="PUT">
                                                    <textarea class="form-control mb-2"
                                                        placeholder="Chỉnh sửa bình luận của bạn"
                                                        name="content"><?= htmlspecialchars($comment['content']) ?></textarea>
                                                    <input type="hidden" name="comment_id"
                                                        value="<?= htmlspecialchars($comment['id']) ?>">
                                                    <input type="hidden" name="product_id"
                                                        value="<?= htmlspecialchars($productData['product_id']) ?>">
                                                    <div class="d-flex justify-content-end">
                                                        <button class="btn btn-info w-15">Cập nhật</button>
                                                    </div>
                                                </form>
                                            </div>

                                            <div class="replies-section mt-4">
                                                <?php foreach ($commentReply as $reply): ?>
                                                    <?php if (($comment['id'] == $reply['parent_id'])): ?>
                                                        <div class="d-flex flex-start mb-4 comment-item">
                                                            <img class="rounded-circle shadow-1-strong me-3"
                                                                src="https://sinpo.id/storage/gambar/foto/wartawan/default_photo.jpg"
                                                                alt="avatar" width="50" height="50" />
                                                            <div class="flex-grow-1 flex-shrink-1">
                                                                <div>
                                                                    <p class="mb-1"><?= htmlspecialchars($reply['name']) ?>
                                                                        <span class="separator">•</span>
                                                                        <span
                                                                            class="small"><?= $commentModel->getTimeAgo($comment['created_at']) ?></span>
                                                                    </p>
                                                                    <p class="small mb-0"><?= htmlspecialchars($reply['content']) ?></p>

                                                                    <div class="text-end">
                                                                        <button type="button" class="btn btn-link btn-edit"
                                                                            data-reply-id="<?= $reply['id'] ?>">
                                                                            <i class="fas fa-edit fa-xs"></i><span
                                                                                class="small">edit</span>
                                                                        </button>
                                                                        <button type="button" class="btn btn-link btn-delete"
                                                                            data-reply-id="<?= $reply['id'] ?>">
                                                                            <i class="fas fa-trash fa-xs"></i><span
                                                                                class="small">delete</span>
                                                                        </button>
                                                                    </div>

                                                                    <div class="edit-form mt-3" style="display: none;">
                                                                        <form action="/editReply" method="post">
                                                                            <input type="hidden" name="reply_id"
                                                                                value="<?= $reply['id'] ?>">
                                                                            <textarea class="form-control mb-2"
                                                                                placeholder="Chỉnh sửa phản hồi của bạn"
                                                                                name="content"><?= htmlspecialchars($reply['content']) ?></textarea>
                                                                            <input type="hidden" name="comment_id"
                                                                                value="<?= htmlspecialchars($reply['id']) ?>">

                                                                            <input type="hidden" name="product_id"
                                                                                value="<?= htmlspecialchars($productData['product_id']) ?>">
                                                                            <div class="d-flex justify-content-end">
                                                                                <button class="btn btn-info">Cập nhật</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="container text-center mt-5">
                                <h3 class="display-6">Không có bình luận nào</h3>
                                <p class="lead">Hãy bình luận cho chúng tôi nếu có phản hồi gì về sản phẩm!</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<script>
    function changeImage1(imageSrc) {
        const mainImage = document.getElementById('mainImage');
        mainImage.style.opacity = 0;
        setTimeout(function() {
            mainImage.src = imageSrc;
            mainImage.style.transition = 'opacity 0.2s ease-in-out';
            mainImage.style.opacity = 1;
        }, 200);
    }




    let value = 0;

    function decrementProduct() {
        const quantityElement = document.getElementById('quantityProduct');
        const quantityInput = document.getElementById('quantityInput');
        let quantity = parseInt(quantityElement.innerText);

        if (quantity > 1) {
            quantity--;
            quantityElement.innerText = quantity;
            quantityInput.value = quantity;
        }
    }

    function incrementProduct() {
        const quantityElement = document.getElementById('quantityProduct');
        const quantityInput = document.getElementById('quantityInput');
        let quantity = parseInt(quantityElement.innerText);

        quantity++;
        quantityElement.innerText = quantity;
        quantityInput.value = quantity;
    }










    function changePriceAndImage(radioButton) {

        const newPrice = parseFloat(radioButton.getAttribute('data-price'));
        const oldPrice = parseFloat(radioButton.getAttribute('data-old-price'));


        const currentPriceElement = document.getElementById('current-price-<?= $productData['product_id'] ?>');
        const oldPriceElement = document.getElementById('old-price-<?= $productData['product_id'] ?>');


        currentPriceElement.innerText = newPrice.toLocaleString('de-DE', {
            minimumFractionDigits: 0,
            maximumFractionDigits: 0
        }) + " đ";

        if (oldPrice > newPrice) {
            oldPriceElement.innerText = oldPrice.toLocaleString('de-DE', {
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            }) + " đ";
        } else {
            oldPriceElement.innerText = '';
        }


        const newImageUrl = radioButton.getAttribute('data-image');
        const mainImage = document.getElementById('mainImage');
        mainImage.style.opacity = 0;
        setTimeout(function() {
            if (newImageUrl) {
                mainImage.src = newImageUrl;
                mainImage.style.transition = 'opacity 0.2s ease-in-out';
                mainImage.style.opacity = 1;
            }
        }, 200);
    }

    function onSkuSelect(radioButton) {

        changePriceAndImage(radioButton);


        const skuName = radioButton.getAttribute('product-name');
        const productNameElement = document.getElementById('product-name-<?= $productData['product_id'] ?>');


        const originalProductName = productNameElement.textContent.split(' - ')[0];
        productNameElement.textContent = `${originalProductName} - ${skuName}`;
    }


    function changeImage(radio) {

        const newImageUrl = radio.getAttribute('data-image');

        const mainImage = document.getElementById('mainImage');

        if (newImageUrl) {
            mainImage.src = newImageUrl;
        }
    }


    document.addEventListener('DOMContentLoaded', function() {

        document.querySelectorAll('.edit-rating .stars').forEach(function(star) {
            star.addEventListener('click', function() {
                const ratingValue = this.getAttribute('data-value');
                const ratingInput = document.getElementById('edit_rating_' + this.closest('form').querySelector('input[name="rating_id"]').value);


                ratingInput.value = ratingValue;


                document.querySelectorAll('.edit-rating .stars').forEach(function(s) {
                    if (s.getAttribute('data-value') <= ratingValue) {
                        s.classList.add('star-filled');
                        s.classList.remove('stared');
                    } else {
                        s.classList.remove('star-filled');
                        s.classList.add('stared');
                    }
                });
            });
        });

        document.querySelectorAll('.edit-rating .star').forEach(function(star) {
            star.addEventListener('mouseover', function() {
                const value = parseInt(star.getAttribute('data-value'));
                document.querySelectorAll('.edit-rating .star').forEach(function(s) {
                    const sValue = parseInt(s.getAttribute('data-value'));
                    s.style.color = sValue <= value ? 'gold' : '#d3d3d3';
                });
            });

            star.addEventListener('mouseout', function() {
                document.querySelectorAll('.edit-rating .star').forEach(function(s) {
                    s.style.color = s.classList.contains('star-filled') ? 'gold' : '#d3d3d3';
                });
            });
        });
    });


    document.addEventListener("DOMContentLoaded", function() {

        const editRatings = document.querySelectorAll(".edit-rating .star");

        editRatings.forEach(star => {
            star.addEventListener("click", function() {
                const parent = this.parentNode;
                const value = this.getAttribute("data-value");


                const hiddenInput = parent.nextElementSibling;
                hiddenInput.value = value;


                const stars = parent.querySelectorAll(".star");
                stars.forEach((s, index) => {
                    if (index < value) {
                        s.classList.add("star-filled");
                        s.classList.remove("stared");
                    } else {
                        s.classList.add("stared");
                        s.classList.remove("star-filled");
                    }
                });
            });
        });
    });


    document.addEventListener('DOMContentLoaded', function() {

        // Xử lý sự kiện click vào các ngôi sao đánh giá
        document.querySelectorAll('.star').forEach(function(star) {
            star.addEventListener('click', function() {
                let rating = this.getAttribute('data-value');
                document.getElementById('rating_value').value = rating;

                // Cập nhật giao diện sao đã chọn
                document.querySelectorAll('.star').forEach(function(s) {
                    if (s.getAttribute('data-value') <= rating) {
                        s.classList.add('star-filled');
                    } else {
                        s.classList.remove('star-filled');
                    }
                });
            });
        });

        // Xử lý hiệu ứng hover cho các ngôi sao
        document.querySelectorAll('.rating .star').forEach((star) => {
            star.addEventListener('mouseover', () => {
                const value = parseInt(star.getAttribute('data-value'));
                document.querySelectorAll('.rating .star').forEach((s) => {
                    const sValue = parseInt(s.getAttribute('data-value'));
                    if (sValue <= value) {
                        s.style.color = 'gold';
                    } else {
                        s.style.color = '#d3d3d3';
                    }
                });
            });

            star.addEventListener('mouseout', () => {
                document.querySelectorAll('.rating .star').forEach((s) => {
                    if (!s.classList.contains('selected')) {
                        s.style.color = '#d3d3d3';
                    }
                });
            });

            star.addEventListener('click', () => {
                const value = parseInt(star.getAttribute('data-value'));
                document.getElementById('rating_value').value = value;

                document.querySelectorAll('.rating .star').forEach((s, index) => {
                    if (index < value) {
                        s.classList.add('selected');
                    } else {
                        s.classList.remove('selected');
                    }
                });
            });
        });

        // Xử lý sự kiện click cho các sản phẩm trong mục "Mua"
        document.querySelectorAll(".product__info__buy").forEach(group => {
            const labels = group.querySelectorAll(".product__info__buy div div");

            labels.forEach(label => {
                label.addEventListener("click", function() {
                    labels.forEach(lbl => lbl.classList.remove("active-product"));
                    label.classList.add("active-product");
                });
            });
        });

        // Xử lý sự kiện cho nút trả lời trong bình luận
        document.querySelectorAll('.btn-reply').forEach(function(btn) {
            btn.addEventListener('click', function() {
                let commentItem = this.closest('.comment-item');
                let replyForm = commentItem.querySelector('.reply-form');
                let editForm = commentItem.querySelector('.edit-form');
                replyForm.style.display = replyForm.style.display === 'none' ? 'block' : 'none';
                editForm.style.display = 'none';
            });
        });

        // Xử lý sự kiện cho nút chỉnh sửa trong bình luận
        document.querySelectorAll('.btn-edit').forEach(function(btn) {
            btn.addEventListener('click', function() {
                let commentItem = this.closest('.comment-item');
                let editForm = commentItem.querySelector('.edit-form');
                let replyForm = commentItem.querySelector('.reply-form');
                editForm.style.display = editForm.style.display === 'none' ? 'block' : 'none';
                replyForm.style.display = 'none';
            });
        });

        // Xử lý sự kiện cho nút xóa trong bình luận
        document.querySelectorAll('.btn-delete').forEach(function(btn) {
            btn.addEventListener('click', function() {
                alert('Đã xóa thành công');
            });
        });
    });
</script>

<?php $this->stop() ?>
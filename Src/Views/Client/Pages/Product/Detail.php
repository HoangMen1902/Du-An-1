<?php $this->layout('Client/Components/Layout'); ?>



<?php $this->start('main_content') ?>
<!-- Insert nội dung vào đây -->
<div class="product-detal__container">
    <div class="product__carousel">
        <div class="product__main-carousel-ids">
            <button onclick="">
                <img src="https://www.phongcachxanh.vn/cdn/shop/files/pre-order-lot-chu-t-kinh-c-ng-l-c-tekkusai-the-beast-limited-42087967293685.jpg?v=1730188755&width=64"
                    alt="">
            </button>

            <button onclick="">
                <img src="https://www.phongcachxanh.vn/cdn/shop/files/pre-order-lot-chu-t-kinh-c-ng-l-c-tekkusai-the-beast-limited-42087967064309.jpg?v=1730188758&width=64"
                    alt="">
            </button>

        </div>
        <div class="product__carousel-wrapper">
            <div style="display: block;" class="product__carousel-wrapper__slide">
                <img id="mainImage" src="<?= $_ENV['APP_URL'] ?>/public/Uploads/Brands/1731271265.png"
                    alt="">
            </div>

            <div class="product__carousel-wrapper__slide">
                <img src="/public/uploads/" alt="">
            </div>

        </div>
    </div>



    <div class="product__info">
        <h4 id="product-name-<?= $productData['product_id'] ?>"><?= $productData['product_name']  ?>
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
            <span id="old-price-<?= $productData['product_id'] ?>" class="related-card__sub-price__delete" style="color: black;">
                <?= number_format($productData['skus'][1]['original_price']) ?> đ
            </span>
            <span id="current-price-<?= $productData['product_id'] ?>">
                <?= number_format($productData['skus'][1]['discounted_price']) ?> đ
            </span>
        </p>

        <hr>
        <p><?= $productData['description'] ?></p>

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
                            <input
                                form="add-to-cart"
                                class="hidden"
                                type="radio"
                                value="<?= htmlspecialchars(json_encode($sku['options'])) ?>"
                                name="sku_options"
                                data-image="<?= $_ENV['APP_URL'] ?>/public/Uploads/Products/<?= htmlspecialchars($sku['images']) ?>"
                                data-price="<?= $sku['discounted_price'] ?>"
                                data-old-price="<?= $sku['original_price'] ?>"
                                product-name="<?= $sku['sku'] ?>"
                                onclick="onSkuSelect(this)">
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





        <h4><i class="fa fa-eye">lượt xem</i>:</h4>
        <p>Số lượng:</p>
        <div class="product__info__buy__quantity">
            <button onclick="decrementProduct()" class="product__info__buy__button-l">-</button>
            <p id="quantityProduct">1</p>
            <button onclick="incrementProduct()" class="product__info__buy__button-r">+</button>
        </div>
        <p>Chọn mua:</p>
        <form id="add-to-cart" action="/add-to-cart" method="post">
            <input type="hidden" id="quantityInput" name="quantity" value="1">
            <button class="product__info__buy__button text-white" name="add-to-cart">Chọn mua</button>
        </form>

    </div>
</div>

</div>


<section class="container container-des" style="margin: auto">
    <div class="feature-chart">
        <h2>Thông số kỹ thuật</h2>
        <div class="table-row">
            <div class="table-row__title">
                <p>Công nghệ CPU</p>
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
                <p>Số Nhân</p>
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
                <p>Số luồng</p>
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
                <p>Tốc độ CPU</p>
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
                <p>Tốc độ tối đa</p>
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
                <p>Bộ nhớ đệm</p>
            </div>
            <div class="table-row__text">
                <p>
                    <span>

                    </span>
                </p>
            </div>
        </div>
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
</section>


<section class="container container-des" style="margin: auto">
    <div class="feature-chart">
        <h2>Thông số kỹ thuật</h2>
        <div class="table-row">
            <div class="table-row__title">
                <p>Thông báo:</p>
            </div>
            <div class="table-row__text">
                <p>
                    <span>
                        Sản phẩm đang cập nhật thông số kỹ thuật vui lòng quay lại sau!
                    </span>
                </p>
            </div>
        </div>
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
                        <img class="product-img" id="main-img-1" src="https://www.phongcachxanh.vn/cdn/shop/files/chu-t-khong-day-sieu-nh-fnatic-x-lamzu-maya-x-8k-di-kem-dongle-8khz-41690680787189.jpg?v=1726324338&width=800" class="card-img-top" alt="ảnh sản phẩm">
                        <div class="card-body">
                            <h5 class="card-title mb-2 text-limit">Lót chuột Lethal Gaming Gear Jupiter PRO (V2)</h5>
                            <p class="card-text mb-2 text-limit">Thuộc phân loại Control - Slow, chậm nhất trong các dòng PRO của Lethal Gaming.</p>

                            <div class="d-flex justify-content-star align-items-center">
                                <span class="price text-muted mb-2 text-decoration-line-through">1.500.000đ</span>
                                <span class="price mb-2 ms-2">1.000.000đ</span>
                            </div>
                            <button class="btn btn-mainColor button-hover button-add text-white rounded-5 position-absolute ">Mua ngay</button>

                            <div class="d-flex mt-3">
                                <button class="img-thumbnail col-3  me-1 product-thumbnail  " onclick="changeImage('main-img-1', 'https://www.phongcachxanh.vn/cdn/shop/files/chu-t-khong-day-sieu-nh-fnatic-x-lamzu-maya-x-8k-di-kem-dongle-8khz-41690680787189.jpg?v=1726324338&width=800')">
                                    <img class="col-12 " src="https://www.phongcachxanh.vn/cdn/shop/files/chu-t-khong-day-sieu-nh-fnatic-x-lamzu-maya-x-8k-di-kem-dongle-8khz-41690680787189.jpg?v=1726324338&width=800" alt="thumbnail">
                                </button>
                                <button class="img-thumbnail col-3 me-1 product-thumbnail" onclick="changeImage('main-img-1', 'https://www.phongcachxanh.vn/cdn/shop/files/lot-chu-t-lethal-gaming-gear-jupiter-pro-v2-41227243946229.jpg?v=1726313363&width=800')">
                                    <img class="col-12" src="https://www.phongcachxanh.vn/cdn/shop/files/lot-chu-t-lethal-gaming-gear-jupiter-pro-v2-41227243946229.jpg?v=1726313363&width=800" alt="thumbnail">
                                </button>
                                <button class="img-thumbnail col-3 me-1 product-thumbnail" onclick="changeImage('main-img-1', 'https://www.phongcachxanh.vn/cdn/shop/files/chu-t-khong-day-sieu-nh-fnatic-x-lamzu-maya-x-8k-di-kem-dongle-8khz-41690680787189.jpg?v=1726324338&width=800')">
                                    <img class="col-12" src="https://www.phongcachxanh.vn/cdn/shop/files/chu-t-khong-day-sieu-nh-fnatic-x-lamzu-maya-x-8k-di-kem-dongle-8khz-41690680787189.jpg?v=1726324338&width=800" alt="thumbnail">
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4  col-xxl-3">
                    <div class="card position-relative" id="card-2">
                        <img class="product-img" id="main-img-2" src="https://www.phongcachxanh.vn/cdn/shop/files/chu-t-khong-day-sieu-nh-fnatic-x-lamzu-maya-x-8k-di-kem-dongle-8khz-41690680787189.jpg?v=1726324338&width=800" class="card-img-top" alt="ảnh sản phẩm">
                        <div class="card-body">
                            <h5 class="card-title mb-2 text-limit">Lót chuột Lethal Gaming Gear Jupiter PRO (V2)</h5>
                            <p class="card-text mb-2 text-limit">Thuộc phân loại Control - Slow, chậm nhất trong các dòng PRO của Lethal Gaming.</p>

                            <div class="d-flex justify-content-star align-items-center">
                                <span class="price text-muted mb-2 text-decoration-line-through">1.500.000đ</span>
                                <span class="price mb-2 ms-2">1.000.000đ</span>
                            </div>
                            <button class="btn btn-mainColor button-hover button-add  text-white rounded-5 position-absolute">Mua ngay</button>

                            <div class="d-flex mt-3">
                                <button class="img-thumbnail col-3 me-1 product-thumbnail" onclick="changeImage('main-img-2', 'https://www.phongcachxanh.vn/cdn/shop/files/chu-t-khong-day-sieu-nh-fnatic-x-lamzu-maya-x-8k-di-kem-dongle-8khz-41690680787189.jpg?v=1726324338&width=800')">
                                    <img class="col-12" src="https://www.phongcachxanh.vn/cdn/shop/files/chu-t-khong-day-sieu-nh-fnatic-x-lamzu-maya-x-8k-di-kem-dongle-8khz-41690680787189.jpg?v=1726324338&width=800" alt="thumbnail">
                                </button>
                                <button class="img-thumbnail col-3 me-1 product-thumbnail" onclick="changeImage('main-img-2', 'https://www.phongcachxanh.vn/cdn/shop/files/lot-chu-t-lethal-gaming-gear-jupiter-pro-v2-41227243946229.jpg?v=1726313363&width=800')">
                                    <img class="col-12" src="https://www.phongcachxanh.vn/cdn/shop/files/lot-chu-t-lethal-gaming-gear-jupiter-pro-v2-41227243946229.jpg?v=1726313363&width=800" alt="thumbnail">
                                </button>
                                <button class="img-thumbnail col-3 me-1 product-thumbnail" onclick="changeImage('main-img-2', 'https://www.phongcachxanh.vn/cdn/shop/files/chu-t-khong-day-sieu-nh-fnatic-x-lamzu-maya-x-8k-di-kem-dongle-8khz-41690680787189.jpg?v=1726324338&width=800')">
                                    <img class="col-12" src="https://www.phongcachxanh.vn/cdn/shop/files/chu-t-khong-day-sieu-nh-fnatic-x-lamzu-maya-x-8k-di-kem-dongle-8khz-41690680787189.jpg?v=1726324338&width=800" alt="thumbnail">
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4  col-xxl-3">
                    <div class="card position-relative" id="card-2">
                        <img class="product-img" id="main-img-2 product-img" src="https://www.phongcachxanh.vn/cdn/shop/files/chu-t-khong-day-sieu-nh-fnatic-x-lamzu-maya-x-8k-di-kem-dongle-8khz-41690680787189.jpg?v=1726324338&width=800" class="card-img-top" alt="ảnh sản phẩm">
                        <div class="card-body">
                            <h5 class="card-title mb-2 text-limit">Lót chuột Lethal Gaming Gear Jupiter PRO (V2)</h5>
                            <p class="card-text mb-2 text-limit">Thuộc phân loại Control - Slow, chậm nhất trong các dòng PRO của Lethal Gaming.</p>

                            <div class="d-flex justify-content-star align-items-center">
                                <span class="price text-muted mb-2 text-decoration-line-through">1.500.000đ</span>
                                <span class="price mb-2 ms-2">1.000.000đ</span>
                            </div>
                            <button class="btn btn-mainColor button-hover button-add  text-white rounded-5 position-absolute">Mua ngay</button>

                            <div class="d-flex mt-3">
                                <button class="img-thumbnail col-3 me-1 product-thumbnail" onclick="changeImage('main-img-2', 'https://www.phongcachxanh.vn/cdn/shop/files/chu-t-khong-day-sieu-nh-fnatic-x-lamzu-maya-x-8k-di-kem-dongle-8khz-41690680787189.jpg?v=1726324338&width=800')">
                                    <img class="col-12" src="https://www.phongcachxanh.vn/cdn/shop/files/chu-t-khong-day-sieu-nh-fnatic-x-lamzu-maya-x-8k-di-kem-dongle-8khz-41690680787189.jpg?v=1726324338&width=800" alt="thumbnail">
                                </button>
                                <button class="img-thumbnail col-3 me-1 product-thumbnail" onclick="changeImage('main-img-2', 'https://www.phongcachxanh.vn/cdn/shop/files/lot-chu-t-lethal-gaming-gear-jupiter-pro-v2-41227243946229.jpg?v=1726313363&width=800')">
                                    <img class="col-12" src="https://www.phongcachxanh.vn/cdn/shop/files/lot-chu-t-lethal-gaming-gear-jupiter-pro-v2-41227243946229.jpg?v=1726313363&width=800" alt="thumbnail">
                                </button>
                                <button class="img-thumbnail col-3 me-1 product-thumbnail" onclick="changeImage('main-img-2', 'https://www.phongcachxanh.vn/cdn/shop/files/chu-t-khong-day-sieu-nh-fnatic-x-lamzu-maya-x-8k-di-kem-dongle-8khz-41690680787189.jpg?v=1726324338&width=800')">
                                    <img class="col-12" src="https://www.phongcachxanh.vn/cdn/shop/files/chu-t-khong-day-sieu-nh-fnatic-x-lamzu-maya-x-8k-di-kem-dongle-8khz-41690680787189.jpg?v=1726324338&width=800" alt="thumbnail">
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4  col-xxl-3">
                    <div class="card position-relative" id="card-2">
                        <img class="product-img" id="main-img-2" src="https://www.phongcachxanh.vn/cdn/shop/files/chu-t-khong-day-sieu-nh-fnatic-x-lamzu-maya-x-8k-di-kem-dongle-8khz-41690680787189.jpg?v=1726324338&width=800" class="card-img-top" alt="ảnh sản phẩm">
                        <div class="card-body">
                            <h5 class="card-title mb-2 text-limit">Lót chuột Lethal Gaming Gear Jupiter PRO (V2)</h5>
                            <p class="card-text mb-2 text-limit">Thuộc phân loại Control - Slow, chậm nhất trong các dòng PRO của Lethal Gaming.</p>

                            <div class="d-flex justify-content-star align-items-center">
                                <span class="price text-muted mb-2 text-decoration-line-through">1.500.000đ</span>
                                <span class="price mb-2 ms-2">1.000.000đ</span>
                            </div>
                            <button class="btn btn-mainColor button-hover button-add  text-white rounded-5 position-absolute">Mua ngay</button>

                            <div class="d-flex mt-3">
                                <button class="img-thumbnail col-3 me-1 product-thumbnail" onclick="changeImage('main-img-2', 'https://www.phongcachxanh.vn/cdn/shop/files/chu-t-khong-day-sieu-nh-fnatic-x-lamzu-maya-x-8k-di-kem-dongle-8khz-41690680787189.jpg?v=1726324338&width=800')">
                                    <img class="col-12" src="https://www.phongcachxanh.vn/cdn/shop/files/chu-t-khong-day-sieu-nh-fnatic-x-lamzu-maya-x-8k-di-kem-dongle-8khz-41690680787189.jpg?v=1726324338&width=800" alt="thumbnail">
                                </button>
                                <button class="img-thumbnail col-3 me-1 product-thumbnail" onclick="changeImage('main-img-2', 'https://www.phongcachxanh.vn/cdn/shop/files/lot-chu-t-lethal-gaming-gear-jupiter-pro-v2-41227243946229.jpg?v=1726313363&width=800')">
                                    <img class="col-12" src="https://www.phongcachxanh.vn/cdn/shop/files/lot-chu-t-lethal-gaming-gear-jupiter-pro-v2-41227243946229.jpg?v=1726313363&width=800" alt="thumbnail">
                                </button>
                                <button class="img-thumbnail col-3 me-1 product-thumbnail" onclick="changeImage('main-img-2', 'https://www.phongcachxanh.vn/cdn/shop/files/chu-t-khong-day-sieu-nh-fnatic-x-lamzu-maya-x-8k-di-kem-dongle-8khz-41690680787189.jpg?v=1726324338&width=800')">
                                    <img class="col-12" src="https://www.phongcachxanh.vn/cdn/shop/files/chu-t-khong-day-sieu-nh-fnatic-x-lamzu-maya-x-8k-di-kem-dongle-8khz-41690680787189.jpg?v=1726324338&width=800" alt="thumbnail">
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4  col-xxl-3">
                    <div class="card position-relative" id="card-2">
                        <img class="product-img" id="main-img-2" src="https://www.phongcachxanh.vn/cdn/shop/files/chu-t-khong-day-sieu-nh-fnatic-x-lamzu-maya-x-8k-di-kem-dongle-8khz-41690680787189.jpg?v=1726324338&width=800" class="card-img-top" alt="ảnh sản phẩm">
                        <div class="card-body">
                            <h5 class="card-title mb-2 text-limit">Lót chuột Lethal Gaming Gear Jupiter PRO (V2)</h5>
                            <p class="card-text mb-2 text-limit">Thuộc phân loại Control - Slow, chậm nhất trong các dòng PRO của Lethal Gaming.</p>

                            <div class="d-flex justify-content-star align-items-center">
                                <span class="price text-muted mb-2 text-decoration-line-through">1.500.000đ</span>
                                <span class="price mb-2 ms-2">1.000.000đ</span>
                            </div>
                            <button class="btn btn-mainColor button-hover button-add  text-white rounded-5 position-absolute">Mua ngay</button>

                            <div class="d-flex mt-3">
                                <button class="img-thumbnail col-3 me-1 product-thumbnail" onclick="changeImage('main-img-2', 'https://www.phongcachxanh.vn/cdn/shop/files/chu-t-khong-day-sieu-nh-fnatic-x-lamzu-maya-x-8k-di-kem-dongle-8khz-41690680787189.jpg?v=1726324338&width=800')">
                                    <img class="col-12" src="https://www.phongcachxanh.vn/cdn/shop/files/chu-t-khong-day-sieu-nh-fnatic-x-lamzu-maya-x-8k-di-kem-dongle-8khz-41690680787189.jpg?v=1726324338&width=800" alt="thumbnail">
                                </button>
                                <button class="img-thumbnail col-3 me-1 product-thumbnail" onclick="changeImage('main-img-2', 'https://www.phongcachxanh.vn/cdn/shop/files/lot-chu-t-lethal-gaming-gear-jupiter-pro-v2-41227243946229.jpg?v=1726313363&width=800')">
                                    <img class="col-12" src="https://www.phongcachxanh.vn/cdn/shop/files/lot-chu-t-lethal-gaming-gear-jupiter-pro-v2-41227243946229.jpg?v=1726313363&width=800" alt="thumbnail">
                                </button>
                                <button class="img-thumbnail col-3 me-1 product-thumbnail" onclick="changeImage('main-img-2', 'https://www.phongcachxanh.vn/cdn/shop/files/chu-t-khong-day-sieu-nh-fnatic-x-lamzu-maya-x-8k-di-kem-dongle-8khz-41690680787189.jpg?v=1726324338&width=800')">
                                    <img class="col-12" src="https://www.phongcachxanh.vn/cdn/shop/files/chu-t-khong-day-sieu-nh-fnatic-x-lamzu-maya-x-8k-di-kem-dongle-8khz-41690680787189.jpg?v=1726324338&width=800" alt="thumbnail">
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
                <form action="/comment" method="post">
                    <input type="hidden" name="method" value="POST">

                    <!-- Star Rating Section -->
                    <div class="mb-3">
                        <label for="rating" class="form-label">Đánh giá:</label>
                        <div class="star-rating">
                            <input type="radio" name="rating" id="star5" value="5" class="rating-input">
                            <label for="star5" class="star">&#9733;</label>
                            <input type="radio" name="rating" id="star4" value="4" class="rating-input">
                            <label for="star4" class="star">&#9733;</label>
                            <input type="radio" name="rating" id="star3" value="3" class="rating-input" checked>
                            <label for="star3" class="star">&#9733;</label>
                            <input type="radio" name="rating" id="star2" value="2" class="rating-input">
                            <label for="star2" class="star">&#9734;</label>
                            <input type="radio" name="rating" id="star1" value="1" class="rating-input">
                            <label for="star1" class="star">&#9734;</label>
                        </div>
                    </div>

                    <!-- Comment Section -->
                    <textarea class="form-control mb-3" rows="5" placeholder="Hãy viết vào bình luận của bạn"
                        name="content"></textarea>
                    <input type="hidden" name="product_id" value="">
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
                        <!-- Comment Item -->
                        <div class="d-flex flex-start mb-4 comment-item">
                            <img class="rounded-circle shadow-1-strong me-3"
                                src="https://sinpo.id/storage/gambar/foto/wartawan/default_photo.jpg" alt="avatar"
                                width="65" height="65" />
                            <div class="flex-grow-1 flex-shrink-1">
                                <div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <p class="mb-1">
                                            Username
                                            <span class="separator">•</span>
                                            <span class="small">3 hours ago</span>
                                        </p>
                                        <div>
                                            <button type="button" class="btn btn-link btn-edit"><i
                                                    class="fas fa-edit fa-xs"></i><span
                                                    class="small">edit</span></button>
                                            <button type="button" class="btn btn-link btn-delete"><i
                                                    class="fas fa-trash fa-xs"></i><span
                                                    class="small">delete</span></button>
                                            <button type="button" class="btn btn-link btn-reply"><i
                                                    class="fas fa-reply fa-xs"></i><span
                                                    class="small">reply</span></button>
                                        </div>
                                    </div>

                                    <!-- Display Rating -->
                                    <div class="star-rating">
                                        <span>&#9733;</span>
                                        <span>&#9733;</span>
                                        <span>&#9733;</span>
                                        <span>&#9734;</span>
                                        <span>&#9734;</span>
                                    </div>

                                    <p class="small mb-0">Good product...</p>

                                    <!-- Reply Form -->
                                    <div class="reply-form mt-3" style="display: none;">
                                        <form action="/reply" method="post">
                                            <input type="hidden" name="method" value="POST">
                                            <textarea class="form-control mb-2" placeholder="Viết phản hồi của bạn"
                                                name="content"></textarea>
                                            <div class="d-flex justify-content-end">
                                                <button class="btn btn-info w-15">Gửi phản hồi</button>
                                            </div>
                                        </form>
                                    </div>

                                    <!-- Edit Form -->
                                    <div class="edit-form mt-3" style="display: none;">
                                        <form action="/edit-comment" method="post">
                                            <input type="hidden" name="method" value="PUT">
                                            <textarea class="form-control mb-2"
                                                placeholder="Chỉnh sửa bình luận của bạn"
                                                name="content">Good product...</textarea>
                                            <div class="d-flex justify-content-end">
                                                <button class="btn btn-info w-15">Cập nhật</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <!-- Nested Replies -->
                                <div class="d-flex flex-start mt-4 comment-item">
                                    <a class="me-3" href="#">
                                        <img class="rounded-circle shadow-1-strong"
                                            src="https://sinpo.id/storage/gambar/foto/wartawan/default_photo.jpg"
                                            alt="avatar" width="65" height="65" />
                                    </a>
                                    <div class="flex-grow-1 flex-shrink-1">
                                        <div>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <p class="mb-1">
                                                    Username
                                                    <span class="separator">•</span>
                                                    <span class="small">2 hours ago</span>
                                                </p>
                                                <div>
                                                    <button type="button" class="btn btn-link btn-edit"><i
                                                            class="fas fa-edit fa-xs"></i><span
                                                            class="small">edit</span></button>
                                                    <button type="button" class="btn btn-link btn-delete"><i
                                                            class="fas fa-trash fa-xs"></i><span
                                                            class="small">delete</span></button>
                                                </div>
                                            </div>
                                            <p class="small mb-0">Reply content here...</p>

                                            <!-- Edit Form for Reply -->
                                            <div class="edit-form mt-3" style="display: none;">
                                                <form action="/edit-comment" method="post">
                                                    <input type="hidden" name="method" value="PUT">
                                                    <textarea class="form-control mb-2"
                                                        placeholder="Chỉnh sửa bình luận của bạn"
                                                        name="content">Reply content here...</textarea>
                                                    <div class="d-flex justify-content-end">
                                                        <button class="btn btn-info w-15">Cập nhật</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="container text-center mt-5">
                            <h3 class="display-6">Không có bình luận nào</h3>
                            <p class="lead">Hãy bình luận cho chúng tôi nếu có phản hồi gì về sản phẩm!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
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
        // Lấy giá giảm và giá gốc từ radio button
        const newPrice = parseFloat(radioButton.getAttribute('data-price')); // Giá giảm
        const oldPrice = parseFloat(radioButton.getAttribute('data-old-price')); // Giá gốc

        // Lấy các phần tử hiển thị giá
        const currentPriceElement = document.getElementById('current-price-<?= $productData['product_id'] ?>');
        const oldPriceElement = document.getElementById('old-price-<?= $productData['product_id'] ?>');

        // Cập nhật giá giảm
        currentPriceElement.innerText = newPrice.toLocaleString('de-DE', {
            minimumFractionDigits: 0,
            maximumFractionDigits: 0
        }) + " đ";

        // Cập nhật giá gốc nếu giá gốc cao hơn giá giảm
        if (oldPrice > newPrice) {
            oldPriceElement.innerText = oldPrice.toLocaleString('de-DE', {
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            }) + " đ";
        } else {
            oldPriceElement.innerText = '';
        }

        // Cập nhật hình ảnh sản phẩm
        const newImageUrl = radioButton.getAttribute('data-image');
        const mainImage = document.getElementById('mainImage');
        if (newImageUrl) {
            mainImage.src = newImageUrl;
        }
    }

    function onSkuSelect(radioButton) {
        // Gọi hàm cập nhật giá và ảnh
        changePriceAndImage(radioButton);

        // Cập nhật tên sản phẩm với mã SKU
        const skuName = radioButton.getAttribute('product-name');
        const productNameElement = document.getElementById('product-name-<?= $productData['product_id'] ?>');

        // Lấy tên sản phẩm gốc và cập nhật với mã SKU
        const originalProductName = productNameElement.textContent.split(' - ')[0];
        productNameElement.textContent = `${originalProductName} - ${skuName}`;
    }


    function changeImage(radio) {
        // Lấy URL ảnh từ thuộc tính `data-image` của radio button được chọn
        const newImageUrl = radio.getAttribute('data-image');
        // Lấy phần tử ảnh chính
        const mainImage = document.getElementById('mainImage');
        // Thay đổi ảnh hiển thị
        if (newImageUrl) {
            mainImage.src = newImageUrl;
        }
    }





    document.addEventListener('DOMContentLoaded', function() {
        const stars = document.querySelectorAll('.star');

        stars.forEach(star => {
            star.addEventListener('click', function() {
                // Xóa lớp 'selected' khỏi tất cả các ngôi sao
                stars.forEach(s => s.classList.remove('selected'));

                // Đánh dấu ngôi sao đã chọn
                this.classList.add('selected');

                // Cập nhật input radio tương ứng
                const ratingInput = this.previousElementSibling; // Lấy radio input tương ứng
                ratingInput.checked = true; // Đánh dấu là đã chọn
            });
        });
    });

    document.querySelectorAll(".product__info__buy").forEach(group => {
        const labels = group.querySelectorAll(".product__info__buy div div");

        labels.forEach(label => {
            label.addEventListener("click", function() {
                labels.forEach(lbl => lbl.classList.remove("active-product"));
                label.classList.add("active-product");
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.btn-reply').forEach(function(btn) {
            btn.addEventListener('click', function() {
                let commentItem = this.closest('.comment-item');
                let replyForm = commentItem.querySelector('.reply-form');
                let editForm = commentItem.querySelector('.edit-form');
                replyForm.style.display = replyForm.style.display === 'none' ? 'block' : 'none';
                editForm.style.display = 'none';
            });
        });

        document.querySelectorAll('.btn-edit').forEach(function(btn) {
            btn.addEventListener('click', function() {
                let commentItem = this.closest('.comment-item');
                let editForm = commentItem.querySelector('.edit-form');
                let replyForm = commentItem.querySelector('.reply-form');
                editForm.style.display = editForm.style.display === 'none' ? 'block' : 'none';
                replyForm.style.display = 'none';
            });
        });

        document.querySelectorAll('.btn-delete').forEach(function(btn) {
            btn.addEventListener('click', function() {
                alert('Đã xóa thành công');
            });
        });
    });
</script>

<?php $this->stop() ?>
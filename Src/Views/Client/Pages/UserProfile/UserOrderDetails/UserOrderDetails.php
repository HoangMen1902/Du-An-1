
        <section class="account">
    <div class="container-fluid">
        <div class="row g-0">
        <?php
            include $_ENV['APP_URL'] . 'App/Views/Client/Pages/UserProfile/Particals/account-sidebar.php';
            ?>
            <div class="col-lg-9">
                <div class="order-detail account-info">
                    <div class="order-detail__actions back d-none d-lg-block">
                        <a href="./orders.php">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.4375 18.75L4.6875 12L11.4375 5.25M5.625 12H19.3125" stroke="#2E2E2E"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                            <strong>Đơn hàng</strong>
                        </a>
                    </div>
                    <div class="order-detail__meta">
                        <div class="order-detail__content">
                            <h5 class="order-detail__ord-number">
                                <div>
                                    Đơn hàng <span style="display: inline-block;"><strong
                                            class="js-hook">#ECO672454N01</strong>
                                        <svg class="clipboard" width="20" height="20" viewBox="0 0 20 20" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M13.125 13.125H16.875V3.125H6.875V6.875" stroke="#2E2E2E"
                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M13.125 6.875H3.125V16.875H13.125V6.875Z" stroke="#2E2E2E"
                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </span>
                                </div>
                                <span class="order-detail__shipment-sts d-block d-lg-none">Đã hủy</span>
                            </h5>
                            <p class="order-detail__payment-sts">
                                Thanh Toán: <span><strong class="js-hook">Chưa thanh toán</strong></span>
                            </p>
                            <p class="order-detail__quantity">
                                Số lượng: <span><strong class="js-hook">1 sản phẩm</strong></span>
                            </p>
                        </div>
                        <div class="order-detail__content-2">
                            <p class="order-detail__shipment-detail">
                                <strong>Chi tiết giao hàng</strong>
                                <span class="order-detail__shipment-sts d-none d-lg-block">Đã hủy</span>
                            </p>
                            <p class="order-detail__customer"><strong>Nguyen Hoaibao</strong> - 0343492104</p>
                            <p class="order-detail__address">Hem 51, Xã Thành An, Thị xã An Khê, Gia Lai</p>
                        </div>
                    </div>
                    <div class="order-detail__items">
                        <a href="javascript:void(0)" class="order">
                            <div test="0" data-id="1106150626" class="order__product" data-refund="true">
                                <div class="product list-item">
                                    <div class="image-wrapper"><a href="javascript:void(0)">
                                            <picture><img class=" ls-is-cached lazyloaded"
                                                    alt="Rubik MSO Limited (Hàng tặng không bán)" aa=""
                                                    data-src="https://product.hstatic.net/1000284478/product/rubik_6828613575ec41109e554a15797295d9.jpg"
                                                    src="https://product.hstatic.net/1000284478/product/rubik_6828613575ec41109e554a15797295d9.jpg">
                                            </picture>
                                        </a>
                                    </div>
                                    <div class="text-wrapper">
                                        <a href="javascript:void(0)" class="product-brand">Khác</a>
                                        <a href="javascript:void(0)" class="product-name">
                                            <p>Rubik MSO Limited (Hàng tặng không bán)</p>
                                        </a>
                                        <div class="quantity"><strong>0₫ x 1</strong></div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="order-detail__summary">
                        <h3>
                            <strong>tóm tắt đơn hàng</strong>
                        </h3>
                        <div class="order-detail__subtotal">
                            <div>
                                <strong>
                                    Tạm Tính
                                </strong>
                                <small class="js-hook">1 sản phẩm</small>
                            </div>
                            <strong class="js-hook">0₫</strong>
                        </div>
                        <div class="order-detail__shipping-fee">
                            <strong>
                                Phí Giao Hàng
                            </strong>
                            <strong class="js-hook">+ 8,021₫</strong>
                        </div>
                        <div class="order-detail__promo-code">
                            <strong>
                                Mã Giảm Giá
                            </strong>
                            <strong class="js-hook">- 0₫</strong>
                        </div>
                        <div class="order-detail__total">
                            <span>
                                Tổng đơn hàng
                            </span>
                            <span class="js-hook">8,021₫</span>
                        </div>
                    </div>
                </div>
     </div>

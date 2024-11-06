<?php $this->layout('Client/Components/Layout'); ?>



<?php $this->start('main_content') ?>
<!-- Insert nội dung vào đây -->


<div class="container">

    <div class="row pt-3">
        <h5>Danh sách sản phẩm</h5>
        <div class="row">
            <div class="col-auto">
                <h7 class="opacity-50 ">Trang chủ <span>/</span></h7>
            </div>
            <div class="col-auto p-0">
                <h7>Danh sách sản phẩm</h7>
            </div>
        </div>


    </div>


    <div class="row">
        <div class="col-xl-2 col-md-3 my-4 px-3">
            <div class="filter">
                <h4>
                    <svg xmlns="http://www.w3.org/2000/svg" height="20px" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75" />
                    </svg>
                    Lọc
                </h4>

                <div class="filter-section stock">
                    <label for="in-stock">Còn hàng</label>
                    <input type="checkbox" id="in-stock">
                </div>

                <div class="filter-section">
                    <label for="brand-filter">Thương hiệu</label>
                    <select id="brand-filter">
                        <option value="">Tất cả</option>
                        <option value="Arbiter Studio">Arbiter Studio</option>
                        <option value="Cherry Xtrfy">Cherry Xtrfy</option>
                        <option value="DrunkDeer">DrunkDeer</option>
                        <option value="Glorious">Glorious</option>
                        <option value="Pulsar">Pulsar</option>
                        <option value="Vancer">Vancer</option>
                        <option value="Yuki Aim">Yuki Aim</option>
                    </select>
                </div>

                <div class="filter-section">
                    <label for="product-type-filter">Loại sản phẩm</label>
                    <select id="product-type-filter">
                        <option value="">Tất cả</option>
                        <option value="type1">Type 1</option>
                        <option value="type2">Type 2</option>
                    </select>
                </div>

                <div class="filter-section">
                    <label for="size-filter">Size</label>
                    <select id="size-filter">
                        <option value="">Tất cả</option>
                        <option value="small">Nhỏ</option>
                        <option value="medium">Vừa</option>
                        <option value="large">Lớn</option>
                    </select>
                </div>
                <div class="filter-section">
                    <label for="price-range">Giá</label>
                    <input type="range" id="price-range" min="0" max="100000000" step="1000000" value="15000000" oninput="updatePriceDisplay(this.value)">
                    <div class="price-display">15,000,000 đ</div>
                </div>
            </div>
        </div>
        <div class="col-md-10 my-4 p-0">

            <div class="col-12 d-flex justify-content-between p-0">
                <div class="col-6 ">
                    <button class="col-2 btn  border me-1" style="height: 40px; background-color: #1C61E7; color: white; ">Mới nhất</button>
                    <button class="col-2 btn  border mx-1" style="height: 40px; ">Liên quan</button>
                    <button class="col-2 btn  border mx-1" style="height: 40px; ">Bán chạy</button>
                    <div class="col-2 btn   mx-1 filter-section m-0 p-0" style="height: 40px;">
                        <select id=" size-filter" style="height: 40px;">
                            <option value="">Giá</option>
                            <option value="small">Thấp đến cao</option>
                            <option value="medium">Cao đến thấp</option>
                        </select>
                    </div>
                </div>
                <div class="col-3 d-flex align-items-center justify-content-end">
                    <p class="m-0 me-3">1/3</p>
                    <div class=" col-2 btn btn border " style="height: 40px; ">></div>

                    <div class=" col-2 btn btn border " style="height: 40px; ">></div>

                </div>
            </div>






            <div class="col-12">



                <div class="row mt-3 d-flex">



                    <div class="col-md-3 mb-4">
                        <div class="card position-relative">
                            <img id="main-img" src="https://www.phongcachxanh.vn/cdn/shop/files/chu-t-khong-day-sieu-nh-fnatic-x-lamzu-maya-x-8k-di-kem-dongle-8khz-41690680787189.jpg?v=1726324338&width=800" class="card-img-top" alt="ảnh sản phẩm">
                            <div class="card-body">
                                <h5 class="card-title mb-2 text-limit">Lót chuột Lethal Gaming Gear Jupiter PRO (V2)</h5>
                                <p class="card-text mb-2 text-limit">Thuộc phân loại Control - Slow, chậm nhất trong các dòng PRO của Lethal Gaming.</p>

                                <div class="d-flex justify-content-star align-items-center">
                                    <span class="price text-muted mb-2 text-decoration-line-through">1.500.000đ</span>
                                    <span class="price mb-2 ms-2">1.000.000đ</span>
                                </div>
                                <button class="btn btn-mainColor button-hover mt-3 text-white rounded-5 position-absolute" style="right: 10px; top:220px; height: 40px;">Mua ngay</button>

                                <div>
                                    <button class="img-thumbnail col-3" onclick="changeImage('https://www.phongcachxanh.vn/cdn/shop/files/chu-t-khong-day-sieu-nh-fnatic-x-lamzu-maya-x-8k-di-kem-dongle-8khz-41690680787189.jpg?v=1726324338&width=800')">
                                        <img class=" col-12" src="https://www.phongcachxanh.vn/cdn/shop/files/chu-t-khong-day-sieu-nh-fnatic-x-lamzu-maya-x-8k-di-kem-dongle-8khz-41690680787189.jpg?v=1726324338&width=800" alt="">
                                    </button>
                                    <button class="img-thumbnail col-3" onclick="changeImage(' https://www.phongcachxanh.vn/cdn/shop/files/lot-chu-t-lethal-gaming-gear-jupiter-pro-v2-41227243946229.jpg?v=1726313363&width=800 ')">
                                        <img class="col-12" src="https://www.phongcachxanh.vn/cdn/shop/files/lot-chu-t-lethal-gaming-gear-jupiter-pro-v2-41227243946229.jpg?v=1726313363&width=800" alt="">
                                    </button>
                                    <button class="img-thumbnail col-3" onclick="changeImage('https://www.phongcachxanh.vn/cdn/shop/files/chu-t-khong-day-sieu-nh-fnatic-x-lamzu-maya-x-8k-di-kem-dongle-8khz-41690680787189.jpg?v=1726324338&width=800')">
                                        <img class=" col-12" src="https://www.phongcachxanh.vn/cdn/shop/files/chu-t-khong-day-sieu-nh-fnatic-x-lamzu-maya-x-8k-di-kem-dongle-8khz-41690680787189.jpg?v=1726324338&width=800" alt="">
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 mb-4">
                        <div class="card position-relative">
                            <img id="main-img" src="https://www.phongcachxanh.vn/cdn/shop/files/chu-t-khong-day-sieu-nh-fnatic-x-lamzu-maya-x-8k-di-kem-dongle-8khz-41690680787189.jpg?v=1726324338&width=800" class="card-img-top" alt="ảnh sản phẩm">
                            <div class="card-body">
                                <h5 class="card-title mb-2 text-limit">Lót chuột Lethal Gaming Gear Jupiter PRO (V2)</h5>
                                <p class="card-text mb-2 text-limit">Thuộc phân loại Control - Slow, chậm nhất trong các dòng PRO của Lethal Gaming.</p>

                                <div class="d-flex justify-content-star align-items-center">
                                    <span class="price text-muted mb-2 text-decoration-line-through">1.500.000đ</span>
                                    <span class="price mb-2 ms-2">1.000.000đ</span>
                                </div>
                                <button class="btn btn-mainColor button-hover mt-3 text-white rounded-5 position-absolute" style="right: 10px; top:220px; height: 40px;">Mua ngay</button>

                                <div>
                                    <button class="img-thumbnail col-3" onclick="changeImage('https://www.phongcachxanh.vn/cdn/shop/files/chu-t-khong-day-sieu-nh-fnatic-x-lamzu-maya-x-8k-di-kem-dongle-8khz-41690680787189.jpg?v=1726324338&width=800')">
                                        <img class=" col-12" src="https://www.phongcachxanh.vn/cdn/shop/files/chu-t-khong-day-sieu-nh-fnatic-x-lamzu-maya-x-8k-di-kem-dongle-8khz-41690680787189.jpg?v=1726324338&width=800" alt="">
                                    </button>
                                    <button class="img-thumbnail col-3" onclick="changeImage(' https://www.phongcachxanh.vn/cdn/shop/files/lot-chu-t-lethal-gaming-gear-jupiter-pro-v2-41227243946229.jpg?v=1726313363&width=800 ')">
                                        <img class="col-12" src="https://www.phongcachxanh.vn/cdn/shop/files/lot-chu-t-lethal-gaming-gear-jupiter-pro-v2-41227243946229.jpg?v=1726313363&width=800" alt="">
                                    </button>
                                    <button class="img-thumbnail col-3" onclick="changeImage('https://www.phongcachxanh.vn/cdn/shop/files/chu-t-khong-day-sieu-nh-fnatic-x-lamzu-maya-x-8k-di-kem-dongle-8khz-41690680787189.jpg?v=1726324338&width=800')">
                                        <img class=" col-12" src="https://www.phongcachxanh.vn/cdn/shop/files/chu-t-khong-day-sieu-nh-fnatic-x-lamzu-maya-x-8k-di-kem-dongle-8khz-41690680787189.jpg?v=1726324338&width=800" alt="">
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="card position-relative">
                            <img id="main-img" src="https://www.phongcachxanh.vn/cdn/shop/files/chu-t-khong-day-sieu-nh-fnatic-x-lamzu-maya-x-8k-di-kem-dongle-8khz-41690680787189.jpg?v=1726324338&width=800" class="card-img-top" alt="ảnh sản phẩm">
                            <div class="card-body">
                                <h5 class="card-title mb-2 text-limit">Lót chuột Lethal Gaming Gear Jupiter PRO (V2)</h5>
                                <p class="card-text mb-2 text-limit">Thuộc phân loại Control - Slow, chậm nhất trong các dòng PRO của Lethal Gaming.</p>

                                <div class="d-flex justify-content-star align-items-center">
                                    <span class="price text-muted mb-2 text-decoration-line-through">1.500.000đ</span>
                                    <span class="price mb-2 ms-2">1.000.000đ</span>
                                </div>
                                <button class="btn btn-mainColor button-hover mt-3 text-white rounded-5 position-absolute" style="right: 10px; top:220px; height: 40px;">Mua ngay</button>

                                <div>
                                    <button class="img-thumbnail col-3" onclick="changeImage('https://www.phongcachxanh.vn/cdn/shop/files/chu-t-khong-day-sieu-nh-fnatic-x-lamzu-maya-x-8k-di-kem-dongle-8khz-41690680787189.jpg?v=1726324338&width=800')">
                                        <img class=" col-12" src="https://www.phongcachxanh.vn/cdn/shop/files/chu-t-khong-day-sieu-nh-fnatic-x-lamzu-maya-x-8k-di-kem-dongle-8khz-41690680787189.jpg?v=1726324338&width=800" alt="">
                                    </button>
                                    <button class="img-thumbnail col-3" onclick="changeImage(' https://www.phongcachxanh.vn/cdn/shop/files/lot-chu-t-lethal-gaming-gear-jupiter-pro-v2-41227243946229.jpg?v=1726313363&width=800 ')">
                                        <img class="col-12" src="https://www.phongcachxanh.vn/cdn/shop/files/lot-chu-t-lethal-gaming-gear-jupiter-pro-v2-41227243946229.jpg?v=1726313363&width=800" alt="">
                                    </button>
                                    <button class="img-thumbnail col-3" onclick="changeImage('https://www.phongcachxanh.vn/cdn/shop/files/chu-t-khong-day-sieu-nh-fnatic-x-lamzu-maya-x-8k-di-kem-dongle-8khz-41690680787189.jpg?v=1726324338&width=800')">
                                        <img class=" col-12" src="https://www.phongcachxanh.vn/cdn/shop/files/chu-t-khong-day-sieu-nh-fnatic-x-lamzu-maya-x-8k-di-kem-dongle-8khz-41690680787189.jpg?v=1726324338&width=800" alt="">
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="card position-relative">
                            <img id="main-img" src="https://www.phongcachxanh.vn/cdn/shop/files/chu-t-khong-day-sieu-nh-fnatic-x-lamzu-maya-x-8k-di-kem-dongle-8khz-41690680787189.jpg?v=1726324338&width=800" class="card-img-top" alt="ảnh sản phẩm">
                            <div class="card-body">
                                <h5 class="card-title mb-2 text-limit">Lót chuột Lethal Gaming Gear Jupiter PRO (V2)</h5>
                                <p class="card-text mb-2 text-limit">Thuộc phân loại Control - Slow, chậm nhất trong các dòng PRO của Lethal Gaming.</p>

                                <div class="d-flex justify-content-star align-items-center">
                                    <span class="price text-muted mb-2 text-decoration-line-through">1.500.000đ</span>
                                    <span class="price mb-2 ms-2">1.000.000đ</span>
                                </div>
                                <button class="btn btn-mainColor button-hover mt-3 text-white rounded-5 position-absolute" style="right: 10px; top:220px; height: 40px;">Mua ngay</button>

                                <div>
                                    <button class="img-thumbnail col-3" onclick="changeImage('https://www.phongcachxanh.vn/cdn/shop/files/chu-t-khong-day-sieu-nh-fnatic-x-lamzu-maya-x-8k-di-kem-dongle-8khz-41690680787189.jpg?v=1726324338&width=800')">
                                        <img class=" col-12" src="https://www.phongcachxanh.vn/cdn/shop/files/chu-t-khong-day-sieu-nh-fnatic-x-lamzu-maya-x-8k-di-kem-dongle-8khz-41690680787189.jpg?v=1726324338&width=800" alt="">
                                    </button>
                                    <button class="img-thumbnail col-3" onclick="changeImage(' https://www.phongcachxanh.vn/cdn/shop/files/lot-chu-t-lethal-gaming-gear-jupiter-pro-v2-41227243946229.jpg?v=1726313363&width=800 ')">
                                        <img class="col-12" src="https://www.phongcachxanh.vn/cdn/shop/files/lot-chu-t-lethal-gaming-gear-jupiter-pro-v2-41227243946229.jpg?v=1726313363&width=800" alt="">
                                    </button>
                                    <button class="img-thumbnail col-3" onclick="changeImage('https://www.phongcachxanh.vn/cdn/shop/files/chu-t-khong-day-sieu-nh-fnatic-x-lamzu-maya-x-8k-di-kem-dongle-8khz-41690680787189.jpg?v=1726324338&width=800')">
                                        <img class=" col-12" src="https://www.phongcachxanh.vn/cdn/shop/files/chu-t-khong-day-sieu-nh-fnatic-x-lamzu-maya-x-8k-di-kem-dongle-8khz-41690680787189.jpg?v=1726324338&width=800" alt="">
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 mb-4">
                        <div class="card position-relative">
                            <img id="main-img" src="https://www.phongcachxanh.vn/cdn/shop/files/chu-t-khong-day-sieu-nh-fnatic-x-lamzu-maya-x-8k-di-kem-dongle-8khz-41690680787189.jpg?v=1726324338&width=800" class="card-img-top" alt="ảnh sản phẩm">
                            <div class="card-body">
                                <h5 class="card-title mb-2 text-limit">Lót chuột Lethal Gaming Gear Jupiter PRO (V2)</h5>
                                <p class="card-text mb-2 text-limit">Thuộc phân loại Control - Slow, chậm nhất trong các dòng PRO của Lethal Gaming.</p>

                                <div class="d-flex justify-content-star align-items-center">
                                    <span class="price text-muted mb-2 text-decoration-line-through">1.500.000đ</span>
                                    <span class="price mb-2 ms-2">1.000.000đ</span>
                                </div>
                                <button class="btn btn-mainColor button-hover mt-3 text-white rounded-5 position-absolute" style="right: 10px; top:220px; height: 40px;">Mua ngay</button>

                                <div>
                                    <button class="img-thumbnail col-3" onclick="changeImage('https://www.phongcachxanh.vn/cdn/shop/files/chu-t-khong-day-sieu-nh-fnatic-x-lamzu-maya-x-8k-di-kem-dongle-8khz-41690680787189.jpg?v=1726324338&width=800')">
                                        <img class=" col-12" src="https://www.phongcachxanh.vn/cdn/shop/files/chu-t-khong-day-sieu-nh-fnatic-x-lamzu-maya-x-8k-di-kem-dongle-8khz-41690680787189.jpg?v=1726324338&width=800" alt="">
                                    </button>
                                    <button class="img-thumbnail col-3" onclick="changeImage(' https://www.phongcachxanh.vn/cdn/shop/files/lot-chu-t-lethal-gaming-gear-jupiter-pro-v2-41227243946229.jpg?v=1726313363&width=800 ')">
                                        <img class="col-12" src="https://www.phongcachxanh.vn/cdn/shop/files/lot-chu-t-lethal-gaming-gear-jupiter-pro-v2-41227243946229.jpg?v=1726313363&width=800" alt="">
                                    </button>
                                    <button class="img-thumbnail col-3" onclick="changeImage('https://www.phongcachxanh.vn/cdn/shop/files/chu-t-khong-day-sieu-nh-fnatic-x-lamzu-maya-x-8k-di-kem-dongle-8khz-41690680787189.jpg?v=1726324338&width=800')">
                                        <img class=" col-12" src="https://www.phongcachxanh.vn/cdn/shop/files/chu-t-khong-day-sieu-nh-fnatic-x-lamzu-maya-x-8k-di-kem-dongle-8khz-41690680787189.jpg?v=1726324338&width=800" alt="">
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>


</div>

<script>
    function changeImage(imageSrc) {
        const mainImage = document.getElementById('main-img');
        mainImage.style.opacity = 0;
        setTimeout(function() {
            mainImage.src = imageSrc;
            mainImage.style.transition = 'opacity 0.2s ease-in-out';
            mainImage.style.opacity = 1;
        }, 200);
    }
</script>



<?php $this->stop() ?>
<?php
$this->push('scripts')
?>
<script src="<?= $_ENV['APP_URL'] ?>/public/Assets/Client/js/Filter.js"></script>
<?php
$this->end();
?>
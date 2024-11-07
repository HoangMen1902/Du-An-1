<?php $this->layout('Client/Components/Layout'); ?>



<?php $this->start('main_content') ?>
<div class="container">    
    <div class="row text-center py-3 pb-0">
        <!-- Dòng kết quả tìm kiếm -->
        <div class="search-result-count">
            <h1>335 kết quả tìm kiếm cho "lót chuột"</h1>
        </div>
        <!-- Thanh tìm kiếm -->
        <div class="search-bar-wrapper ">
            <div class="search-bar">
                <input type="text" id="search-input" placeholder="Tìm kiếm sản phẩm...">
                <span class="search-icon" onclick="searchProducts()">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="24" height="24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 15.75L19.5 19.5M10.5 15.75a5.25 5.25 0 1 0 0-10.5 5.25 5.25 0 0 0 0 10.5z" />
                    </svg>
                </span>
            </div>
        </div>

    </div>
  
<div class="container">




<div class="row ">
    <div class="col-xl-2 col-md-3 my-4 px-3 d-none d-lg-block ">
        <div class="filter">
            <h4 >
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
    
    <div class="col-xxl-10 col-md-12  my-4 p-0">

   






        <div class="col-12 ">

       

                <div class="row mt-3 d-flex">
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
                                <button class="btn btn-mainColor button-hover button-add  text-white rounded-5 position-absolute" >Mua ngay</button>

                                <div class="d-flex mt-3">
                                    <button class="img-thumbnail col-3 me-1 product-thumbnail"  onclick="changeImage('main-img-2', 'https://www.phongcachxanh.vn/cdn/shop/files/chu-t-khong-day-sieu-nh-fnatic-x-lamzu-maya-x-8k-di-kem-dongle-8khz-41690680787189.jpg?v=1726324338&width=800')">
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
                                <button class="btn btn-mainColor button-hover button-add  text-white rounded-5 position-absolute" >Mua ngay</button>

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
                                <button class="btn btn-mainColor button-hover button-add  text-white rounded-5 position-absolute" >Mua ngay</button>

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
                                <button class="btn btn-mainColor button-hover button-add  text-white rounded-5 position-absolute" >Mua ngay</button>

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
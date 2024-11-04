<?php $this->layout('Client/Components/Layout'); ?>



<?php $this->start('main_content') ?>
<div class="container">
    <div class="row text-center py-5">
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
    <div class="row">
        <div class="col-xl-3 col-md-3 my-5">
            <div class="filter-panel">
                <h3>
                    <svg xmlns="http://www.w3.org/2000/svg" height="20px" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75" />
                    </svg>
                    Lọc
                </h3>

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
        <div class="col-md-9 my-5">
        </div>
    </div>
</div>




<?php $this->stop() ?>




<?php
$this->push('scripts')
?>
<script src="<?= $_ENV['APP_URL'] ?>/public/Assets/Client/js/Filter.js"></script>
<?php
$this->end();
?>
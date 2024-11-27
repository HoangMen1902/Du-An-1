<?php $this->layout('Client/Components/Layout'); ?>



<?php $this->start('main_content') ?>
<!-- Insert nội dung vào đây -->

<div class="container dssp">

    <div class="row pt-3 ">
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


    <div class="row ">
        <div class="col-xl-2 col-md-3 my-4 px-3 d-none d-lg-block ">
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

        <div class="col-xxl-10 col-md-12  my-4 p-0">

            <div class="col-12 d-flex justify-content-between p-0">
                <div class="col-xxl-7 col-md-9 ">
                    <button class="col-xxl-2 btn  border me-1 col-md-3" style="height: 40px; background-color: #1C61E7; color: white; ">Mới nhất</button>
                    <button class="col-xxl-2 btn  border mx-1 col-md-3" style="height: 40px; ">Liên quan</button>
                    <button class="col-xxl-2 btn  border mx-1 col-md-3" style="height: 40px; ">Bán chạy</button>
                    <div class="col-2 btn   mx-1 filter-section m-0 p-0" style="height: 40px;">
                        <select id=" size-filter" style="height: 40px;">
                            <option value="">Giá</option>
                            <option value="small">Thấp đến cao</option>
                            <option value="medium">Cao đến thấp</option>
                        </select>
                    </div>
                </div>
                <div class="col-xxl-3  d-flex align-items-center justify-content-end ">
                    <p class="m-0 me-3">1/3</p>
                    <div class=" col-xxl-2 col-md-3 btn btn border " style="height: 40px; "><svg style="width: 10px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                            <path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l192 192c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L77.3 256 246.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-192 192z" />
                        </svg></div>

                    <div class=" col-xxl-2 col-md-3 btn btn border " style="height: 40px; "><svg style="width: 10px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                            <path d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z" />
                        </svg></div>

                </div>
            </div>






            <div class="col-12 ">

                <div class="row mt-3 d-flex">
                    <?php foreach ($productData as $product):
                        $thumbnail = explode(',', $product['thumbnail']);
                    ?>
                        <div class="col-md-4 mb-4 col-xxl-3 card-list ">
                            <div class="card position-relative h-100" id="card-<?= $product['product_id'] ?>">
                                <div class="w-100 ratio ratio-1x1 ">
                                    <img class="product-img   p-3" style="object-fit: contain; "
                                        src="<?= $_ENV['APP_URL'] ?>/public/Uploads/Products/<?= $thumbnail[0] ?>"
                                        alt="<?= $product['product_name'] ?>"
                                        id="main-image-<?= $product['product_id'] ?>"
                                        data-product-id="<?= $product['product_id'] ?>">
                                </div>

                                <div class="card-body  " style="display: flex; flex-direction: column;">
                                    <h5 class="card-title mb-2 text-limit" id="product-name-<?= $product['product_id'] ?>">
                                        <?= $product['product_name'] ?>
                                        <span id="sku-attributes-<?= $product['product_id'] ?>"></span> <!-- Đây là nơi hiển thị thuộc tính SKU -->
                                    </h5>
                                    <?=$product['short_description']?>

                                    <div class="price">
                                        <?php if ($product['skus']) :
                                            $sku = current($product['skus']);
                                            $oldPrice = $sku['original_price'];
                                            $currentPrice = $sku['discounted_price'];
                                        ?>
                                            <?php if ($oldPrice > $currentPrice) : ?>
                                                <span class="price text-muted mb-2 text-decoration-line-through old-price" id="old-price-<?= $product['product_id'] ?>"><?= number_format($oldPrice) ?> đ</span>
                                            <?php endif; ?>
                                            <span class="price mb-2 ms-2 current-price" id="current-price-<?= $product['product_id'] ?>"><?= number_format($currentPrice) ?> đ</span>
                                        <?php endif; ?>
                                    </div>
                                    <a href="detail/<?= $product['product_id'] ?>" class="btn btn-mainColor button-hover button-add text-white rounded-5 position-absolute">
                                        Mua ngay
                                    </a>
                                    <div style="margin-top: auto;">
                                        <?php foreach ($product['skus'] as $sku) : ?>
                                            <button class="img-thumbnail  me-1 product-thumbnail  ">
                                                <img class="col-12 variant-image "
                                                    src="<?= $_ENV['APP_URL'] ?>/public/Uploads/Products/<?= $sku['images'] ?>"
                                                    alt="Variant Image"
                                                    onclick="changeVariant(<?= $product['product_id'] ?>,
                                                     '<?= $_ENV['APP_URL'] ?>/public/Uploads/Products/<?= $sku['images'] ?>',
                                                     <?= $sku['discounted_price'] ?>,
                                                      <?= $sku['original_price'] ?>)">

                                            </button>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function changeVariant(productId, imageUrl, newPrice, oldPrice) {
        document.getElementById('main-image-' + productId).src = imageUrl;

        document.getElementById('current-price-' + productId).innerText = newPrice.toLocaleString() + ' đ';

        if (oldPrice > newPrice) {
            document.getElementById('old-price-' + productId).innerText = oldPrice.toLocaleString() + ' đ';
        }
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
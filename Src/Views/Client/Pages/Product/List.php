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
                    <input type="checkbox" id="in-stock" data-filter="in-stock">
                </div>

                <div class="filter-section">
                    <label for="brand-filter">Thương hiệu</label>
                    <select class="brand-filter" name="brand" data-filter="brand">
                        <option value="">Chọn thương hiệu</option>
                        <?php if (isset($brands) && !empty($brands)): ?>
                            <?php foreach ($brands as $brand): ?>
                                <option value="<?= $brand['id'] ?>"><?= $brand['name'] ?></option>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <option value="">Không có thương hiệu</option>
                        <?php endif; ?>
                    </select>
                </div>

                <div class="filter-section">
                    <label for="product-type-filter">Danh mục</label>
                    <select class="product-type-filter" id="categories" name="categories">
                        <option value="">Chọn danh mục</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                        <?php endforeach; ?>
                    </select>

                    <div id="child_category" style="display:none;">
                        <label for="child_category">Danh mục phụ :</label>
                        <select class="product-type-filter" id="child_category_select" name="child_category" data-filter="child_category">
                            <option value="">Chọn danh mục</option>
                        </select>
                    </div>
                </div>
                <div class="filter-section">
                    <select id="sort-by-price" data-filter="sort" style="height: 40px;">
                        <option value="">Giá</option>
                        <option value="asc">Giá thấp đến cao</option>
                        <option value="desc">Giá cao xuống thấp</option>
                    </select>
                </div>

                <div class="filter-section">
                    <label for="price-range">Giá</label>
                    <input type="range" id="price-range" min="0" max="100000000" step="1000000" value="0" data-filter="price" oninput="updatePriceDisplay(this.value)">
                    <div class="price-display">0 đ</div>
                </div>
                <button class="btn btn-warning" onclick="clearFilters()">Về mặc định</button>

            </div>
        </div>

        <div class="col-xxl-10 col-md-12  my-4 p-0">

            <div class="col-12 d-flex justify-content-between p-0">
                <div class="col-xxl-7 col-md-9 ">
                    <button class="col-xxl-2 btn  border me-1 col-md-3" style="height: 40px; background-color: #1C61E7; color: white; ">Mới nhất</button>
                    <button class="col-xxl-2 btn  border mx-1 col-md-3" style="height: 40px; ">Liên quan</button>
                    <button class="col-xxl-2 btn  border mx-1 col-md-3" style="height: 40px; ">Bán chạy</button>
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






            <div class="col-12">

                <div class="row mt-3 d-flex" id="product-filter">
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



<?php $this->stop() ?>
<?php
$this->push('scripts')
?>
<script>
    function changeVariant(productId, imageUrl, newPrice, oldPrice) {
        document.getElementById('main-image-' + productId).src = imageUrl;

        document.getElementById('current-price-' + productId).innerText = newPrice.toLocaleString() + ' đ';

        if (oldPrice > newPrice) {
            document.getElementById('old-price-' + productId).innerText = oldPrice.toLocaleString() + ' đ';
        }
    }


    $(document).ready(function() {
        $('.product-thumbnail').on('click', function() {
            const productId = $(this).closest('.card').attr('id').replace('card-', '');
            const variantImage = $(this).find('.variant-image').attr('src');
            const discountedPrice = $(this).find('.variant-image').data('discounted-price');
            const originalPrice = $(this).find('.variant-image').data('original-price');

            changeVariant(productId, variantImage, discountedPrice, originalPrice);
        });
    });


    function clearFilters() {
        window.location.href = '/list'; // URL không chứa tham số lọc
    }

    $(document).ready(function() {
        function getFilters() {
            return {
                in_stock: $('#in-stock').is(':checked') ? 1 : 0,
                brand: $('.brand-filter').val() || null,
                child_category: $('#child_category_select').val() || null,
                min_price: $('#price-range').val() || null,
                sort_by_price: $('#sort-by-price').val() || null,
            };
        }

        function isFilterActive(filters) {
            return Object.values(filters).some(value => value !== null && value !== 0 && value !== '');
        }

        function applyFilters() {
            const filters = getFilters();
            if (!isFilterActive(filters)) {
                console.log('Không có bộ lọc nào được áp dụng.');
                return;
            }

            $.ajax({
                url: '/filter-products',
                type: 'GET',
                data: filters,
                success: function(response) {
                    try {
                        const products = JSON.parse(response);
                        updateProductList(products);
                    } catch (error) {
                        console.error('Dữ liệu trả về không hợp lệ:', error);
                    }
                },
                error: function() {
                    console.error('Lỗi khi lọc sản phẩm.');
                },
            });
        }

        function updateProductList(products) {
            const productList = $('#product-filter');
            productList.empty();

            if (products && Object.keys(products).length > 0) {
                Object.entries(products).forEach(([index, value]) => {
                    const thumbnails = value.thumbnail.split(',');
                    const firstThumbnail = thumbnails[0];
                    const firstSku = value.skus[Object.keys(value.skus)[0]];
                    let variantHTML = '';

                    Object.entries(value.skus).forEach(([key, variant]) => {
                        if (variant.images) {
                            variantHTML += `
                         <button class="img-thumbnail me-1 product-thumbnail">
                             <img class="col-12 variant-image"
                                  src="<?= $_ENV['APP_URL'] ?>/public/Uploads/Products/${variant.images}"
                                  alt="Variant Image"
                                  data-product-id="${value.product_id}"
                                  data-variant-image="<?= $_ENV['APP_URL'] ?>/public/Uploads/Products/${variant.images}"
                                  data-discounted-price="${variant.discounted_price}"
                                  data-original-price="${variant.original_price}">
                         </button>`;
                        }
                    });

                    productList.append(`
                 <div class="col-md-4 mb-4 col-xxl-3 card-list" id="product-${value.product_id}">
                     <div class="card position-relative h-100">
                         <div class="w-100 ratio ratio-1x1">
                             <img class="product-img p-3" style="object-fit: contain;"
                                  src="<?= $_ENV['APP_URL'] ?>/public/Uploads/Products/${firstThumbnail}"
                                  alt="${value.product_name}" id="main-image-${value.product_id}" />
                         </div>
                         <div class="card-body">
                             <h5 class="card-title">${value.product_name}</h5>
                             <p class="card-text">${value.description}</p>
                             <div class="price">
                                 ${value.discount ? `<span class="old-price text-muted text-decoration-line-through">${parseInt(firstSku.original_price).toLocaleString()} đ</span>` : ''}
                                 <span class="current-price">${parseInt(firstSku.discounted_price).toLocaleString()} đ</span>
                             </div>
                             <a href="detail/${value.product_id}" class="btn btn-mainColor button-hover button-add text-white rounded-5 position-absolute">
                                 Mua ngay
                             </a>
                             <div style="margin-top: auto;" class="variant-holder">
                                 ${variantHTML}
                             </div>
                         </div>
                     </div>
                 </div>`);

                    $('#product-' + value.product_id + ' .variant-image').on('click', function() {
                        changeVariant(
                            value.product_id,
                            $(this).data('variant-image'),
                            $(this).data('discounted-price'),
                            $(this).data('original-price')
                        );
                    });
                });
            } else {
                productList.append('<p>Không tìm thấy sản phẩm nào.</p>');
            }
        }


        $('.filter [data-filter]').on('change', applyFilters);
    });
</script>
<script src="<?= $_ENV['APP_URL'] ?>/public/Assets/Client/js/Filter.js"></script>
<?php
$this->end();
?>
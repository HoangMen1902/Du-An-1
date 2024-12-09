<?php $this->layout('Client/Components/Layout'); ?>

<?php $this->start('main_content') ?>
<div class="container">
    <div class="row text-center py-3 pb-0">
        <!-- Dòng kết quả tìm kiếm -->
        <div class="search-result-count">
            <?php if (count($searchResult) > 0) : ?>
                <h1 style="padding: 20px;">Có <?= count($searchResult) ?> kết quả được tìm thấy cho '<?= $keyword ?>'</h1>
            <?php else : ?>
                <h1 style="padding: 20px;">Không có kết quả được tìm thấy cho '<?= $keyword ?>'</h1>
            <?php endif; ?>
        </div>


        <div class="search-bar-wrapper ">
            <div class="search-bar">
                <form class="searchOffCanvas__form" action="/search" method="GET" id="search-form">
                    <input type="text" id="search-input" name="search" placeholder="Tìm kiếm sản phẩm...">

                    <button type="submit" style="display: none;"></button>
                </form>
                <span class="search-icon" onclick="searchProducts()">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="24" height="24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 15.75L19.5 19.5M10.5 15.75a5.25 5.25 0 1 0 0-10.5 5.25 5.25 0 0 0 0 10.5z" />
                    </svg>
                </span>
            </div>

        </div>
    </div>

    <div class="container">
        <div class="row justify-content-around">
            <div class="col-xxl-10 col-md-12 my-4 p-0">
                <div class="col-12">
                    <div class="row mt-3">
                        <?php foreach ($searchResult as $product) :
                            $thumbnail = explode(',', $product['thumbnail']);
                        ?>
                            <div class="col-md-4 mb-4 col-xxl-3 card-list">
                                <div class="card position-relative h-100" id="card-<?= $product['product_id'] ?>">
                                    <div class="w-100 ratio ratio-1x1">
                                        <img class="product-img p-3" style="object-fit: contain;"
                                            src="<?= $_ENV['APP_URL'] ?>/public/Uploads/Products/<?= $thumbnail[0] ?>"
                                            alt="<?= $product['product_name'] ?>"
                                            id="main-image-<?= $product['product_id'] ?>"
                                            data-product-id="<?= $product['product_id'] ?>">
                                    </div>

                                    <div class="card-body" style="display: flex; flex-direction: column;">
                                        <h5 class="card-title mb-2 text-limit" id="product-name-<?= $product['product_id'] ?>">
                                            <?= $product['product_name'] ?>
                                            <span id="sku-attributes-<?= $product['product_id'] ?>"></span>
                                        </h5>

                                        <p class="card-text mb-2 text-limit"><?= $product['description'] ?></p>

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
                                                <button class="img-thumbnail me-1 product-thumbnail">
                                                    <img class="col-12 variant-image"
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

</div>


<?php $this->stop() ?>

<?php
$this->push('scripts')
?>
<script>
    function searchProducts() {
        var keyword = document.getElementById("search-input").value;
        if (keyword.trim() !== "") {

            document.getElementById("search-form").submit();
        } else {

            alert("Vui lòng nhập từ khóa tìm kiếm!");
        }
    }

    function changeVariant(productId, imageUrl, newPrice, oldPrice) {
        let mainImage = document.getElementById('main-image-' + productId);
        if (mainImage) {
            mainImage.src = imageUrl;
        }

        if (newPrice !== undefined && newPrice !== null) {
            let currentPriceElement = document.getElementById('current-price-' + productId);
            if (currentPriceElement) {
                currentPriceElement.innerText = newPrice.toLocaleString() + ' đ';
            }
        }

        if (oldPrice !== undefined && oldPrice !== null && oldPrice > newPrice) {
            let oldPriceElement = document.getElementById('old-price-' + productId);
            if (oldPriceElement) {
                oldPriceElement.innerText = oldPrice.toLocaleString() + ' đ';
            }
        }
    }

    function changeVariant2(productId, imageUrl, newPrice, oldPrice) {
        let mainImage = document.getElementById('main-image-' + productId);
        if (mainImage) {
            mainImage.src = imageUrl;
        }

        if (newPrice !== undefined && newPrice !== null) {
            let currentPriceElement = document.querySelector(`#product-${productId} .current-price`);
            if (currentPriceElement) {
                const formattedNewPrice = Math.round(parseFloat(newPrice)).toLocaleString();
                currentPriceElement.innerText = `${formattedNewPrice} đ`;
            }
        }

        if (oldPrice !== undefined && oldPrice !== null && oldPrice > newPrice) {
            let oldPriceElement = document.querySelector(`#product-${productId} .old-price`);
            if (oldPriceElement) {
                const formattedOldPrice = Math.round(parseFloat(oldPrice)).toLocaleString();
                oldPriceElement.innerText = `${formattedOldPrice} đ`;
            }
        }
    }

    $(document).on('click', '.variant-image', function() {
        const productId = $(this).data('product-id');
        const variantImage = $(this).data('variant-image');
        const discountedPrice = $(this).data('discounted-price');
        const originalPrice = $(this).data('original-price');

        changeVariant2(productId, variantImage, discountedPrice, originalPrice);
    });
</script>

<?php
$this->end();
?>
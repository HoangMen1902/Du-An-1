<div class="container">
    <div class="row">
        <div class="popular-top d-flex justify-content-between align-items-center">
            <h3 class="popular-top__title border-bottom-custom">
                Phổ biến nhất
            </h3>
            <div class="popular-top__button">
                <button class="custom-btn-small">Xem thêm ></button>
            </div>
        </div>
    </div>


    <div class="row mt-4">
    <?php 
$counter = 0;
foreach ($dataProduct as $product): 
    if ($counter >= 4) break; 
?>
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="product-card">
            <img src="/public/Uploads/Products/<?= $product['thumbnail']; ?>" 
                 alt="<?= $product['product_name']; ?>" 
                 class="img-fluid">

            <h5 class="product-title"><?= $product['product_name']; ?></h5>

            <?php if (!empty($product['skus'])): ?>
                <?php 
                    $firstSku = current($product['skus']); 
                    $discountedPrice = $firstSku['discounted_price'];
                ?>
                <p class="product-price"><?= number_format($discountedPrice, 0, ',', '.'); ?>đ</p>
            <?php else: ?>
                <p class="product-price">Giá không có sẵn</p>
            <?php endif; ?>

            <button class="custom-btn add-to-cart-btn">Thêm vào giỏ</button>
        </div>
    </div>
<?php 
    $counter++; 
endforeach; 
?>


    </div>
</div>

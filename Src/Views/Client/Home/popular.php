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
    $thumbnail = explode(',',$product['thumbnail'])
?>
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="product-card ">
            <div class=" ratio ratio-1x1 " >
            <img  style="object-fit: contain; width: 100%; height: 100%; " src="/public/Uploads/Products/<?= $thumbnail[0]; ?>" 
                 alt="<?= $product['product_name']; ?>" 
                 class="img-fluid P-2">
                 </div>
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

            <a  href="detail/<?= $product['product_id'] ?>" class="custom-btn add-to-cart-btn text-decoration-none">Thêm vào giỏ</a>
        </div>
    </div>
<?php 
    $counter++; 
endforeach; 
?>


    </div>
</div>

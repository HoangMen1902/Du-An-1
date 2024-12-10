<?php $this->layout('Client/Components/Layout'); ?>


<?php
$this->start('main_content');
?>
<!-- Insert nội dung vào đây -->
<div class="cart-container">
    <div class="cart">
        <h1 class="cart__title">Giỏ hàng</h1>
        <form action="/delete-all-cart" method="post">
            <input type="hidden" name="method" value="POST">
            <button class="cart__content__fix" name="delete-cart" onclick="return confirm('Bạn chắc chứ?')">Xóa toàn bộ sản phẩm</button>
        </form>
        <h3 style="text-align: center; margin-top: 30px;">Giỏ hàng</h3>
        <p class="cart__subtitle">Bạn được giao hàng miễn phí!</p>

        <div class="cart__content">
            <div class="cart__products">
                <div class="cart__header">
                    <span class="cart__header-blank" style="font-weight: bold">Hình ảnh</span>
                    <span class="cart__header-product">Sản phẩm</span>
                    <span class="cart__header-quantity">Số lượng</span>
                    <span class="cart__header-total">Tổng</span>
                </div>
                <table class="cart__table">

                    <?php foreach ($data as $cart): ?>

                        <tr class="cart__product">
                            <td style="width: 15%;">
                                <img class="cart__product-image" src="<?= $_ENV['APP_URL'] ?>/public/Uploads/Products/<?= $cart['product_images'] ?>" alt="<?= htmlspecialchars($cart['product_sku']) ?>">
                            </td>

                            <td style="width: 55%; ">
                                <div class="cart__product-details">
                                    <h2 class="cart__product-name"><?= htmlspecialchars($cart['product_name'] . '' . $cart['product_sku']) ?></h2>
                                    <p class="cart__product-price"><?= number_format($cart['discounted_price'], 0, ',', '.') ?>₫</p>
                                    <div class="cart__product-description ">
                                        <ul class="cart__product-description-fix">
                                            <li class=" text-limit"><?= htmlspecialchars($cart['short_description']) ?>.</li>
                                        </ul>
                                    </div>
                                </div>
                            </td>

                            <td style="width: 15%;  padding-right: 15px;">
                                <form action="/update-cart" method="post" class="quantity-form">
                                    <div class="quantity-wrapper">
                                        <button type="button" class="quantity-decrease" data-id="<?= $cart['cart_id'] ?>">-</button>
                                        <input class="cart__product-quantity" type="text" name="quantity[<?= $cart['cart_id'] ?>]"
                                            value="<?= htmlspecialchars($cart['quantity']) ?>"
                                            data-id="<?= $cart['cart_id'] ?>" readonly>
                                        <button type="button" class="quantity-increase" data-id="<?= $cart['cart_id'] ?>">+</button>
                                    </div>
                                </form>


                                <form action="/delete-cart-item" method="post" class="delete-form">
                                    <input type="hidden" name="id" value="<?= htmlspecialchars($cart['cart_id']) ?>">
                                    <input type="hidden" name="method" value="POST">
                                    <button name="delete-cart-item">
                                        <svg class="cart__content__fix1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>
                                    </button>
                                </form>
                            </td>

                            <td class="price" style="width: 15%; ">
                                <p class="cart__product-total"><?= number_format($cart['total_price'], 0, ',', '.') ?>₫</p>
                            </td>
                        </tr>
                    <?php endforeach; ?>


                </table>
            </div>

            <div class="cart__summary">
                <div class="cart__summary-details">
                    <div class="cart__summary-item">
                        <span class="cart__summary-label">Tổng phụ</span>
                        <span class="cart__summary-price">0₫ </span>
                    </div>
                    <div class="cart__summary-item">
                        <?php $total = array_sum(array_column($data, 'total_price'));;
                        ?>
                        <h3 class="cart__summary-total"> <?= number_format($total, 0, ',', '.') ?>₫
                            <span class="cart__summary-amount">
                            </span>
                        </h3>
                    </div>
                    <p class="cart__summary-note">Phí ship sẽ được tính khi thanh toán</p>
                </div>
                <!-- <textarea class="cart__summary-remarks" placeholder="Ghi chú"></textarea> -->
                <a href="/checkout" class="product__info__buy__button cart__content__fix2">Thanh toán</a>
            </div>
        </div>
    </div>
</div>


<?php $this->stop() ?>

<?php
$this->push('scripts');
?>
<script>
    // $('#quantityForm').on('submit', function(e) {
    //     e.preventDefault(); 
    // });

    // $('.cart__product-quantity').on('change', function() {
    //     let cartId = $(this).data('id'); 
    //     let quantity = $(this).val(); 

    //     $.ajax({
    //         type: "POST",
    //         url: `/update-cart/${cartId}`, 
    //         data: {
    //             quantity: quantity
    //         }, 
    //         dataType: "json",
    //         success: function(response) {
    //             console.log(response); 
    //         },
    //         error: function(xhr, status, error) {
    //             console.log(error); 
    //         }
    //     });
    // });
    $(document).on('click', '.quantity-increase', function() {
        let cartId = $(this).data('id');
        let quantityInput = $(`.cart__product-quantity[data-id='${cartId}']`);
        let currentQuantity = parseInt(quantityInput.val()) || 0;
        quantityInput.val(currentQuantity + 1).trigger('change');
    });

    $(document).on('click', '.quantity-decrease', function() {
        let cartId = $(this).data('id');
        let quantityInput = $(`.cart__product-quantity[data-id='${cartId}']`);
        let currentQuantity = parseInt(quantityInput.val()) || 0;
        if (currentQuantity > 1) {
            quantityInput.val(currentQuantity - 1).trigger('change');
        }
    });

    $('.cart__product-quantity').on('change', function() {
        let cartId = $(this).data('id');
        let quantity = $(this).val();

        $.ajax({
            type: "POST",
            url: `/update-cart/${cartId}`,
            data: {
                quantity: quantity
            },
            dataType: "json",
            success: function(response) {
                console.log(response);
                location.reload();
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
        });
    });
</script>
<?php
$this->end();
?>
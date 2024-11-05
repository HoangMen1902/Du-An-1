<?php $this->layout('Client/Components/Layout'); ?>


<?php $this->start('main_content') ?>
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

                    <tr class="cart__product">
                        <td style="width: 15%;">
                            <img class="cart__product-image" src="https://www.phongcachxanh.vn/cdn/shop/files/pre-order-lot-chu-t-kinh-c-ng-l-c-tekkusai-the-beast-limited-42087967064309.jpg?v=1730188758&width=300" alt="Chuột không dây siêu nhẹ Lamzu Atlantis Mini Pro - Hỗ trợ 4KHz">
                        </td>

                        <td style="width: 55%; ">
                            <div class="cart__product-details">
                                <h2 class="cart__product-name">Lót chuột Lethal Gaming Gear Jupiter PRO </h2>
                                <p class="cart__product-price">1.240.000₫
                                </p>
                                <!-- <p class="cart__product-description clamp-text"><?= $cart['data']['description'] ?></p> -->
                                <div class="cart__product-description clamp-text">
                                    <ul class="cart__product-description-fix">
                                        <li>Thuộc phân loại Control - Slow, chậm nhất trong các dòng PRO của Lethal Gaming.</li>
                                    </ul>

                                </div>
                            </div>
                        </td>
                        <td style="width: 15%;">
                            <form action="/update-cart" method="post" class="quantity-form">
                                <input type="hidden" name="method" value="POST">
                                <input type="hidden" name="id" value="">
                                <input class="cart__product-quantity" type="text" name="quantity" value="1" onchange="this.form.submit()">
                                <input type="hidden" name="update-cart-item">
                            </form>
                            <form action="/delete-cart-item" method="post" class="delete-form">
                                <input type="hidden" name="id" value="">
                                <input type="hidden" name="method" value="POST">
                                <button name="delete-cart-item" onclick="return confirm('Bạn chắc chắn muốn xóa sản phẩm này ra khỏi giỏ hàng chứ?')">
                                    <svg class="cart__content__fix1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                </button>

                            </form>

                        </td>
                        <td class="price" style="width: 15%;">
                            <p class="cart__product-total">1.240.000₫</p>
                        </td>
                    </tr>

                </table>
            </div>
            <div class="cart__summary">
                <div class="cart__summary-details">
                    <div class="cart__summary-item">
                        <span class="cart__summary-label">Tổng phụ</span>
                        <span class="cart__summary-price">1.240.000₫ </span>
                    </div>
                    <div class="cart__summary-item">
                        <h3 class="cart__summary-total">Tổng
                            <span class="cart__summary-amount">1.240.000₫
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
$this->push('scripts')
?>


<?php
$this->end();
?>
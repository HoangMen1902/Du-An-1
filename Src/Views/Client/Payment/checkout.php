<?php $this->layout('Client/Components/Layout'); ?>

<?php $this->start('main_content') ?>
<!-- Insert nội dung vào đây -->

<section>
    <div class="payment__section">
        <div class="payment__section__left">
            <div class="payment__section__left-text">
                <div class="payment__section__left-ttlh">
                    <h3>Thông tin liên hệ</h3>
                </div>
                <form action="/order" method="post" id="paymentForm">
                    <input type="hidden" name="method" value="POST">
                    <input type="hidden" name="discountTotal" id="discountTotal" style="display: none;" disabled>

                    <div class="form-group">
                        <input type="email" class="form-control" id="exampleInputEmail1" name="email"
                            placeholder="Email" required>
                    </div>

                    <div class="payment__section__container">
                        <input class="payment__section__checkbox" type="checkbox" id="newsletter" />
                        <label for="newsletter">Gửi cho tôi tin tức và ưu đãi qua email</label>
                    </div>

                    <h3 class="payment__section__left-ttlh">Giao hàng</h3>

                    <div class="option">
                        <input type="radio" id="van_chuyen" name="shipping" value="van_chuyen" checked />
                        <label for="van_chuyen">
                            <span class="text">Vận chuyển</span>
                            <span class="icon">&#128663;</span>
                        </label>
                    </div>

                    <div class="option">
                        <input type="radio" id="nhan_tai_cua_hang" name="shipping" value="nhan_tai_cua_hang" />
                        <label for="nhan_tai_cua_hang">
                            <span class="text">Nhận hàng tại cửa hàng</span>
                            <span class="icon">&#127970;</span>
                        </label>
                    </div>

                    <div class="shipping-details">
                        <input class="cnvc" type="text" placeholder="Tên" name="name" required />
                        <input class="cnvc" type="text" placeholder="Địa chỉ" name="address" required />
                        <input class="cnvc" type="text" placeholder="Điện thoại" name="phone" required />
                        <div class="checkbox">
                            <input type="checkbox" id="save-info" />
                            <label for="save-info">Lưu lại thông tin</label>
                        </div>
                    </div>

                    <div class="shipping-methods">
                        <h3>Phương thức vận chuyển</h3>
                        <select class="cnvc" name="delivery-method">
                            <option value="grab">Khách tự book Grab (TP.HCM) - 30,000 ₫</option>
                            <option value="free-hcm" selected>Miễn phí HCM (trong ngày) - 0 ₫</option>
                            <option value="free-national">Miễn phí toàn quốc (2 ~ 7 ngày) - 20,000 ₫</option>
                        </select>
                    </div>

                    <!-- Phương thức thanh toán -->
                    <div class="payment-methods">
                        <h3>Phương thức thanh toán</h3>
                        <select class="cnvc" name="payment-method" id="paymentMethodSelect">
                            <option value="cash" selected>Tiền mặt khi nhận hàng</option>
                            <option value="international">Thanh toán quốc tế <i class="fab fa-cc-visa"></i> <i
                                    class="fab fa-cc-mastercard"></i></option>
                        </select>

                    </div>
                    <!-- Thông tin thanh toán quốc tế -->
                    <div class="international-payment" id="internationalPayment" style="display: none;">
                        <div class="form-group col-12">
                            <input type="text" id="cardNumber" class="form-control" placeholder="Số thẻ" />
                        </div>
                        <div class="row">
                            <div class="form-group col-6">
                                <input type="text" id="expiryDate" class="form-control"
                                    placeholder="Ngày hết hạn (MM/YY)" />
                            </div>
                            <div class="form-group col-6">
                                <input type="text" id="cvv" class="form-control" placeholder="Mã bảo vệ (CVV)" />
                            </div>
                        </div>
                        <div class="form-group col-12">
                            <input type="text" id="cardholderName" class="form-control" placeholder="Tên chủ thẻ" />
                        </div>
                    </div>

                    <button type="submit" class="button_thanhtoan">THANH TOÁN NGAY</button>
                </form>
            </div>
        </div>

        <div class="payment__section__right">
            <div class="payment__section__right-ttlh">
                <div class="payment__section__container">
                    <div class="payment__section__right-img" style="position: relative;">
                        <div class="payment__section__right-circle"><span>1</span></div>
                        <img src="./public/uploads/sample_image.jpg" style="object-fit:cover; width:100%; height:100%">
                    </div>
                    <div class="payment__section__right-description dlnonene">
                        <p class="clamp-text">Product Name</p>
                        <div class="cart__product-description clamp-text">
                            <ul class="cart__product-description-fix">
                                <li>Option Key:</li>
                                <li>Option Value</li>
                            </ul>
                        </div>
                    </div>
                    <div class="payment__section__right-pcire">
                        <p>Product Price</p>
                    </div>
                </div>

                <input type="hidden" name="price" value="Total Price" form="paymentForm">

                <div class="order-summary">
                    <div class="discount">
                        <select class="cnvc" name="voucher" id="voucherSelect">
                            <option value="" disabled selected>Mã giảm giá hoặc thẻ quà tặng</option>
                            <option value="voucher1">Voucher 1</option>
                            <option value="voucher2">Voucher 2</option>
                        </select>
                        <button type="button" id="voucherBtn">Áp dụng</button>
                    </div>
                    <div class="totals">
                        <p>Vận chuyển: MIỄN PHÍ</p>
                        <h3>Tổng: <span id="price">Total Price</span> ₫</h3>
                        <p>Phương thức thanh toán: Tiền mặt</p>
                    </div>
                </div>
                <div class="alert alert-danger" role="alert" style="display:none;">
                    Error message here
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const paymentMethodSelect = document.getElementById("paymentMethodSelect");
        const internationalPaymentSection = document.getElementById("internationalPayment");

        paymentMethodSelect.addEventListener("change", function () {
            if (this.value === "international") {
                internationalPaymentSection.style.display = "block";
            } else {
                internationalPaymentSection.style.display = "none";
            }
        });
    });
</script>

<script src="/public/assets/client/js/checkoutAjax.js"></script>
<script src="./public/Assets/js/provinceAPI.js"></script>

<?php $this->stop() ?>
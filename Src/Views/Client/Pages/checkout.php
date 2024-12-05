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


                <div class="form-group">
                    <label for="fullname" class="form-label">Tên đầy đủ</label>
                    <input form="paymentForm" type="text" id="fullname" name="fullname" class="form-control form-control-lg"
                        value="<?= isset($_SESSION['user']['fullname']) ? htmlspecialchars($_SESSION['user']['fullname']) : '' ?>"
                        placeholder="Ex: NguyenVanA, ....">
                    <span class="text-danger" style="display:none" id="fullname-required">* Vui lòng nhập tên</span>
                </div>

                <div class="">
                    <label for="van_chuyen">Phương thức vận chuyển</label>
                    <select id="van_chuyen" name="shipping_method" class="form-select cnvc " aria-label="Default select example" form="paymentForm">
                        <option value="none">Chọn phương thức vận chuyển</option>
                        <option class="option" value="home">Giao hàng tận nhà <span class="icon">&#128663;</span></option>
                        <option class="option" value="store">Nhận hàng tại cửa hàng<span class="icon">&#127970;</span></option>
                    </select>
                    <span class="text-danger" style="display:none" id="method_required">* Vui lòng chọn phương thức vận chuyển</span>
                </div>


                <!-- <div class="form-group">
                        <input type="email" class="form-control cnvc " id="exampleInputEmail" name="email"
                            placeholder="Email" required>
                    </div>

                    <div class="payment__section__container">
                        <input class="payment__section__checkbox" type="checkbox" id="newsletter" />
                        <label for="newsletter">Gửi cho tôi tin tức và ưu đãi qua email</label>
                    </div> -->




                <!-- thêm địa chỉ -->




                <div class="addressUser" id="addressUser" style="display:none;">

                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog width-form">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title fw-bold" id="staticBackdropLabel">THÊM ĐỊA CHỈ
                                    </h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="addressForm" method="post" action="/new-address">
                                        <input type="hidden" name="method" value="POST">
                                        <div class="form-group text-start">
                                            <label for="" class="form-label">Tỉnh/thành</label>
                                            <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="city" id="city">
                                                <option>Chọn tỉnh thành</option>

                                            </select>
                                        </div>
                                        <div class="form-group text-start">
                                            <label for="" class="form-label">Quận/Hyện</label>
                                            <select class="form-select form-select-lg mb-3" name="district" aria-label=".form-select-lg example" id="district">
                                                <option>Chọn Quận/Huyện</option>
                                            </select>
                                        </div>
                                        <div class="form-group text-start">
                                            <label for="" class="form-label">Phường/xã</label>
                                            <select class="form-select form-select-lg mb-3" id="wards" name="ward" aria-label=".form-select-lg example" id="ward">
                                                <option>Phường/xã</option>

                                            </select>
                                        </div>
                                        <div class="form-group text-start">
                                            <label for="" class="form-label">Địa chỉ chi tiết</label>
                                            <input type="text" class="form-control p-3" name="address" id="address">
                                        </div>
                                        <div class="form-group text-start">
                                            <label for="" class="form-label">Số điện thoại của địa chỉ này</label>
                                            <input type="text" class="form-control p-3" name="phone" id="phone">
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success" form="addressForm" name="submit">Lưu địa chỉ</button>
                                </div>
                            </div>
                        </div>
                    </div>



                    <h4 class="address__name d-flex gap-1  align-items-center justified-content-between">
                        <div>Địa chỉ</div>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop" style="border: none; ">
                            <a href="#" class="text-decoration-none" class="modal-dialog modal-dialog-scrollable">
                                THÊM ĐỊA CHỈ
                            </a>
                        </button>
                    </h4>
                    <?php foreach ($addressUser as $item): ?>
                        <div class="border-bottom">
                            <label class="w-100"
                                data-province_name="<?= $item['province_name'] ?>"
                                data-district_name="<?= $item['district_name'] ?>">
                                <input form="paymentForm" type="radio" class="address my-3" name="address" id="userAddress" value="<?= $item['id'] ?>">
                                <p>SĐT: <?= $item['phone'] ?></p>
                                <p><?= $item['address'] . ', ' . $item['ward_name'] . ', ' . $item['district_name'] . ', ' . $item['province_name'] ?></p>
                            </label>
                        </div>
                    <?php endforeach; ?>

                    <span class="text-danger" id="address-required" style="display: none;">* Vui lòng chọn địa chỉ cần giao</span>
                </div>


                <div class="atStore" id="atStore" style="display:none;">

                    <div>
                        <p>Nhận tại chi nhánh BeeTechNova TP Cần Thơ:</p>
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3929.4204309707616!2d105.75564711161697!3d9.9820867732995!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31a08906415c355f%3A0x416815a99ebd841e!2sFPT%20Polytechnic%20College!5e0!3m2!1sen!2s!4v1732997578750!5m2!1sen!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>

                </div>




                <!-- <div class="shipping-methods">
                        <h3>Phương thức vận chuyển</h3>
                        <select class="cnvc" name="delivery-method">
                            <option value="grab">Khách tự book Grab (TP.HCM) - 30,000 ₫</option>
                            <option value="free-hcm" selected>Miễn phí HCM (trong ngày) - 0 ₫</option>
                            <option value="free-national">Miễn phí toàn quốc (2 ~ 7 ngày) - 20,000 ₫</option>
                        </select>
                    </div> -->

                <!-- Phương thức thanh toán -->
                <div class="payment-methods">
                    <h3>Phương thức thanh toán</h3>
                    <select class="cnvc" name="payment-method" id="paymentMethodSelect" form="paymentForm">
                        <option value="cash" selected>Tiền mặt khi nhận hàng</option>
                        <option value="international">Thanh toán quốc tế <i class="fab fa-cc-visa"></i> <i
                                class="fab fa-cc-mastercard"></i></option>
                        <option value="vnpay">Thanh toán VNPay</option>
                        <option value="installment">Trả góp <i class="fab fa-cc-visa"></i> <i
                                class="fab fa-cc-mastercard"></i></option>
                    </select>

                </div>
                <div id="installment" style="display:none;">
                    <div class="card">
                        <div class="card-header btn-mainColor text-white">
                            <h5 class="mb-0">Chọn số tháng trả góp:</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex mb-3">
                                <button class="btn btn-outline-primary me-2" data-term="3">3 Tháng</button>
                                <button class="btn btn-outline-primary me-2" data-term="6">6 Tháng</button>
                                <button class="btn btn-outline-primary me-2" data-term="9">9 Tháng</button>
                                <button class="btn btn-outline-primary me-2 active" data-term="12">12 Tháng</button>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <?php
                                            $totalPrice = 0;
                                            foreach ($data as $item):
                                                $totalPrice += $item['total_price'];
                                            endforeach;
                                            ?>

                                            <th scope="row">Giá sản phẩm</th>
                                            <td id="product-price"><?= number_format($totalPrice, 0, ',', '.'); ?> ₫</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Trả trước từ</th>
                                            <td>
                                                <select class="form-select" id="down-payment-select">
                                                    <option value="50">50%</option>
                                                    <option value="30">30%</option>
                                                    <option value="20">20%</option>
                                                </select>
                                                <span class="d-block mt-2" id="down-payment-amount">0 ₫</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Lãi suất</th>
                                            <td id="interest-rate">10%</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Tổng lãi</th>
                                            <td id="total-interest">0 ₫</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Góp tháng 1</th>
                                            <td id="monthly-payment-first">0 ₫</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Tổng gốc + lãi</th>
                                            <td id="principal-interest" class="text-danger fw-bold">0 ₫</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Tổng tiền phải trả</th>
                                            <td id="actual-total-payment" class="text-danger fw-bold">0 ₫</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="mt-3 text-center">
                                <button class="btn btn-info" id="view-details">Xem chi tiết lãi</button>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="interest-details-modal" tabindex="-1" aria-labelledby="interestDetailsLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="interestDetailsLabel">Chi tiết lãi suất giảm dần</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <ul id="interest-details-list" class="list-group"></ul>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>
                <style>
                    .btn.active {
                        background-color: #007bff !important;
                        color: white !important;
                    }
                </style>

                <form class="mt-3" action="/proceed-checkout" method="POST" id="paymentForm" name="paymentForm">
                    <button type="submit" class="button_thanhtoan">THANH TOÁN NGAY</button>
                </form>


            </div>
        </div>








        <div class="payment__section__right">
            <div class="payment__section__right-ttlh">
                <?php
                $totalPrice = 0; // Tổng tiền tất cả sản phẩm
                foreach ($data as $item):
                    $totalPrice += $item['total_price'];
                ?>
                    <div class="payment__section__container">
                        <div class="payment__section__right-img" style="position: relative;">
                            <div class="payment__section__right-circle"><span><?= $item['quantity']; ?></span></div>
                            <img src="<?= $_ENV['APP_URL'] ?>/public/Uploads/Products/<?= $item['product_images']; ?>" alt="<?= $item['product_name']; ?>" style="object-fit:cover; width:100%; height:100%">
                        </div>
                        <div class="payment__section__right-description">
                            <p class="clamp-text"><?= $item['product_name']; ?></p>
                            <p class="clamp-text">SKU: <?= $item['product_sku'];  ?></p>
                            <!-- <div class="cart__product-description">
                                <ul class="cart__product-description-fix">
                                    <li>SKU: <?= $item['product_sku']; ?></li>
                                    <li>Giá: <?= number_format($item['product_price'], 0, ',', '.'); ?> ₫</li>
                                </ul>
                            </div> -->
                        </div>
                        
                        <div class="payment__section__right-pcire">
                            <p><?= number_format($item['total_price'], 0, ',', '.'); ?> ₫</p>
                        </div>
                    </div>
                <?php endforeach;
                $shippingFee = isset($shippingFee) ? $shippingFee : 0;
                $totalPriceWithShipping = $totalPrice + $shippingFee; ?>


                <div class="order-summary">
                    <div class="totals">
                        <p>Vận chuyển: <span id="shippingFee">MIỄN PHÍ</span></p>
                        <h3>Tổng: <span id="price"><?= number_format($totalPriceWithShipping, 0, ',', '.'); ?></span> </h3>
                        <input form="paymentForm" type="hidden" name="totalPrice" value="<?= $totalPriceWithShipping?>">
                        <p>Phương thức thanh toán: Tiền mặt</p>
                    </div>
                </div>
                <div class="alert alert-danger" role="alert" style="display:none;">

                </div>
            </div>
        </div>
    </div>
</section>
<script>
    const productPrice = <?= $totalPrice; ?>;
    const interestRate = 10 / 100;

    const termButtons = document.querySelectorAll('.d-flex button');
    const downPaymentSelect = document.querySelector('#down-payment-select');
    const downPaymentAmount = document.querySelector('#down-payment-amount');
    const totalInterestField = document.querySelector('#total-interest');
    const monthlyPaymentFirstField = document.querySelector('#monthly-payment-first');
    const principalInterestField = document.querySelector('#principal-interest');
    const interestDetailsList = document.querySelector('#interest-details-list');
    const viewDetailsButton = document.querySelector('#view-details');
    const actualTotalPaymentP = document.querySelector('#actual-total-payment');

    let selectedTerm = 12;
    let downPaymentRate = parseFloat(downPaymentSelect.value) / 100;

    function updateInstallment() {
        const downPayment = productPrice * downPaymentRate; // Tiền trả trước
        const remainingPrincipal = productPrice - downPayment; // Tiền nợ gốc ban đầu
        let totalInterest = 0; // Tổng tiền lãi
        let totalPayment = 0; // Tổng tiền phải trả (gốc + lãi)

        const actualTotalPaymentP = document.querySelector('#actual-total-payment');
        interestDetailsList.innerHTML = '';

        let currentPrincipal = remainingPrincipal;
        const monthlyPrincipal = remainingPrincipal / selectedTerm;

        for (let i = 1; i <= selectedTerm; i++) {
            const monthlyInterest = currentPrincipal * interestRate;
            const monthlyPayment = monthlyPrincipal + monthlyInterest;

            totalInterest += monthlyInterest;
            totalPayment += monthlyPayment;

            const listItem = document.createElement('li');
            listItem.className = 'list-group-item';
            listItem.innerHTML = `Tháng ${i}:<br> Gốc: ${monthlyPrincipal.toLocaleString()} ₫<br> Lãi: ${monthlyInterest.toLocaleString()} ₫<br> Tổng: ${monthlyPayment.toLocaleString()} ₫`;
            interestDetailsList.appendChild(listItem);

            currentPrincipal -= monthlyPrincipal;
        }

        downPaymentAmount.innerText = `${downPayment.toLocaleString()} ₫`; // Tiền trả trước
        totalInterestField.innerText = `${totalInterest.toLocaleString()} ₫`; // Tổng tiền lãi
        monthlyPaymentFirstField.innerText = `${(monthlyPrincipal + (remainingPrincipal * interestRate)).toLocaleString()} ₫`; // Góp tháng 1 
        principalInterestField.innerText = `${totalPayment.toLocaleString()} ₫`; // Tổng gốc + lãi
        actualTotalPaymentP.innerText = `${(totalPayment + downPayment).toLocaleString()} ₫`; // Tổng tiền phải trả 
    }
    termButtons.forEach(button => {
        button.addEventListener('click', () => {
            termButtons.forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');
            selectedTerm = parseInt(button.getAttribute('data-term'), 10);
            updateInstallment();
        });
    });

    downPaymentSelect.addEventListener('change', () => {
        downPaymentRate = parseFloat(downPaymentSelect.value) / 100;
        updateInstallment();
    });

    viewDetailsButton.addEventListener('click', () => {
        const modal = new bootstrap.Modal(document.getElementById('interest-details-modal'));
        modal.show();
    });

    updateInstallment();
</script>

<script>
    document.getElementById('van_chuyen').addEventListener('change', function() {
        const shippingMethod = this.value;
        const addressUser = document.getElementById('addressUser');
        const atStore = document.getElementById('atStore');

        if (shippingMethod === 'home') {
            addressUser.style.display = 'block';
        } else {
            addressUser.style.display = 'none';
        }

        if (shippingMethod === 'store') {
            atStore.style.display = 'block';
        } else {
            atStore.style.display = 'none';
        }
    });


    document.addEventListener("DOMContentLoaded", function() {
        const paymentMethodSelect = document.getElementById("paymentMethodSelect");
        const installment = document.getElementById("installment");

        paymentMethodSelect.addEventListener("change", function() {
            if (this.value === "installment") {
                installment.style.display = "block";
            } else {
                installment.style.display = "none";
            }
        });
    });


    $('#paymentForm').on('submit', (e) => {
        if ($('#van_chuyen').val() != 'home' && $('#van_chuyen').val() != 'store') {
            console.log($('#van_chuyen').val());
            e.preventDefault();
            $('#method_required').show();
        } else {
            console.log($('#van_chuyen').val());
            $('#method_required').hide();
        }

        if ($('#fullname').val() == '') {
            e.preventDefault();
            $('#fullname-required').show();
        } else {
            $('#fullname-required').hide();
        }

        if ($('#van_chuyen').val() === 'home') {
            if (!$('input[name="address"]:checked').length) {
                console.log($('input[name="address"]:checked').val());
                e.preventDefault();
                $('#address-required').show();
            } else {
                $('#address-required').hide();
            }
        }
    })
</script>

<script>
    $('.address').on('change', function() {
        var $label = $(this).closest('label');
        var provinceName = $label.data('province_name');
        var districtName = $label.data('district_name');
        var itemId = Number($(this).val());

        $.ajax({
            url: '/shipping/calculate-shipping-fee',
            method: 'POST',
            data: {
                item_id: itemId,
                province_name: provinceName,
                district_name: districtName
            },
            success: function(response) {
                console.log(response);

                var shippingFee = 0; 

                if (response.fee) {
                    shippingFee = Number(response.fee);
                    $('#shippingFee').text(shippingFee.toLocaleString() + ' ₫'); 
                } else {
                    $('#shippingFee').text('MIỄN PHÍ'); 
                }

                var totalPriceWithShipping = <?= $totalPrice ?> + shippingFee;

                $('#price').text(totalPriceWithShipping.toLocaleString() + ' ₫');
            },



        });
    });
</script>
<?php $this->stop() ?>

<?php $this->push('scripts') ?>

<script src="/public/assets/client/js/checkoutAjax.js"></script>

<script src="<?= getenv('APP_URL') ?>/public/assets/client/js/ProvinceAPI.js"></script>
<?php $this->end(); ?>
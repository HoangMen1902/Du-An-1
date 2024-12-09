<?php $this->layout('Client/Components/Layout'); ?>


<?php $this->start('main_content') ?>
<!-- Insert nội dung vào đây -->
    <div class="row mt-4 justify-content-center">
        <div class="col-xl-12 col-md-12">
            <div class="border-title-bottom-custom mb-5 text-center">
                <h2>Giới thiệu</h2>
            </div>
            <div class="contact-content">

                <h5>BeeTechNova</h5>
                <p>Xin chào quý khách
                    Chào mừng bạn đến với BeeTechnova – điểm đến hàng đầu cho các sản phẩm công nghệ và thiết bị máy tính xách tay tại Việt Nam.</p>

                <p>BeeTechnova là đơn vị tiên phong trong việc cung cấp các giải pháp công nghệ cao cấp, tập trung vào các dòng laptop hiện đại từ những thương hiệu uy tín nhất thế giới. Với sứ mệnh mang lại trải nghiệm hoàn hảo cho người dùng, chúng tôi cam kết cung cấp sản phẩm chính hãng, chất lượng cao cùng dịch vụ khách hàng tận tâm.
                </p>

                <div class="contact-image">
                    <img src="<?= $_ENV['APP_URL'] ?>/public/Assets/Client/Images/Home/bannercontact.png" alt="">
                </div>
                <h5>Mua sắm trực tuyến thực sự tiện lợi
                </h5>
                <p>Tại BeeTechnova, chúng tôi mang đến một loạt sản phẩm laptop đa dạng phù hợp với nhiều nhu cầu sử dụng: Laptop văn phòng: Nhẹ nhàng, tiện dụng cho các tác vụ hàng ngày. Laptop chơi game: Hiệu suất mạnh mẽ, trải nghiệm đỉnh cao cho các game thủ. Laptop đồ họa: Sức mạnh xử lý đồ họa chuyên nghiệp cho những người làm sáng tạo. Laptop mỏng nhẹ: Thiết kế tinh tế, dễ dàng mang theo mọi lúc mọi nơi.
                </p>

                <h5>Gương mặt đại diện </h5>

                <div class="col-12 d-flex justify-content-between images-gmdt">
                    <div class="col-3 p-4 ">
                        <img class="rounded" src="public/Uploads/dangnhuttien.jpg" alt="Ảnh Đặng Nhựt Tiến">
                        <h5 class="text-center mt-1">Đặng Nhật Tiến</h5>
                        <p class="text-center" style="font-size: 16px;">PC08464 - Web19303 </p>
                    </div>
                    <div class="col-3 p-4">
                        <img class="rounded" src="public/Uploads/duongchihao.jpg" alt="Ảnh Dương Chí Hào">
                        <h5 class="mt-1">ương Chí Hào</h5>
                        <p class="text-center text-center" style="font-size: 16px;">PC08550 - Web19303 </p>
                    </div>
                    <div class="col-3 p-4">
                        <img class="rounded" src="public\Uploads\hoangmen.png" alt="Ảnh Lý Hoàng Mến">
                        <h5 class="text-center mt-1">Lý Hoàng Mến</h5>
                        <p class="text-center" style="font-size: 16px;">PC08626 - Web19303 </p>
                    </div>
                    <div class="col-3 p-4">
                        <img class="rounded" src="public/Uploads/hoaibao2.png" alt="Ảnh Nguyễn Hoài Bão">
                        <h5 class="text-center mt-1">Nguyễn Hoài Bão</h5>
                        <p class="text-center" style="font-size: 16px;">PC08483 - Web19303 </p>
                    </div>
                </div>



                <h5>Dịch vụ và chính sách đi kèm</h5>
                <ul>
                    <li> Miễn phí giao hàng toàn quốc với mọi đơn hàng.
                    </li>
                    <li>Trả góp lãi suất 0% cho các dòng laptop cao cấp.
                    </li>
                    <li> Chính sách đổi trả dễ dàng trong vòng 7 ngày nếu có lỗi từ nhà sản xuất.
                    </li>
                    <li> Dịch vụ bảo hành tận tâm, nhanh chóng với hệ thống trung tâm bảo hành rộng khắp.
                    </li>
                </ul>

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
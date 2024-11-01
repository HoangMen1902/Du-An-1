<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BeeTechNova</title>
    <?= $this->section('styles') ?>
    <link rel="stylesheet" href="<?= $_ENV['APP_URL'] ?>/public/Assets/Client/Styles/main.css">
</head>

<body>
    <header class=" w-100 text-center">
        <h1 class="text-danger">Đây là header</h1>
    </header>
    <div>

        <?= $this->section('main_content') ?>
    </div>
    <footer>
        <footer>
            <div class="container-fluid custom-height bg-black">
                <div class="row">
                    <div class="col-xl-3 col-md-6 mt-3">
                        <img src="../../../../public/Assets/Client/Images/Home/logo_footer.png" alt="">
                        <div class="content">
                            <div class="card-text text-white mb-2">
                                Cửa hàng điện thoại di động
                            </div>
                            <div class="card-text text-white d-flex align-items-center mb-2 ms-3">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" height="15px" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                                </svg>
                                Hoàng Diệu - Đà Nẵng
                            </div>
                            <div class="card-text text-white d-flex align-items-center mb-2 ms-3">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" height="15px" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                                </svg>
                                0999 999 xxx
                            </div>
                            <div class="card-text text-white d-flex align-items-center mb-2 ms-3">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" height="15px" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                                </svg>

                                contact@webdemo.com
                            </div>
                            <div class="card-text text-white d-flex align-items-center mb-2 ms-3">
                                <svg xmlns="http://www.w3.org/2000/svg" height="15px" ; filter="invert(100%)" viewBox="0 0 512 512">
                                    <path d="M512 256C512 114.6 397.4 0 256 0S0 114.6 0 256C0 376 82.7 476.8 194.2 504.5V334.2H141.4V256h52.8V222.3c0-87.1 39.4-127.5 125-127.5c16.2 0 44.2 3.2 55.7 6.4V172c-6-.6-16.5-1-29.6-1c-42 0-58.2 15.9-58.2 57.2V256h83.6l-14.4 78.2H287V510.1C413.8 494.8 512 386.9 512 256h0z" />
                                </svg>
                                Facebook.com/xxxxxxxx
                            </div>
                        </div>

                    </div>
                    <div class="col-xl-3 col-md-6 mt-3">
                        <div class="card-title text-white mb-3">
                            CHÍNH SÁCH
                        </div>
                        <div class="card-text text-white d-flex align-items-center mb-2 ms-3">
                            Chính sách đổi trả hàng
                        </div>
                        <div class="card-text text-white d-flex align-items-center mb-2 ms-3">
                            Chính sách bảo hành
                        </div>
                        <div class="card-text text-white d-flex align-items-center mb-2 ms-3">
                            Hướng dẫn mua hàng
                        </div>
                        <div class="card-text text-white d-flex align-items-center mb-2 ms-3">
                            Chính sách đại lý
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mt-3">
                        <div class="card-title text-white mb-3">
                            DANH MỤC SẢN PHẨM
                        </div>
                        <div class="card-text text-white d-flex align-items-center mb-2 ms-3">
                            Laptop Gaming
                        </div>
                        <div class="card-text text-white d-flex align-items-center mb-2 ms-3">
                            Phụ kiện điện thoại
                        </div>
                        <div class="card-text text-white d-flex align-items-center mb-2 ms-3">
                            Máy tính & Máy tính bảng
                        </div>
                        <div class="card-text text-white d-flex align-items-center mb-2 ms-3">
                            Máy tính & Phụ kiện
                        </div>
                        <div class="card-text text-white d-flex align-items-center mb-2 ms-3">
                            Nhà thông minh
                        </div>
                        <div class="card-text text-white d-flex align-items-center mb-2 ms-3">
                            Phụ kiện
                        </div>
                        <div class="card-text text-white d-flex align-items-center mb-2 ms-3">
                            Tai nghe & Loa
                        </div>
                        <div class="card-text text-white d-flex align-items-center mb-2 ms-3">
                            TV & Màn hình
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mt-3">
                        <div class="card-title text-white mb-3">
                            <p> FANPAGE FACEBOOK</p>
                            <div class="fb-page" data-href="https://www.facebook.com/profile.php?id=61566409141457" data-tabs="timeline" data-width="200" data-height="100" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
                                <blockquote cite="https://www.facebook.com/profile.php?id=61566409141457" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/profile.php?id=61566409141457">Bee Technova</a></blockquote>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white custom-h2 d-flex align-items-center">
                <div class="col-xl-6 col-md-6 ps-3">
                    Copyright © 2023 - Web Demo
                </div>
                <div class="col-xl-6 col-md-6 text-end pe-5 ">
                    <img src="../../../../public/Assets/Client/Images/Home/Overlay.png" alt="">
                    <img src="../../../../public/Assets/Client/Images/Home/Overlay1.png" alt="">
                    <img src="../../../../public/Assets/Client/Images/Home/Overlay2.png" alt="">
                    <img src="../../../../public/Assets/Client/Images/Home/Overlay3.png" alt="">
                </div>
            </div>
        </footer>
    </footer>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v21.0&appId=588410296952063"></script>
    <?= $this->section('scripts') ?>
</body>

</html>
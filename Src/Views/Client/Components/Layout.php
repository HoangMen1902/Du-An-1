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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v21.0&appId=588410296952063"></script>
    <header class="header">
        <a href="/home"><img src="<?= $_ENV['APP_URL'] ?>/public/Assets/Client/Images/WebLogo.png" alt="logo"></a>
        <ul class="nav-menu">
            <li><a href="/home" class="text-decoration-none">Trang chủ</a></li>
            <li><a href="" class="text-decoration-none">Sản phẩm</a></li>
            <li><a href="" class="text-decoration-none">Giới thiệu</a></li>
            <li><a href="" class="text-decoration-none">Liên hệ</a></li>
        </ul>
        <div class="icon-group">
            <button class="search-btn"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.0" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg></button>
            <a href=""><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.0" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                </svg></a>

            <a href=""><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.0" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                </svg></a>

        </div>
        <div class="list-responsive">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 12h.007v.008H3.75V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm-.375 5.25h.007v.008H3.75v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
            </svg>

        </div>
    </header>

    <div class="header-space"></div>
    <div class="page-wrapper">
        <?= $this->section('main_content') ?>
    </div>
    <footer>
        <div class="container-fluid custom-height bg-black">
            <div class="row">
                <img class="logo-footer" src="<?= $_ENV['APP_URL'] ?>/public/Assets/Client/Images/Home/logo_footer.png" alt="">
            </div>
            <div class="row">
                <div class="col-xl-3 col-md-6 mt-3">
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
                <div class="col-xl-3 col-md-6 mt-3 ">
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
            <div class=" col-xl-6 col-md-6 ps-3">
                Copyright © 2023 - Web Demo
            </div>
            <div class="col-xl-6 col-md-6 text-end pe-5 ">
                <img class="icon-bank" src="<?= $_ENV['APP_URL'] ?>/public/Assets/Client/Images/Home/Overlay.png" alt="">
                <img class="icon-bank" src="<?= $_ENV['APP_URL'] ?>/public/Assets/Client/Images/Home/Overlay1.png" alt="">
                <img class="icon-bank" src="<?= $_ENV['APP_URL'] ?>/public/Assets/Client/Images/Home/Overlay2.png" alt="">
                <img class="icon-bank" src="<?= $_ENV['APP_URL'] ?>/public/Assets/Client/Images/Home/Overlay3.png" alt="">
            </div>
        </div>
    </footer>

    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasRightLabel">Trang</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body responsive-menu">
            <a href="/home" class="text-decoration-none">Trang chủ</a>
            <a href="" class="text-decoration-none">Sản phẩm</a>
            <a href="" class="text-decoration-none">Giới thiệu</a>
            <a href="" class="text-decoration-none">Liên hệ</a>
        </div>
    </div>

    <?= $this->section('scripts') ?>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Bee Technova Admin</title>
    <?= $this->section('styles') ?>

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="<?= getenv('APP_URL') ?>\node_modules\typicons.font\src\font/typicons.css">
    <!-- <link rel="stylesheet" href="<?= getenv('APP_URL') ?>/public/assets/admin/vendors/css/vendor.bundle.base.css"> -->
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="<?= getenv('APP_URL') ?>/public/Assets/Admin/Styles/style.css">
    <!-- <link rel="shortcut icon" href="<?= getenv('APP_URL') ?>/public/assets/admin/images/favicon.png" /> -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script
        src="https://code.jquery.com/jquery-3.7.1.slim.min.js"
        integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8="
        crossorigin="anonymous"></script>
</head>

<body>
    <div class="container-scroller">
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="navbar-brand-wrapper d-flex justify-content-center">
                <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">
                    <!-- <a class="navbar-brand brand-logo" href="/admin/dashboard"><img src="<?= getenv('APP_URL') ?>public/assets/admin/images/beelogo.png" -->
                    <a class="navbar-brand brand-logo" href="/admin/dashboard"><img
                            src="" alt="logo" /></a>
                    <a class="navbar-brand brand-logo-mini" href="/admin/dashboard"
                        style="color: #fff; text-decoration: none;">Bee</a>
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button"
                        data-toggle="minimize">
                        <span class="typcn typcn-th-menu"></span>
                    </button>
                </div>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">

                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item dropdown">
                        <a class="nav-link count-indicator dropdown-toggle d-flex justify-content-center align-items-center"
                            id="messageDropdown" href="#" data-toggle="dropdown">
                            <i class="typcn typcn-cog-outline mx-0"></i>
                            <span class="count"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                            aria-labelledby="messageDropdown">

                        </div>
                    </li>
                    <li class="nav-item dropdown mr-0">
                        <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center"
                            id="notificationDropdown" href="#" data-toggle="dropdown">
                            <i class="typcn typcn-bell mx-0"></i>
                            <span class="count"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                            aria-labelledby="notificationDropdown">
                            <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-success">
                                        <i class="typcn typcn-info mx-0"></i>
                                    </div>
                                </div>
                                <div class="preview-item-content">
                                    <h6 class="preview-subject font-weight-normal">Application Error</h6>
                                    <p class="font-weight-light small-text mb-0 text-muted">
                                        Just now
                                    </p>
                                </div>
                            </a>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-warning">
                                        <i class="typcn typcn-cog-outline mx-0"></i>
                                    </div>
                                </div>
                                <div class="preview-item-content">
                                    <h6 class="preview-subject font-weight-normal">Settings</h6>
                                    <p class="font-weight-light small-text mb-0 text-muted">
                                        Private message
                                    </p>
                                </div>
                            </a>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-info">
                                        <i class="typcn typcn-user mx-0"></i>
                                    </div>
                                </div>
                                <div class="preview-item-content">
                                    <h6 class="preview-subject font-weight-normal">New user registration</h6>
                                    <p class="font-weight-light small-text mb-0 text-muted">
                                        2 days ago
                                    </p>
                                </div>
                            </a>
                        </div>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-toggle="offcanvas">
                    <span class="typcn typcn-th-menu"></span>
                </button>
            </div>
        </nav>
        <div class="container-fluid page-body-wrapper">

            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/dashboard">
                            <i class="typcn typcn-device-desktop menu-icon"></i>
                            <span class="menu-title">Dashboard</span>
                            <div class="badge badge-danger">new</div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="" data-bs-toggle="collapse" data-bs-target="#userSubmenu">
                            <i class="typcn typcn-business-card menu-icon"></i>
                            <span class="menu-title">Người dùng</span>
                        </a>
                        <div id="userSubmenu" class="collapse submenu">
                            <a class="nav-link" href="/admin/users">Danh sách người dùng</a>
                            <a class="nav-link" href="/admin/create-user">Thêm người dùng</a>
                        </div>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#productsSubmenu">
                            <i class="typcn typcn-archive menu-icon"></i>
                            <span class="menu-title">Sản phẩm</span>
                        </a>
                        <div id="productsSubmenu" class="collapse submenu">
                            <a class="nav-link" href="/admin/products">Danh sách sản phẩm</a>
                            <a class="nav-link" href="/admin/product/add">Thêm sản phẩm</a>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#attributeSubmenu">
                            <i class="typcn typcn-archive menu-icon"></i>
                            <span class="menu-title">Thuộc Tính Sản phẩm</span>
                        </a>
                        <div id="attributeSubmenu" class="collapse submenu">
                            <a class="nav-link" href="/admin/allattribute">Danh sách thuộc tính sản phẩm</a>
                            <a class="nav-link" href="/admin/attribute">Thêm thuộc tính</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#categoriesSubmenu">
                            <i class="typcn typcn-th-small menu-icon"></i>
                            <span class="menu-title">Phân loại sản phẩm</span>
                        </a>
                        <div id="categoriesSubmenu" class="collapse submenu">
                            <a class="nav-link" href="/admin/categories">Danh sách loại sản phẩm</a>
                            <a class="nav-link" href="/admin/category/add">Thêm loại sản phẩm</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#brandsSubmenu">
                            <i class="typcn typcn-tags menu-icon"></i>
                            <span class="menu-title">Thương hiệu</span>
                        </a>
                        <div id="brandsSubmenu" class="collapse submenu">
                            <a class="nav-link" href="/admin/brands">Danh sách thương hiệu</a>
                            <a class="nav-link" href="/admin/brand/add">Thêm thương hiệu</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#vouchersSubmenu">
                            <i class="typcn typcn-ticket menu-icon"></i>
                            <span class="menu-title">Mã giảm giá</span>
                        </a>
                        <div id="vouchersSubmenu" class="collapse submenu">
                            <a class="nav-link" href="/admin/vouchers">Danh sách mã giảm giá</a>
                            <a class="nav-link" href="/admin/create-voucher">Thêm mã giảm giá</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#commentsSubmenu">
                            <svg class="typcn typcn-ticket menu-icon" xmlns="http://www.w3.org/2000/svg" height="20px"
                                viewBox="0 -960 960 960" width="20px" fill="#788791">
                                <path
                                    d="M240-400h480v-80H240v80Zm0-120h480v-80H240v80Zm0-120h480v-80H240v80ZM880-80 720-240H160q-33 0-56.5-23.5T80-320v-480q0-33 23.5-56.5T160-880h640q33 0 56.5 23.5T880-800v720ZM160-320h594l46 45v-525H160v480Zm0 0v-480 480Z" />
                            </svg>
                            <span class="menu-title">Bình luận</span>
                        </a>
                        <div id="commentsSubmenu" class="collapse submenu">
                            <a class="nav-link" href="/admin/comments">Danh sách Bình luận</a>
                            <a class="nav-link" href="#">Thêm Bình luận</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#ordersSubmenu">
                            <i class="typcn typcn-clipboard menu-icon"></i>
                            <span class="menu-title">Đơn hàng</span>
                        </a>
                        <div id="ordersSubmenu" class="collapse submenu">
                            <a class="nav-link" href="/admin/orders">Danh sách đơn hàng</a>
                        </div>
                    </li>

                </ul>
            </nav>

            <div class="main-panel">
                <div class="content-wrapper">

                    <?= $this->section('main_content') ?>

                </div>
                <footer class="footer">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-sm-flex justify-content-center justify-content-sm-between">
                                <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright ©
                                    2024 <a href="#" class="text-muted" target="_blank">Bee Technova</a>.
                                    All rights reserved.</span>
                                <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center text-muted">Bee
                                    <a href="#" class="text-muted" target="_blank">Technova
                                        Admin</a></span>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </div>
    <?= $this->section('scripts') ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <!-- <script src="<?= getenv('APP_URL') ?>/public/assets/admin/vendors/js/vendor.bundle.base.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="<?= getenv('APP_URL') ?>/node_modules/chart.js/dist/Chart.min.js"></script>
    <script src="<?= getenv('APP_URL') ?>/public/Assets/Admin/js/off-canvas.js"></script>
    <script src="<?= getenv('APP_URL') ?>/public/Assets/Admin/js/hoverable-collapse.js"></script>
    <script src="<?= getenv('APP_URL') ?>/public/Assets/Admin/js/template.js"></script>
    <script src="<?= getenv('APP_URL') ?>/public/Assets/Admin/js/settings.js"></script>
    <script src="<?= getenv('APP_URL') ?>/public/Assets/Admin/js/todolist.js"></script>
    <script src="<?= getenv('APP_URL') ?>/public/Assets/Admin/js/dashboard.js"></script>
    <script src="<?= getenv('APP_URL') ?>/public/Assets/Admin/js/variations.js"></script>

</body>

</html>
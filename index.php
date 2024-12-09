<?php

use App\Views\Admin\Pages\Products\ProductsList;
use FastRoute\RouteCollector;
use League\Plates\Extension\URI;
use Src\Controllers\Client\HomeController;
use Src\Controllers\Client\ContactController;
use Src\Controllers\Client\AuthController;
use Src\Controllers\Client\AboutController;
use Src\Controllers\Client\CartController;
use Src\Controllers\Client\OrderController;
use Src\Controllers\Client\ProductController;
use Src\Controllers\Client\CheckoutController;
use Src\Controllers\Admin\DashboardController;
use Src\Controllers\Client\ProductListController;
use Src\Controllers\Client\SearchController;
use Src\Controllers\Client\UserInfoController;
use Src\Helpers\Client\ProvinceHelper;
use Src\Controllers\Client\CommentController as ClientComment;
use Src\Controllers\Client\RatingController;
use Src\Controllers\Client\ShippingController;


use Src\Controllers\Admin\RatingController as AdminRating;
use Src\Controllers\Admin\VouchersController;
use Src\Controllers\Admin\UserController;
use Src\Controllers\Admin\ProductsController;
use Src\Controllers\Admin\OrdersController;
use Src\Controllers\Admin\BrandController;
use Src\Controllers\Admin\CommentController;
use Src\Controllers\Admin\CategoryController;
use Src\Controllers\Admin\AttributeController;
use Src\Controllers\Admin\InstallmentsController;



require_once 'vendor/autoload.php';

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
ini_set('log_errors', TRUE);
ini_set('error_log', './logs/php-errors.log');
session_start();


$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

Src\Helpers\Client\AuthHelper::middleware();

//Router

$dispatcher = FastRoute\simpleDispatcher(function (RouteCollector $r) {
    $r->addRoute('GET', '/home', [HomeController::class, 'show']);
    $r->addRoute('GET', '/detail/{id}', [ProductController::class, 'show']);
    $r->addRoute('GET', '/list', [ProductListController::class, 'show']);
    $r->addRoute('GET', '/checkout', [CheckoutController::class, 'show']);
    $r->addRoute('POST', '/orders', [OrderController::class, 'show']);
    $r->addRoute('GET', '/about', [AboutController::class, 'show']);
    $r->addRoute('GET', '/', [HomeController::class, 'show']);
    $r->addRoute('GET', '/Contact', [ContactController::class, 'show']);

    $r->addRoute('GET', '/login', [AuthController::class, 'login']);
    $r->addRoute('GET', '/cart', [CartController::class, 'show']);
    $r->get('/thanks', [HomeController::class, 'showThanks']);

    $r->addRoute('GET', '/login-google', [AuthController::class, 'loginGoogle']);
    $r->addRoute('GET', '/logged-google', [AuthController::class, 'loginGoogleAction']);
    $r->addRoute('GET', '/login-facebook', [AuthController::class, 'redirectToFacebook']);
    $r->addRoute('GET', '/logged-facebook', [AuthController::class, 'handleFacebookCallback']);
    $r->addRoute('GET', '/logout', [AuthController::class, 'logoutUser']);
    $r->get('/forgot-password', [AuthController::class, 'forgotPassword']);
    $r->addRoute('POST', '/update-information', [AuthController::class, 'updateUserInfoAction']);
    $r->addRoute('POST', '/change-user-password', [AuthController::class, 'updatePasswordAction']);
    $r->addRoute('POST', '/new-address', [ProvinceHelper::class, 'createAddress']);
    $r->addRoute('POST', '/get-child-categories', [ProductListController::class, 'selectResult']);
    $r->addRoute('GET', '/filter-products', [ProductListController::class, 'filterResult']);
    $r->addRoute('POST', '/shipping/calculate-shipping-fee', [ShippingController::class, 'getGHTKFee']);









    $r->addRoute('POST', '/add-to-cart', [CartController::class, 'store']);
    $r->addRoute('POST', '/comment', [ClientComment::class, 'store']);
    $r->addRoute('POST', '/reply', [ClientComment::class, 'reply']);
    $r->addRoute('POST', '/edit', [ClientComment::class, 'update']);
    $r->addRoute('POST', '/deleteComment', [ClientComment::class, 'delete']);
    $r->addRoute('POST', '/editReply', [ClientComment::class, 'updateReply']);
    $r->addRoute('POST', '/preview', [RatingController::class, 'store']);
    $r->addRoute('POST', '/edit-preview', [RatingController::class, 'update']);
    $r->addRoute('POST', '/deleteRating', [RatingController::class, 'delete']);
    $r->addRoute('POST', '/cancelOrder/{id}', [UserInfoController::class, 'cancelOrder']);

    $r->addRoute('GET', '/register', [AuthController::class, 'register']);
    $r->get('/reset-password', [AuthController::class, 'loadResetPage']);
    $r->get('/international-cancel', [CheckoutController::class, 'visaCancel']);
    $r->get('/international-success/{session_id}/{address_id}', [CheckoutController::class, 'visaSuccess']);
    $r->get('/vnpay-response', [CheckoutController::class, 'response']);

    $r->post('/reset-password/{token}', [AuthController::class, 'resetPassword']);
    $r->post('/send-mail', [AuthController::class, 'forgotPasswordSubmit']);
    $r->post('/register-action', [AuthController::class, 'store']);
    $r->post('/delete-cart-item',[CartController::class, 'deleteOneCart']);
    $r->post('/update-cart/{id}', [CartController::class, 'updateCart']);

    $r->addGroup('/profile', function (FastRoute\RouteCollector $r) {
        $r->get('', [UserInfoController::class, 'myAccount']);
        $r->get('/change-password', [UserInfoController::class, 'changePassword']);
        $r->get('/address', [ProvinceHelper::class, 'showAllAddress']);
        $r->post('/delete-address/{id}', [ProvinceHelper::class, 'deleteAddress']);
        $r->get('/orders-list', [UserInfoController::class, 'userOrders']);
    });

    $r->post('/proceed-checkout', [CheckoutController::class, 'checkOut']);


    $r->addRoute('GET', '/searchResult', [SearchController::class, 'show']);
    $r->addRoute('GET', '/search', [SearchController::class, 'search']);

    $r->post('/delete-all-cart', [CartController::class, 'deleteAllCart']);
    $r->post('/user-login', [AuthController::class, 'authLogin']);


    $r->addGroup('/admin', function (FastRoute\RouteCollector $r) {
        $r->get('/product/detail/description/{id}', [ProductController::class, 'loadDescription']);
        $r->get('/delete-sku/{sku_id}/{product_id}', [ProductsController::class, 'deleteSku']);
        $r->get('/edit-variant/{product_id}/{sku_id}', [ProductsController::class, 'variantEdit']);
        $r->get('/edit-specification/{id}', [ProductsController::class, 'specificationEdit']);
        $r->get('/admin', [DashboardController::class, 'show']);
        $r->get('/admin/dashboard', [DashboardController::class, 'show']);
        $r->get('', [DashboardController::class, 'show']);
        $r->get('/dashboard', [DashboardController::class, 'show']);
        $r->get('/vouchers', [VouchersController::class, 'show']);
        $r->get('/users', [UserController::class, 'show']);
        $r->get('/create-user', [UserController::class, 'add']);
        $r->get('/products', [productsController::class, 'index']);
        $r->get('/product/add', [productsController::class, 'add']);
        $r->get('/product/detail/{id}', [productsController::class, 'show']);
        $r->get('/edit-product/{id}', [productsController::class, 'edit']);
        $r->get('/allAttribute', [AttributeController::class, 'show']);
        $r->get('/attribute', [AttributeController::class, 'add']);
        $r->get('/attribute-edit/{id}', [AttributeController::class, 'edit']);
        $r->get('/categories', [CategoryController::class, 'show']);
        $r->get('/category/CategoryValueList/{id}', [CategoryController::class, 'showSub']);
        $r->get('/category/CategoryValueAdd/{id}', [CategoryController::class, 'addSub']);
        $r->get('/category/add', [CategoryController::class, 'add']);
        $r->get('/category/edit/{id}', [CategoryController::class, 'edit']);
        $r->post('/category/update/{id}', [CategoryController::class, 'update']);
        $r->get('/category/delete/{id}', [CategoryController::class, 'delete']);
        $r->post('/category/store', [CategoryController::class, 'store']);
        $r->post('/category/storeSub', [CategoryController::class, 'storeSub']);
        $r->get('/category/value/edit/{id}', [CategoryController::class, 'editSub']);
        $r->post('/category/value/update/{id}', [CategoryController::class, 'updateSub']);
        $r->post('/category/value/delete/{id}', [CategoryController::class, 'deleteSub']);
        $r->get('/brands', [BrandController::class, 'show']);
        $r->get('/brand/add', [BrandController::class, 'add']);
        $r->get('/comments', [CommentController::class, 'show']);
        $r->get('/ratings', [AdminRating::class, 'show']);
        $r->get('/user-order/{user_id}/{order_id}', [UserController::class, 'showUserOrderDetails']);

        $r->get('/orders', [OrdersController::class, 'show']);
        $r->get('/order-detail/{id}', [OrdersController::class, 'detail']);

        $r->get('/tragop', [InstallmentsController::class, 'show']);
        $r->get('/tragop/add', [InstallmentsController::class, 'add']);
        $r->get('/tragop/detail', [InstallmentsController::class, 'detail']);
        $r->post('/tragop/store', [InstallmentsController::class, 'store']);
        $r->get('/edit-user/{id:\d+}', [UserController::class, 'edit']);
        $r->get('/locked-account', [UserController::class, 'locked']);
        $r->get('/delete-product/{id}', [productsController::class, 'delete']);
        $r->get('/delete-attribute/{id}', [AttributeController::class, 'delete']);
        $r->get('/delete-comment/{id}', [CommentController::class, 'delete']);
        $r->get('/delete-rating/{id}', [AdminRating::class, 'delete']);
        $r->get('/edit-brand/{id:\d+}', [BrandController::class, 'edit']);

        $r->post('/edit-specs/{id}', [ProductsController::class, 'updateSpecs']);
        $r->post('/add-user', [UserController::class, 'store']);
        $r->post('/user-search', [UserController::class, 'search']);
        $r->post('/product/update/{id}', [ProductsController::class, 'update']);
        $r->post('/product/store', [ProductsController::class, 'store']);
        $r->post('/edit-user/{id:\d+}', [UserController::class, 'update']);
        $r->post('/lock-user/{id:\d+}', [UserController::class, 'lockUser']);
        $r->post('/add-brand', [BrandController::class, 'store']);
        $r->post('/attribute-add', [AttributeController::class, 'store']);
        $r->post('/attribute-update/{id}', [AttributeController::class, 'update']);
        $r->post('/update-brand/{id:\d+}', [BrandController::class, 'update']);
        $r->post('/get-child-categories', [ProductsController::class, 'selectResult']);
        $r->post('/variant/edit/{product_id}/{sku_id}', [ProductsController::class, 'updateVariant']);
        $r->post('/user/get-order/{id}', [UserController::class, 'showOrders']);


        $r->delete('/variant/delete/{sku_value}/{option_value}', [ProductsController::class, 'deleteProperty']);
        $r->delete('/delete-brand/{id:\d+}', [BrandController::class, 'delete']);


        $r->delete('/delete-user/{id:\d+}', [UserController::class, 'delete']);
    });
});

















$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];


if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        echo 'Not Found';
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        echo 'Forbidden Method';
        // ... 405 Method Not Allowed
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        $method = $handler[1];
        // ... call $handler with $vars

        $controller = new $handler[0];
        $controller->$method($vars);
        break;
}

<?php

use App\Views\Admin\Pages\Products\ProductsList;
use FastRoute\RouteCollector;
use League\Plates\Extension\URI;
use Src\Controllers\Client\HomeController;
use Src\Controllers\Client\ContactController;
use Src\Controllers\Client\AuthController;
use Src\Controllers\Client\CartController;
use Src\Controllers\Client\ProductController;
use Src\Controllers\Client\CheckoutController;
use Src\Controllers\Admin\DashboardController;
use Src\Controllers\Client\ProductListController;
use Src\Controllers\Client\SearchController;
use Src\Controllers\Client\UserInfoController;

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




$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();




//Router

$dispatcher = FastRoute\simpleDispatcher(function(RouteCollector $r) {
    $r->addRoute('GET', '/home', [HomeController::class, 'show']);
    $r->addRoute('GET', '/detail', [ProductController::class, 'show']);
    $r->addRoute('GET', '/list', [ProductListController::class, 'show']);
    $r->addRoute('GET', '/checkout', [CheckoutController::class, 'show']);
    $r->addRoute('GET', '/', [HomeController::class, 'show']);
    $r->addRoute('GET', '/Contact', [ContactController::class, 'show']);

    $r->addRoute('GET', '/login', [AuthController::class, 'login']);
    $r->addRoute('GET', '/cart', [CartController::class, 'show']);
    $r->addRoute('GET', '/register', [AuthController::class, 'register']);

    $r->addGroup('/profile', function (FastRoute\RouteCollector $r) {
        $r->get('', [UserInfoController::class, 'myAccount']);
        $r->get('/change-password', [UserInfoController::class, 'changePassword']);
        $r->get('/address', [UserInfoController::class, 'address']);
        $r->get('/orders-list', [UserInfoController::class, 'userOrders']);
    });

    $r->addRoute('GET', '/search', [SearchController::class, 'show']);

    $r->addGroup('/admin', function (FastRoute\RouteCollector $r) {
        $r->get('/admin', [DashboardController::class, 'show']);
        $r->get('/admin/dashboard', [DashboardController::class, 'show']);
        $r->get('', [DashboardController::class, 'show']);
        $r->get('/dashboard', [DashboardController::class, 'show']);
        $r->get('/vouchers', [VouchersController::class, 'show']);
        $r->get('/users', [UserController::class, 'show']);
        $r->get('/create-user', [UserController::class, 'add']);
        $r->get('/products', [productsController::class, 'show']);
        $r->get('/product/add', [productsController::class, 'add']);
        $r->get('/allattribute', [UserController::class, 'show']);
        $r->get('/attribute', [AttributeController::class, 'add']);
        $r->get('/categories', [CategoryController::class, 'show']);
        $r->get('/category/add', [CategoryController::class, 'add']);
        $r->get('/brands', [BrandController::class, 'show']);
        $r->get('/brand/add', [BrandController::class, 'add']);
        $r->get('/comments', [CommentController::class, 'show']);
        $r->get('/orders', [OrdersController::class, 'show']);
        $r->get('/tragop', [InstallmentsController::class, 'show']);
        $r->get('/tragop/add', [InstallmentsController::class, 'add']);
        $r->get('/tragop/detail', [InstallmentsController::class, 'detail']);


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
        // ... 404 Not Found
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

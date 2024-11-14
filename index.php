<?php

use App\Views\Admin\Pages\Products\ProductsList;
use FastRoute\RouteCollector;
use League\Plates\Extension\URI;
use Src\Controllers\Client\HomeController;
use Src\Controllers\Client\ContactController;
use Src\Controllers\Client\AuthController;
use Src\Controllers\Client\AboutController;
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
session_start();



$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();




//Router

$dispatcher = FastRoute\simpleDispatcher(function (RouteCollector $r) {
    $r->addRoute('GET', '/home', [HomeController::class, 'show']);
    $r->addRoute('GET', '/detail', [ProductController::class, 'show']);
    $r->addRoute('GET', '/list', [ProductListController::class, 'show']);
    $r->addRoute('GET', '/checkout', [CheckoutController::class, 'show']);
    $r->addRoute('GET', '/about', [AboutController::class, 'show']);
    $r->addRoute('GET', '/', [HomeController::class, 'show']);
    $r->addRoute('GET', '/Contact', [ContactController::class, 'show']);

    $r->addRoute('GET', '/login', [AuthController::class, 'login']);
    $r->addRoute('GET', '/cart', [CartController::class, 'show']);
    $r->addRoute('GET', '/register', [AuthController::class, 'register']);
    $r->post('/register-action', [AuthController::class, 'store']);

    $r->addGroup('/profile', function (FastRoute\RouteCollector $r) {
        $r->get('', [UserInfoController::class, 'myAccount']);
        $r->get('/change-password', [UserInfoController::class, 'changePassword']);
        $r->get('/address', [UserInfoController::class, 'address']);
        $r->get('/orders-list', [UserInfoController::class, 'userOrders']);
    });
 

    $r->addRoute('GET', '/searchResult', [SearchController::class, 'show']);
    $r->addRoute('GET', '/search', [SearchController::class, 'search']);

    $r->post('/user-login', [AuthController::class, 'authLogin']);


    $r->addGroup('/admin', function (FastRoute\RouteCollector $r) {
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
        $r->get('/product/edit/{id}', [productsController::class, 'edit']);
        $r->get('/allAttribute', [AttributeController::class, 'show']);
        $r->get('/attribute', [AttributeController::class, 'add']);
        $r->get('/attribute-edit/{id}', [AttributeController::class, 'edit']);
        $r->get('/categories', [CategoryController::class, 'show']);
        $r->get('/category/CategoryValueList/{id}', [CategoryController::class, 'showSub']);
        $r->get('/category/CategoryValueAdd', [CategoryController::class, 'addSub']);
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
        $r->get('/orders', [OrdersController::class, 'show']);
        $r->get('/tragop', [InstallmentsController::class, 'show']);
        $r->get('/tragop/add', [InstallmentsController::class, 'add']);
        $r->get('/tragop/detail', [InstallmentsController::class, 'detail']);
        $r->get('/edit-user/{id:\d+}', [UserController::class, 'edit']);
        $r->get('/locked-account', [UserController::class, 'locked']);
        $r->get('/delete-product/{id}', [productsController::class, 'delete']);
        $r->get('/delete-attribute/{id}', [AttributeController::class, 'delete']);
        $r->get('/edit-brand/{id:\d+}', [BrandController::class, 'edit']);

        $r->post('/add-user', [UserController::class, 'store']);
        $r->post('/user-search', [UserController::class, 'search']);
        $r->post('/product/update/{id}', [productsController::class, 'update']);
        $r->post('/product/store', [ProductsController::class, 'store']);
        $r->post('/edit-user/{id:\d+}', [UserController::class, 'update']);
        $r->post('/lock-user/{id:\d+}', [UserController::class, 'lockUser']);
        $r->post('/add-brand', [BrandController::class, 'store']);
        $r->post('/attribute-add', [AttributeController::class, 'store']);
        $r->post('/attribute-update/{id}', [AttributeController::class, 'update']);
        $r->post('/update-brand/{id:\d+}', [BrandController::class, 'update']);
        $r->post('/get-child-categories', [ProductsController::class, 'selectResult']);


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
        var_dump($_SERVER['REQUEST_METHOD']);
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

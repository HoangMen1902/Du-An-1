<?php

namespace Src\Controllers\Client;

use Exception;
use Src\Controllers\BaseController;
use Src\Models\Database;
use Src\Notifications\Notification;
use Src\Models\Client\CartModel;
use Src\Models\Client\CheckoutModel;
use Src\Models\Client\UserModel;
use Src\Models\Client\AddressModel;
use Src\Models\Client\OrderDetailsModel;
use Src\Models\Client\OrderModel;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class CheckoutController extends BaseController
{



    public function show()
    {
        $user_id  = $_SESSION['user']['id'];
        $CartModel = new CartModel();
        $data = $CartModel->getCartByUser($user_id);

        // echo '<pre>';
        // $userModel = new UserModel();
        // $dataUser = $userModel->showAll();

        $id = $_SESSION['user']['id'];
        $addressModel = new AddressModel();
        $addressUser = $addressModel->getUserAddress($id);


        echo $this->view->render('Client/Pages/Checkout', [
            'data' => $data,
            // 'dataUser' => $dataUser,
            'addressUser' => $addressUser,
        ]);
    }


    public function checkOut()
    {
        echo "<pre>";
        if (!isset($_POST['payment-method'])) {
            Notification::error('Checkout thất bại', 'Không thể checkout');
            header('location: /checkout');
            exit();
        }

        $method = $_POST['payment-method'];

        $CartModel = new CartModel();

        if ($method === 'international') {
            try {
                $UserCart = $CartModel->getCartByUser($_SESSION['user']['id']);
                $lineItems = array_map(function ($products) {
                    $price = explode('.', $products['total_price'])[0];
                    return [
                        'price_data' => [
                            'currency' => 'VND',
                            'product_data' => [
                                'name' => $products['product_name'],
                                'description' => $products['product_sku'],
                            ],
                            'unit_amount' => $price,
                        ],
                        'quantity' => $products['quantity']
                    ];
                }, $UserCart);
                $additionalData['address'] = $_POST['address'];
                $this->createCheckoutSession($lineItems, $additionalData);
            } catch (Exception $e) {
                error_log('Lỗi khi thanh toán bằng visa' . $e->getMessage());
                exit();
            }
        }
    }

    public function createCheckoutSession($lineItems, $additionalData)
    {
        try {
            header('Content-Type: application/json');
            $address = $additionalData['address'];
            Stripe::setApiKey($_ENV['STRIPE_API']);
            $checkout_session = \Stripe\Checkout\Session::create([
                'line_items' => $lineItems,
                'mode' => 'payment',
                'success_url' => $_ENV['APP_URL'] . "/international-success/{CHECKOUT_SESSION_ID}/$address",
                'cancel_url' => $_ENV['APP_URL'] . '/international-cancel',
            ]);
            header("HTTP/1.1 303 See Other");
            header("Location: " . $checkout_session->url);
        } catch (Exception $e) {
            error_log('Đã xảy ra lỗi khi thanh toán bằng Visa: ' . $e->getMessage());
            Notification::error('Đã xảy ra lỗi', 'Hiện đang gặp trục trặc với phương thức này');
            header('location: /checkout');
            exit();
        }
    }

    public function visaSuccess($params) {
            try {
                Stripe::setApiKey($_ENV['STRIPE_API']);

                $id = $params['session_id'];
                $address_id = $params['address_id'];
                
    
                $data = Session::retrieve($id);
    
                $total = $data->amount_total;
                $user_id = $_SESSION['user']['id'];

                $database = new Database();
                $conn = $database->MySQLi();
                $conn->begin_transaction();

                $insertOrder = [
                    'user_id' => $user_id,
                    'address_id' => $address_id,
                    'total_price' => $total,
                    'status' => 3
                ];

                $OrderModel = new OrderModel;
                $OrderDetailModel = new OrderDetailsModel;
                $CartModel = new CartModel();

                $result = $OrderModel->createOrderReturnId($insertOrder);
                $CartQuery = $CartModel->getCartByUser($user_id);

                if($result === false) {
                    Notification::error('Đặt hàng thất bại', 'Đã xảy ra lỗi trong quá trình đặt hàng');
                    $conn->rollback();
                    header('location: /cart');
                    exit();
                }

                $orderDetailInsert = [];

                foreach($CartQuery as $cartItem) {
                    $price = explode('.', $cartItem['total_price'])[0];
                    $orderDetailInsert[] = [
                        'order_id' => $result,
                        'sku_id' => $cartItem['sku_id'],
                        'price' => $price,
                        'quantity' => $cartItem['quantity']
                    ];
                }

                $lastResult = [];

                foreach($orderDetailInsert as $index => $dataInsert) {
                    $lastResult[] = $OrderDetailModel->createDetail($dataInsert);
                    if($lastResult[$index] === false) {
                        Notification::error('Tạo đơn hàng thất bại', 'Tạo đơn hàng thất bại, vui lòng báo cáo với quản trị viên');
                        header('location: /checkout');
                        $conn->rollback();
                        exit();
                    }
                }
                $conn->commit();
                Notification::success('Đã đặt hàng', 'Bạn đã đặt hàng thành công');
                $CartModel->deleteAllCarts($user_id);
                header('location: /cart');
                exit();
            } catch(Exception $e) {
                Notification::error('Không thể truy cập', 'Bạn không thể truy cập trang này');
                header('location: /home');
                exit();
            }
    }

    public function visaCancel() {
        header('location: /checkout');
    }
}

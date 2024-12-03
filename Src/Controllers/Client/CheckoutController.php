<?php

namespace Src\Controllers\Client;

use Exception;
use Google\Service\Adsense\Header;
use Google_Service_VMMigrationService_DiskImageDefaults;
use Src\Controllers\BaseController;
use Src\Helpers\Client\VNPayHelper;
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
        $id = $_SESSION['user']['id'];
        $addressModel = new AddressModel();
        $addressUser = $addressModel->getUserAddress($id);


        echo $this->view->render('Client/Pages/Checkout', [
            'data' => $data,
            'addressUser' => $addressUser,
        ]);
    }


    public function checkOut()
    {
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

        if ($method === 'vnpay') {
            $VNPayHelper = new VNPayHelper();
            $CartModel = new CartModel();
            $OrderModel = new OrderModel();
            $OrderDetailsModel = new OrderDetailsModel();

            $database = new Database();
            $conn = $database->MySQLi();
            $conn->begin_transaction();

            $totalCost = 0;

            $userId = $_SESSION['user']['id'];

            if($_POST['shipping_method'] === 'store') {
                $addressId = NULL;
            } else {
                $addressId = $_POST['address'];
            }
            error_log($addressId);

            $UserCart = $CartModel->getCartByUser($_SESSION['user']['id']);
            if ($UserCart !== false) {


                foreach ($UserCart as $index => $item) {
                    $price = explode('.', $item['total_price'])[0];
                    $totalCost += $price;
                }

                $data = [
                    'status' => 2, // Ban đàu là chưa thanh toán, 2 là trạng thái chờ thanh toán (noted)
                    'total_price' => $totalCost,
                    'user_id' => $userId,
                    'address_id' => $addressId
                ];


                $OrderInsertedId = $OrderModel->createOrderReturnId($data);

                if ($OrderInsertedId === false) {
                    Notification::error('Đã có lỗi xảy ra', 'Có lỗi xảy ra trong quá trình thanh toán, vui lòng thử lại sau. Mã lỗi: 1');
                    $conn->rollback();
                    header('location: /cart');
                    exit();
                }

                $orderDetailData = [];
                foreach ($UserCart as $item) {
                    $price = explode('.', $item['total_price'])[0];
                    $orderDetailData[] = [
                        'order_id' => $OrderInsertedId,
                        'sku_id' => $item['sku_id'],
                        'price' => $price,
                        'quantity' => $item['quantity']
                    ];
                }

                $result = [];
                foreach ($orderDetailData as $index => $detail) {
                    $result[] = $OrderDetailsModel->createDetail($detail);
                    if ($result[$index] === false) {
                        Notification::error('Đã có lỗi xảy ra', 'Có lỗi xảy ra trong quá trình thanh toán, vui lòng thử lại sau. Mã lỗi: 2');
                        $conn->rollback();
                        header('location: /cart');
                        exit();
                    }
                }

                $OrderInfo = $OrderModel->getOneOrder($OrderInsertedId);
                $bankContext = "Thanh toan don hang: " . $OrderInsertedId . ' - BeeTechNova'; //CÁI NÀY KHÔNG ĐƯỢC THÊM DẤU, ĐỪNG SỬA NHA
                $paymentURL = $VNPayHelper->createPayment($OrderInfo['total_price'], $bankContext, $OrderInsertedId);
                $conn->commit();
                header('location: ' . $paymentURL['data']);
            } else {
                Notification::error('Đã có lỗi xảy ra', 'Có lỗi xảy ra trong quá trình thanh toán, vui lòng thử lại sau. Mã lỗi: 3');
                header('location: /cart');
                exit();
            }
        }
        if ($method === 'cash') {
            $UserCart = $CartModel->getCartByUser($_SESSION['user']['id']);
            $lineItems = array_map(function ($products) {
                return [
                    'price_data' => [
                        'currency' => 'VND',
                        'product_data' => [
                            'name' => $products['product_name'],
                            'description' => $products['product_sku'],
                        ],
                        'unit_amount' => (int)$products['total_price'],
                    ],
                    'quantity' => $products['quantity']
                ];
            }, $UserCart);

            $user_id = $_SESSION['user']['id'];
            $address_id = $_POST['address'];
            $total_price = $_POST['totalPrice'];

            $insertOrder = $this->createOrder($user_id, $address_id, $total_price);

            $conn = (new Database())->MySQLi();
            $conn->begin_transaction();

            $OrderModel = new OrderModel;
            $OrderDetailModel = new OrderDetailsModel;
            $result = $OrderModel->createOrderReturnId($insertOrder);

            if ($result === false) {
                Notification::error('Đặt hàng thất bại', 'Đã xảy ra lỗi trong quá trình đặt hàng');
                $conn->rollback();
                header('location: /checkout');
                exit();
            }

            $orderDetailInsert = $this->prepareOrderDetails($result, $UserCart);

            foreach ($orderDetailInsert as $index => $dataInsert) {
                if (!$OrderDetailModel->createDetail($dataInsert)) {
                    Notification::error('Tạo đơn hàng thất bại', 'Tạo đơn hàng thất bại, vui lòng báo cáo với quản trị viên');
                    $conn->rollback();
                    header('location: /checkout');
                    exit();
                }
            }

            $conn->commit();
            Notification::success('Đã đặt hàng', 'Bạn đã đặt hàng thành công');
            $CartModel->deleteAllCarts($user_id);
            header('location: /cart');
            exit();
        }
    }
    private function prepareOrderDetails($order_id, $cartItems)
    {
        return array_map(function ($cartItem) use ($order_id) {
            $price = explode('.', $cartItem['total_price'])[0];
            return [
                'order_id' => $order_id,
                'sku_id' => $cartItem['sku_id'],
                'price' => $price,
                'quantity' => $cartItem['quantity']
            ];
        }, $cartItems);
    }
    private function createOrder($user_id, $address_id, $total_price)
    {
        return [
            'user_id' => $user_id,
            'address_id' => $address_id,
            'total_price' => $total_price,
            'status' => 1
        ];
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

    public function visaSuccess($params)
    {
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

            if ($result === false) {
                Notification::error('Đặt hàng thất bại', 'Đã xảy ra lỗi trong quá trình đặt hàng');
                $conn->rollback();
                header('location: /cart');
                exit();
            }

            $orderDetailInsert = [];

            foreach ($CartQuery as $cartItem) {
                $price = explode('.', $cartItem['total_price'])[0];
                $orderDetailInsert[] = [
                    'order_id' => $result,
                    'sku_id' => $cartItem['sku_id'],
                    'price' => $price,
                    'quantity' => $cartItem['quantity']
                ];
            }

            $lastResult = [];

            foreach ($orderDetailInsert as $index => $dataInsert) {
                $lastResult[] = $OrderDetailModel->createDetail($dataInsert);
                if ($lastResult[$index] === false) {
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
        } catch (Exception $e) {
            Notification::error('Không thể truy cập', 'Bạn không thể truy cập trang này');
            header('location: /home');
            exit();
        }
    }

    public function visaCancel()
    {
        header('location: /checkout');
    }

    public function response()
    {
        $VNPayHelper = new VNPayHelper();

        $CartModel = new CartModel();
        $OrderModel = new OrderModel();

        $result = $VNPayHelper->response();

        if (isset($result['error']) && $result['error'] === 1) {
            Notification::error('Giao dịch không thành công', 'Giao dịch không thành công, xin vui lòng thử lại');
            $OrderModel->delete($result['order_id']);
            header('location: /cart');
            exit();
        }
        if (isset($result['error']) && $result['error'] === 2) {
            Notification::error('Giao dịch không thành công', 'Giao dịch không thành công, chữ ký không hợp lệ');
            header('location: /cart');
            exit();
        }
        if ($result['status'] === 'success') {
            $deleteCart = $CartModel->deleteAllCarts($_SESSION['user']['id']);
            $UpdateStatus = $OrderModel->updateOrder($result['order_id'], ['status' => 3]); // 3 là đã thanh toán
            if ($deleteCart !== false && $UpdateStatus !== false) {
                Notification::success('Giao dịch thành công', 'Đơn hàng đã được đặt');
                header('location: /cart');
                exit();
            } else {
                Notification::error('Lỗi khi update dữ liệu', 'Đơn hàng đã được đặt nhưng chưa được cập nhật thông tin, vui lòng liên hệ quản trị viên');
                header('location: /cart');
                exit();
            }
        }
    }
}

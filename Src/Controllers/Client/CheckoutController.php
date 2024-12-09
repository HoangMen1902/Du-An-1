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
use Src\Models\Client\ProductSkusModel;
use Src\Models\Client\CheckoutModel;
use Src\Models\Client\UserModel;
use Src\Models\Client\AddressModel;
use Src\Models\Client\OrderDetailsModel;
use Src\Models\Client\OrderModel;
use Src\Models\Client\InstallmentModel;

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
        $ProductSkusModel = new ProductSkusModel(); 
    
        if ($method === 'international') {
            try {
                $UserCart = $CartModel->getCartByUser($_SESSION['user']['id']);
                $lineItems = array_map(function ($products) {
                    $price = explode('.', $products['discounted_price'])[0];
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
    
                // Giảm số lượng sản phẩm trong kho
                foreach ($UserCart as $item) {
                    $updateResult = $ProductSkusModel->decreaseStock($item['sku_id'], $item['quantity']);
                    if (!$updateResult) {
                        throw new Exception('Không thể cập nhật số lượng sản phẩm trong kho.');
                    }
                }
            } catch (Exception $e) {
                error_log('Lỗi khi thanh toán bằng visa: ' . $e->getMessage());
                Notification::error('Checkout thất bại', 'Có lỗi xảy ra trong quá trình thanh toán.');
                header('location: /checkout');
                exit();
            }
        }
    
        if ($method === 'vnpay') {
            $VNPayHelper = new VNPayHelper();
            $OrderModel = new OrderModel();
            $OrderDetailsModel = new OrderDetailsModel();
    
            $database = new Database();
            $conn = $database->MySQLi();
            $conn->begin_transaction();
    
            $totalCost = 0;
            $userId = $_SESSION['user']['id'];
            $addressId = $_POST['shipping_method'] === 'store' ? NULL : $_POST['address'];
    
            try {
                $UserCart = $CartModel->getCartByUser($userId);
                foreach ($UserCart as $item) {
                    $price = explode('.', $item['total_price'])[0];
                    $totalCost += $price;
                }
    
                $data = [
                    'status' => 2,
                    'total_price' => $totalCost,
                    'user_id' => $userId,
                    'address_id' => $addressId
                ];
    
                $OrderInsertedId = $OrderModel->createOrderReturnId($data);
                if (!$OrderInsertedId) {
                    throw new Exception('Không thể tạo đơn hàng.');
                }
    
                foreach ($UserCart as $item) {
                    $orderDetailData = [
                        'order_id' => $OrderInsertedId,
                        'sku_id' => $item['sku_id'],
                        'price' => explode('.', $item['total_price'])[0],
                        'quantity' => $item['quantity']
                    ];
    
                    if (!$OrderDetailsModel->createDetail($orderDetailData)) {
                        throw new Exception('Không thể tạo chi tiết đơn hàng.');
                    }
    
                    $updateResult = $ProductSkusModel->decreaseStock($item['sku_id'], $item['quantity']);
                    if (!$updateResult) {
                        throw new Exception('Không thể cập nhật số lượng sản phẩm trong kho.');
                    }
                }
    
                $OrderInfo = $OrderModel->getOneOrder($OrderInsertedId);
                $bankContext = "Thanh toan don hang: " . $OrderInsertedId . ' - BeeTechNova';
                $paymentURL = $VNPayHelper->createPayment($OrderInfo['total_price'], $bankContext, $OrderInsertedId);
                $conn->commit();
                header('location: ' . $paymentURL['data']);
            } catch (Exception $e) {
                $conn->rollback();
                error_log($e->getMessage());
                Notification::error('Checkout thất bại', 'Có lỗi xảy ra trong quá trình thanh toán.');
                header('location: /checkout');
                exit();
            }
        }
    
        if ($method === 'cash') {
            $UserCart = $CartModel->getCartByUser($_SESSION['user']['id']);
            $userId = $_SESSION['user']['id'];
            $addressId = $_POST['address'];
            $totalPrice = $_POST['totalPrice'];
    
            $conn = (new Database())->MySQLi();
            $conn->begin_transaction();
            $OrderModel = new OrderModel();
            $OrderDetailsModel = new OrderDetailsModel();
    
            try {
                $insertOrder = [
                    'status' => 3,
                    'total_price' => $totalPrice,
                    'user_id' => $userId,
                    'address_id' => $addressId
                ];
    
                $OrderInsertedId = $OrderModel->createOrderReturnId($insertOrder);
                if (!$OrderInsertedId) {
                    throw new Exception('Không thể tạo đơn hàng.');
                }
    
                foreach ($UserCart as $item) {
                    $orderDetailData = [
                        'order_id' => $OrderInsertedId,
                        'sku_id' => $item['sku_id'],
                        'price' => $item['total_price'],
                        'quantity' => $item['quantity']
                    ];
    
                    if (!$OrderDetailsModel->createDetail($orderDetailData)) {
                        throw new Exception('Không thể tạo chi tiết đơn hàng.');
                    }
    
                    $updateResult = $ProductSkusModel->decreaseStock($item['sku_id'], $item['quantity']);
                    if (!$updateResult) {
                        throw new Exception('Không thể cập nhật số lượng sản phẩm trong kho.');
                    }
                }
    
                $conn->commit();
                Notification::success('Đặt hàng thành công', 'Bạn đã đặt hàng thành công');
                $CartModel->deleteAllCarts($userId);
                header('location: /thanks?order_id=' . $OrderInsertedId . '&method=cash');
            } catch (Exception $e) {
                $conn->rollback();
                error_log($e->getMessage());
                Notification::error('Checkout thất bại', 'Có lỗi xảy ra trong quá trình thanh toán.');
                header('location: /checkout');
                exit();
            }
        }
    

            
        
            if ($method === 'installment') {
                $data = [
                    "fullname" => $_POST['fullname'],
                    "shipping_method" => $_POST['shipping_method'],
                    "address" => $_POST['address'],
                    "payment-method" => $_POST['payment-method'],
                    "month-payment" => $_POST['month-payment'],
                    "down-payment-amount" => $_POST['down-payment-amount'],
                    "totalPrice" => $_POST['totalPrice']
                ];
                    $totalPrice = (int)$data['totalPrice'];
                $downPaymentRate = (int)$data['down-payment-amount'] / 100;
                $installmentMonths = (int)$data['month-payment'];
        
                $downPayment = $totalPrice * $downPaymentRate;
                $remainingAmount = $totalPrice - $downPayment;
                $monthlyPayment = $remainingAmount / $installmentMonths;
        
                try {
                    $database = new Database();
                    $conn = $database->MySQLi();
        
                    $conn->begin_transaction();
        
                    $orderData = [
                        'status' => 2,
                        'total_price' => $totalPrice,
                        'user_id' => $_SESSION['user']['id'], 
                        'address_id' => $data['address']
                    ];
                    $OrderModel = new OrderModel();
                    $orderId = $OrderModel->createOrderReturnId($orderData);
        
                    if (!$orderId) {
                        throw new Exception('Lỗi tạo hóa đơn.');
                    }
        
                    $installmentData = [
                        'order_id' => $orderId,
                        'term' => $installmentMonths,
                        'interest_rate' => 5.00, 
                        'down_payment_rate' => $downPaymentRate * 100,
                        'status' => 1 // Đang trả góp
                    ];
                    $InstallmentModel = new InstallmentModel();
                    $installmentId = $InstallmentModel->createInstallment($installmentData);
        
                    if (!$installmentId) {
                        throw new Exception('Lỗi tạo kế hoạch trả góp.');
                    }
        
                    $CartModel = new CartModel();
                    $userCart = $CartModel->getCartByUser($_SESSION['user']['id']);
                    $OrderDetailsModel = new OrderDetailsModel();
        
                    foreach ($userCart as $item) {
                        $orderDetailData = [
                            'order_id' => $orderId,
                            'sku_id' => $item['sku_id'],
                            'price' => $item['total_price'],
                            'quantity' => $item['quantity']
                        ];
                        if (!$OrderDetailsModel->createDetail($orderDetailData)) {
                            throw new Exception('Lỗi lưu chi tiết hóa đơn.');
                        }
                    }
        
                    $conn->commit();
        
                    $CartModel->deleteAllCarts($_SESSION['user']['id']);
        
                    Notification::success('Thanh toán thành công', 'Hóa đơn của bạn đã được tạo.');
                    header('location: /thanks?order_id=' . $orderId);
                    exit();
                } catch (Exception $e) {
                    $conn->rollback();
                    error_log($e->getMessage());
                    Notification::error('Thanh toán thất bại', 'Đã xảy ra lỗi trong quá trình thanh toán.');
                    header('location: /checkout');
                    exit();
                }
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
            header('location: /thanks?order_id=' . $result . '&method=international');
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

        $id = $_GET['vnp_TxnRef	'];

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
                header('location: /thanks?order_id=' . $result['order_id'] . '&method=vnpay');
                exit();
            } else {
                Notification::error('Lỗi khi update dữ liệu', 'Đơn hàng đã được đặt nhưng chưa được cập nhật thông tin, vui lòng liên hệ quản trị viên');
                header('location: /cart');
                exit();
            }
        }
    }
}

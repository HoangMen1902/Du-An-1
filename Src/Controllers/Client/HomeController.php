<?php

namespace Src\Controllers\Client;

use Google\Service\Adsense\Header;
use Src\Controllers\BaseController;
use Src\Models\Client\OrderModel;
use Src\Models\Client\ProductModel;
use Src\Notifications\Notification;

class HomeController extends BaseController
{

    public function show()
    {
        $productModel = new ProductModel();
        $dataProduct = $productModel->getAllRandomProductWithSkus();
        echo $this->view->render('Client/Home', ['Name' => 'Men', 'dataProduct' => $dataProduct]);
    }

    public function showThanks()
    {
        $id = $_GET['order_id'];
        $method = $_GET['method'];
        if (!isset($id) || !isset($method) || empty($id) || empty($method)) {
            Notification::error('Đường dẫn không hợp lệ', 'Đường dẫn bạn truy cập không tồn tại');
            header('location: /home');
            exit();
        }

        switch ($method) {
            case 'international':
                $method = 'Visa/MasterCard';
                break;
            case 'vnpay':
                $method = 'VNPay';
                break;
            case 'cash':
                $method = 'Tiền mặt khi nhận hàng';
                break;
            default:
                Notification::error('Đường dẫn không hợp lệ', 'Đường dẫn bạn truy cập không tồn tại');
                header('location: /home');
                exit();
        }


        $OrderModel = new OrderModel;
        $order = $OrderModel->getOneOrderByOrderId($id);

        if ($order === false) {
            Notification::error('Đã có lỗi xảy ra', 'Không thể in hóa đơn, đơn hàng vẫn được đặt');
            header('location: /home');
            exit();
        }

        echo $this->view->render('Client/Pages/Thanks', ['data' => $order, 'method' => $method]);
    }

}

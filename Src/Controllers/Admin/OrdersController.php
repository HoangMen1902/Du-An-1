<?php
namespace Src\Controllers\Admin;

use Src\Controllers\BaseController;
use Src\Models\Admin\OrderModel;
class OrdersController extends BaseController {
    public function show() {
        $orderModel = new OrderModel();
        $orderData = $orderModel->getAllOrders();
        echo $this->view->render('Admin/Pages/Orders/OrdersList', ['orderData' => $orderData]);
    }

    public function detail($id)
    {
        $orderId = $id['id'];
        if ($id <= 0) {
            die("Invalid order ID.");
        }
        $orderModel = new OrderModel();
        $orderData = $orderModel->getOneOrders($orderId);
        if (!$orderData) {
            die("Order not found.");
        }
        echo $this->view->render('Admin/Pages/Orders/OrderDetail', ['orderData' => $orderData]);
    }
    public function search()
    {
        header('Content-Type: application/json');
        $order = $_POST['order'];
        $orders = new OrderModel();
        $result = $orders->searchOrder($order);
        echo json_encode($result);
    }
    
}
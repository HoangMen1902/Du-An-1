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
    public function changeStatus()
    {
        header('Content-Type: application/json');
        $orderId = $_POST['order_id'];
        $orderStatus = $_POST['order_status'];
    
        if (empty($orderId) || empty($orderStatus)) {
            echo json_encode(['success' => false, 'message' => 'Thiếu thông tin']);
            return;
        }
    
        if (!in_array($orderStatus, [1, 2, 3, 4, 5, 6])) {
            echo json_encode(['success' => false, 'message' => 'Trạng thái không hợp lệ']);
            return;
        }
    
        $orders = new OrderModel();
        $result = $orders->updateOrder($orderId, ['status' => $orderStatus]);
    
        if ($result) {
            echo json_encode(['success' => true, 'message' => 'Cập nhật trạng thái thành công']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Cập nhật thất bại']);
        }
    }
}
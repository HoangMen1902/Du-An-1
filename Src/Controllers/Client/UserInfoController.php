<?php

namespace Src\Controllers\Client;

use Src\Controllers\BaseController;
use Src\Models\Client\OrderModel;
use Src\Notifications\Notification;
class UserInfoController extends BaseController{
    public function myAccount() {
        echo $this->view->render('Client/Pages/MyAccount');
    }
    public function changePassword() {
        echo $this->view->render('Client/Pages/UserChangePassword');
    }
    public function userOrders($userId) {
        $userId = $_SESSION['user']['id'];
        $orderModel = new OrderModel();
        $orderData = $orderModel->getAllOrderByUser($userId);
        echo $this->view->render('Client/Pages/UserOrders', ['orderData' => $orderData]);
    }
    public function cancelOrder()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $orderId = $_POST['order_id'] ?? null;

        if ($orderId) {
            $orderModel = new OrderModel();
            $userId = $_SESSION['user']['id'];

            $order = $orderModel->getAllOrderByUserAndOrderId($orderId, $userId);

            if (!empty($order)) {

                $orderDetails = $order[0];

                if ($orderDetails['order_status'] == 1) {
                    $isCanceled = $orderModel->cancelOrder($orderId);

                    if ($isCanceled) {
                        Notification::success('Thành công', 'Đơn hàng đã được hủy.');
                    } else {
                        Notification::error('Thất bại', 'Lỗi khi hủy đơn hàng.');
                    }
                } else {
                    Notification::error('Thất bại', 'Không thể hủy đơn hàng này.');
                }
            } else {
                Notification::error('Thất bại', 'Không tìm thấy đơn hàng của bạn.');
            }
        }
    }

    header('Location: /profile/orders-list');
    exit;
}

    

}
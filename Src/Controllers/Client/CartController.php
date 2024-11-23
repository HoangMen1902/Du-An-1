<?php

namespace Src\Controllers\Client;


use Src\Controllers\BaseController;
use Src\Models\Client\CartModel;
use Src\Notifications\Notification;

class CartController extends BaseController
{

    public function show()
    {
        $user_id  = $_SESSION['user']['id'];
        $CartModel = new CartModel();
        $Data = $CartModel->getCartByUser($user_id);
        echo $this->view->render('Client/Pages/Cart', ['Data' => $Data]);
    }
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'sku_id ' => $_POST['sku_options'] ?? null,
                'quantity' => $_POST['quantity'] ?? null,
                'user_id ' => $_SESSION['user']['id']
            ];
            $CartModel = new CartModel();
            $saveResult = $CartModel->createCart($data);
            if ($saveResult) {
                header("Location: /cart");
                exit();
            } else {
                Notification::success('BeeTechnova', 'Vui lòng đăng nhập để mua sản phẩm.');
                header("Location: /login");
            }
        } else {
            header("Location: /");
            exit();
        }
    }

    public function deleteAllCart()
    {
        $CartModel = new CartModel();
        $result = $CartModel->deleteAllCarts($_SESSION['user']['id']);
        if (!$result) {
            Notification::error('Xóa thất bại', 'Lỗi khi xóa tất cả sản phẩm khỏi giỏ hàng');
            header('location: /cart');
            exit();
        } else {
            Notification::success('Xóa thành công', 'Đã xóa tất cả sản phẩm khỏi giỏ hàng');
            header('location: /cart');
            exit();
        }
    }
}

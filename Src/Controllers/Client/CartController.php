<?php

namespace Src\Controllers\Client;


use Src\Controllers\BaseController;
use Src\Models\Client\CartModel;

class CartController extends BaseController
{

    public function show()
    {
        $user_id  = $_SESSION['user']['id'];
        $CartModel = new CartModel();
        $Data = $CartModel->getCartByUser($user_id);
        // echo '<pre>';
        // var_dump($Data);
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
            // var_dump($data);
            $CartModel = new CartModel();
            $saveResult = $CartModel->createCart($data);
            if ($saveResult) {
                header("Location: /cart");
                exit();
            } else {
                $errors[] = "Không thể thêm sản phẩm vui lòng thử lại.";
                echo ' lỗi rồi nha';
            }
        } else {
            header("Location: /");
            exit();
        }
    }
}

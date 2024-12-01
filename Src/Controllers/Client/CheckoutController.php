<?php

namespace Src\Controllers\Client;


use Src\Controllers\BaseController;
use Src\Notifications\Notification;
use Src\Models\Client\CartModel;
use Src\Models\Client\CheckoutModel;
use Src\Models\Client\UserModel;
use Src\Models\Client\AddressModel;

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
}

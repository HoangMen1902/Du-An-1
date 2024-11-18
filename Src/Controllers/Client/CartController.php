<?php

namespace Src\Controllers\Client;


use Src\Controllers\BaseController;

class CartController extends BaseController
{

    public function show()
    {
        echo $this->view->render('Client/Pages/Cart', ['Name' => 'Tien']);
    }
    public function addCart()
    {
        // echo $this->view->render('Client/Pages/Cart', ['Name' => 'Tien']);
        echo '<pre>';
        var_dump($_POST);
    }
}

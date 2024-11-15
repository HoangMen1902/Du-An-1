<?php

namespace Src\Controllers\Client;


use Src\Controllers\BaseController;
use Src\Models\Client\ProductModel;

class HomeController extends BaseController {

    public function show() {
        $productModel = new ProductModel();
        $dataProduct = $productModel->getAllRandomProductWithSkus();
        echo $this->view->render('Client/Home', ['Name' => 'Men', 'dataProduct' => $dataProduct ]);
    }
}
<?php

namespace Src\Controllers\Client;

use Src\Controllers\BaseController;
use Src\Models\Client\ProductModel;

class ProductController extends BaseController
{
    public function show($id)
    {
        $productId = $id['id'];
        // var_dump($productId);
        if (!$productId) {
            echo "ID sản phẩm không hợp lệ.";
            return;
        }

        $productModel = new ProductModel();
        $productData = $productModel->getProductById($productId);
    
        // echo '<pre>';
        // var_dump($productData);

        if (!$productData) {
            echo "Sản phẩm không tồn tại.";
            return;
        }

        echo $this->view->render('Client/Pages/Product/Detail', [
            'productData' => $productData
        ]);
    }
}

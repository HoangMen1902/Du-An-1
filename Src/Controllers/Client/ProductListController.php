<?php
    namespace Src\Controllers\Client;

    use Src\Controllers\BaseController;
    use Src\Models\Client\ProductModel;

    class ProductListController extends BaseController {
        public function show() {

            $productModel = new ProductModel();
            $productData = $productModel->getAllProductWithSkus();

            echo $this->view->render('Client/Pages/Product/List',
             ['productData' => $productData]
            );
        }
    }
?>
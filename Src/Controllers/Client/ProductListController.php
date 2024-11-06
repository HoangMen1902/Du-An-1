<?php
    namespace Src\Controllers\Client;

    use Src\Controllers\BaseController;

    class ProductListController extends BaseController {
        public function show() {
            echo $this->view->render('Client/Pages/Product/List', ['Name' => 'Tien']);
        }
    }
?>
<?php
    namespace Src\Controllers\Client;

    use Src\Controllers\BaseController;

    class ProductController extends BaseController {
        public function show() {
            echo $this->view->render('Client/Pages/Product/Detail', ['Name' => 'Men']);
        }
    }
?>
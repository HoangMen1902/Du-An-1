<?php
namespace Src\Controllers\Admin;

use Src\Controllers\BaseController;

class ProductsController extends BaseController {
    public function show() {
        echo $this->view->render('Admin/Pages/Products/ProductList');
    }

    public function add(){
        echo $this->view->render('Admin/Pages/Products/ProductAdd');
    }
    public function edit(){
        echo $this->view->render('Admin/Pages/Products/ProductEdit');
    }
}
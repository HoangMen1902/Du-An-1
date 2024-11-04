<?php
namespace Src\Controllers\Admin;

use Src\Controllers\BaseController;

class OrdersController extends BaseController {
    public function show() {
        echo $this->view->render('Admin/Pages/Orders/OrdersList');
    }

    public function detail(){
        echo $this->view->render('Admin/Pages/Orders/OrderDetail');
    }
    
}
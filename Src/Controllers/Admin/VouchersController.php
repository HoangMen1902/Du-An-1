<?php
namespace Src\Controllers\Admin;

use Src\Controllers\BaseController;

class VouchersController extends BaseController {
    public function show() {
        echo $this->view->render('Admin/Pages/Vouchers/VouchersList');
    }

    public function add(){
        echo $this->view->render('Admin/Pages/Vouchers/VouchersAdd');
    }
    public function edit(){
        echo $this->view->render('Admin/Pages/Vouchers/VouchersEdit');
    }
}
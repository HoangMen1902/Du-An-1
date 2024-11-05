<?php
namespace Src\Controllers\Admin;

use Src\Controllers\BaseController;

class InstallmentsController extends BaseController {
    public function show() {
        echo $this->view->render('Admin/Pages/InstallmentPlan/InstallmentList');
    }
    public function add() {
        echo $this->view->render('Admin/Pages/InstallmentPlan/AddInstallment');
    }
}
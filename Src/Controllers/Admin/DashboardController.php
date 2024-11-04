<?php
namespace Src\Controllers\Admin;

use Src\Controllers\BaseController;

class DashboardController extends BaseController {
    public function show() {
        echo $this->view->render('Admin/index');
    }
}
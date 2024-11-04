<?php
namespace Src\Controllers\Admin;

use Src\Controllers\BaseController;

class BrandController extends BaseController {
    public function show() {
        echo $this->view->render('Admin/Pages/Brands/BrandsList');
    }

    public function add(){
        echo $this->view->render('Admin/Pages/Brands/BrandAdd');
    }
    public function edit(){
        echo $this->view->render('Admin/Pages/Brands/BrandEdit');
    }
}
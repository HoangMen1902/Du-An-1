<?php
namespace Src\Controllers\Admin;

use Src\Controllers\BaseController;

class CategoryController extends BaseController {
    public function show() {
        echo $this->view->render('Admin/Pages/Category/CategoryList');
    }

    public function add(){
        echo $this->view->render('Admin/Pages/Category/CategoryAdd');
    }
    public function edit(){
        echo $this->view->render('Admin/Pages/Category/CategoryEdit');
    }
}
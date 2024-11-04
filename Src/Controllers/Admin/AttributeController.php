<?php
namespace Src\Controllers\Admin;

use Src\Controllers\BaseController;

class AttributeController extends BaseController {
    public function show() {
        echo $this->view->render('Admin/Pages/Attribute/AttributeList');
    }

    public function add(){
        echo $this->view->render('Admin/Pages/Attribute/AttributeAdd');
    }
    public function edit(){
        echo $this->view->render('Admin/Pages/Attribute/AttributeEdit');
    }
}
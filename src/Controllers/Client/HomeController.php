<?php

namespace Src\Controllers\Client;


use Src\Controllers\BaseController;

class HomeController extends BaseController {

    public function show() {
        echo $this->view->render('Client/Home', ['Name' => 'Men']);
    }
}
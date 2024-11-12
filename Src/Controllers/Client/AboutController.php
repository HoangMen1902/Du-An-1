<?php

namespace Src\Controllers\Client;


use Src\Controllers\BaseController;

class AboutController extends BaseController {

    public function show() {
        echo $this->view->render('Client/Pages/About', ['Name' => 'Tien']);
    }
}
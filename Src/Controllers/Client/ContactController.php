<?php

namespace Src\Controllers\Client;


use Src\Controllers\BaseController;

class ContactController extends BaseController {

    public function show() {
        echo $this->view->render('Client/Pages/Contact', ['Name' => 'Men']);
    }
}
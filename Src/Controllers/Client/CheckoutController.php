<?php

namespace Src\Controllers\Client;


use Src\Controllers\BaseController;

class CheckoutController extends BaseController {

    public function show() {
        echo $this->view->render('Client/Payment/checkout', ['Name' => 'Men']);
    }
}
<?php

namespace Src\Controllers\Client;


use Src\Controllers\BaseController;

class SearchController extends BaseController {

    public function show() {
        echo $this->view->render('Client/Components/Search', ['Name' => 'Bao']);
    }
}
<?php

namespace Src\Controllers;

use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;

class BaseController {
    protected $view;

    public function __construct() {
        $this->view = new Engine('Src\\Views');
    }

}
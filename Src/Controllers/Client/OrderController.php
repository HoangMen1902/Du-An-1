<?php

namespace Src\Controllers\Client;

use Src\Controllers\BaseController;
use Src\Models\Client\AddressModel;
use Src\Notifications\Notification;

class OrderController extends BaseController
{
    public function show()
    {
        echo'<pre>';
        var_dump($_POST);
        // echo $this->view->render('Client/Pages/Orders', ['Name' => 'Men']);
    }

    
}

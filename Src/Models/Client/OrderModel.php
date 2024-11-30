<?php

namespace Src\Models\Client;

use Src\Models\BaseModel;

class OrderModel extends BaseModel {
    protected $table = 'orders';
    protected $id = 'id';

    public function createOrderReturnId($data) {
        return $this->createReturnId($data);
    }

}
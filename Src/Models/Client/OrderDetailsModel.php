<?php

namespace Src\Models\Client;

use Src\Models\BaseModel;


class OrderDetailsModel extends BaseModel {
    protected $table = 'order_details';
    protected $id = 'id';
    
    public function createDetail($data) {
        return $this->create($data);
    }
}
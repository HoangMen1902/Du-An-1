<?php

namespace Src\Models\Client;

use Exception;
use Src\Models\BaseModel;


class CheckoutModel extends BaseModel
{

    protected $table = 'Checkouts';

    protected $id = 'id';
    public function getAllCheckout()
    {
        return $this->getAll();
    }

    public function getAddress()
    {

        
    }

    public function getOneCheckout($id)
    {
        return $this->getOne($id);
    }

    public function createCheckout($data)
    {
        return $this->create($data);
    }

    public function updateCheckout($id, $data)
    {
        return $this->update($id, $data);
    }
    public function deleteCheckout($id)
    {
        return $this->delete($id);
    }
}

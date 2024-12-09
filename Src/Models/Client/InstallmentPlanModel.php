<?php

namespace Src\models\Client;

use Src\models\BaseModel;
use \DateTime;
use Exception;

class InstallmentPlanModel extends BaseModel
{
    protected $table = 'installment_plans';
    protected $id = 'id';

  
    public function getAllInstallment()
    {
        return $this->getAll();
    }

  
    public function getOneInstallment($id)
    {
        return $this->getOne($id);
    }


    public function createInstallment($data)
    {
        return $this->create($data);
    }
    public function updateInstallment($data,$id){
        return $this->update($data,$id);
    }
    public function deleteInstallment(int $id)
    {
        return $this->delete($id);
    }


  
}

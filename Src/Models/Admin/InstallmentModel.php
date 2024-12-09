<?php

namespace Src\Models\Admin;

use Src\Models\BaseModel;

class InstallmentModel extends BaseModel
{
    protected $table = 'Installments';
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


    public function updateInstallment($id, $data)
    {
        return $this->update($id, $data);
    }
    public function deleteInstallment($id)
    {
        return $this->delete($id);
    }

    public function getAllActiveCategories()
    {
        return $this->getAllByStatus();
    }
}

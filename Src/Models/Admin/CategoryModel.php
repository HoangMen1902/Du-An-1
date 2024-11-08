<?php

namespace Src\Models\Admin;

use Src\Models\BaseModel;


class CategoryModel extends BaseModel
{

    protected $table = 'categories';

    protected $id;

    public function getAllCategory()
    {
        return $this->getAll();
    }
    public function getOneCategory($id)
    {
        return $this->getOne($id);
    }
    public function createCategory($data)
    {
        return $this->create($data);
    }

    public function isNameDuplicate($name)
    {
        return $this->findDuplicateByColumn('name', $name);
    }
}

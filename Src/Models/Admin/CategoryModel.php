<?php

namespace Src\Models\Admin;

use Src\Models\BaseModel;


class CategoryModel extends BaseModel
{

    protected $table = 'categories';

    protected $id = 'id';

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
    public function updateCategory($id, $data){
        return $this->update($id, $data);
    }
    public function deleteCategory($id)
    {
        return $this->delete($id);
    }
    
    public function getAllActiveCategories(){
        return $this->getAllByStatus();
    }
}

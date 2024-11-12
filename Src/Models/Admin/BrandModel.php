<?php
namespace Src\Models\Admin;

use Src\Models\BaseModel;

class BrandModel extends BaseModel {
    protected $table = 'brands';
    protected $id = 'id';
    
    public function store($data) {
        return $this->create($data);
    }


    public function getOneBrand($id) {
        return $this->getOne($id);
    }
    public function updateBrand($id, $data) {
        return $this->update($id,$data);
    }

    public function getAllActiveBrands() {
        return $this->getAllByStatus();
    }

    public function deleteBrand($id) {
        return $this->delete($id);
    } 
}
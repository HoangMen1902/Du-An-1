<?php
namespace Src\Models\Admin;

use Src\Models\BaseModel;

class BrandModel extends BaseModel {
    protected $table = 'brands';
    protected $id = 'id';
    
    public function store($data) {
        return $this->create($data);
    }
}
<?php
namespace Src\Models\Admin;

use Src\Models\BaseModel;

class SkuValuesModel extends BaseModel {
    protected $table = 'sku_values';
    protected $id = 'id';
    
    public function store($data) {
        return $this->create($data);
    }
}
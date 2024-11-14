<?php

namespace Src\Models\Admin;

use Src\Models\BaseModel;


class ProductCategoryModel extends BaseModel {
    protected $table = 'product_categories';
    protected $id = 'id';

    public function store($data) {
        return $this->create($data);
    }
}
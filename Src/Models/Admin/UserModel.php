<?php

namespace Src\Models\Admin;

use Src\Models\BaseModel;

class UserModel extends BaseModel {
    protected $table = 'users';
    protected $id = 'id';
    public function store($data) {
        return $this->create($data);
    }
}
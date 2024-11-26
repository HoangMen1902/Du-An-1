<?php

namespace Src\models\Admin;

use Src\models\BaseModel;
use \DateTime;
use Exception;

class RatingModel extends BaseModel
{
    protected $table = 'ratings';
    protected $id = 'id';
    
    public function store($data) {
        return $this->create($data);
    }


    public function getOneRating($id) {
        return $this->getOne($id);
    }
    public function updateRating($id, $data) {
        return $this->update($id,$data);
    }

    public function getAllRatings() {
        return $this->getAllByStatus();
    }

    public function deleteRating($id) {
        return $this->delete($id);
    } 
}
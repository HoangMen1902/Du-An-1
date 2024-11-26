<?php

namespace Src\models\Admin;

use Src\models\BaseModel;
use \DateTime;
use Exception;

class CommentModel extends BaseModel
{
    protected $table = 'comments';
    protected $id = 'id';
    
    public function store($data) {
        return $this->create($data);
    }


    public function getOneComment($id) {
        return $this->getOne($id);
    }
    public function updateComment($id, $data) {
        return $this->update($id,$data);
    }

    public function getAllComments() {
        return $this->getAllByStatus();
    }

    public function deleteComment($id) {
        return $this->delete($id);
    } 
}
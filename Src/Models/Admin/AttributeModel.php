<?php
    namespace Src\Models\Admin;

    use Src\Models\BaseModel;

    class AttributeModel extends BaseModel { 
        protected $table = "options";
        protected $id = "id";
        public function getAllAttribute(){
             return $this->getAll();
        }
        public function getOneAttribute($id){
            $id = (int) $id;
            return $this->getOne($id);
        }
        public function createAttribute($data){
            return $this->create($data);
        }
        public function updateAttribute($id,$data){
            return $this->update($id , $data);
        }
        public function deleteAttribute($id){
            return $this->delete($id);
        }
        public function isNameDupliAttributeByColumn($name)
        {
            return $this->findDuplicateByColumn('name', $name);
        }
    }



?>
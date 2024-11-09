<?php
    namespace Src\Models\Admin;

    use Src\Models\BaseModel;

    class ProductModel extends BaseModel { 
        protected $table = "products";
        protected $id = "id";
        public function getAllProduct(){
             return $this->getAll();
        }
        public function getOneProduct($id){
            return $this->getOne($id);
        }
        public function createProduct($data){
            return $this->create($data);
        }
        public function updateProduct($id,$data){
            return $this->update($id , $data);
        }
        public function deleteProduct($id){
            return $this->delete($id);
        }
        public function isNameDuplicate($name)
        {
            return $this->findDuplicateByColumn('name', $name);
        }
    }



?>
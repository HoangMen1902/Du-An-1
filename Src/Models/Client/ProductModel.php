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
            $id = (int) $id;
            return $this->getOne($id);
        }
    }



?>
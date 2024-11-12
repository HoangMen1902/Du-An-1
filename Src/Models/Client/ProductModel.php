<?php
    namespace Src\Models\Client;

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

        public function getAllProductWithSkus() {
            $sql = "SELECT products.*, product_skus.price AS product_price,  product_skus.images AS images
                    FROM products
                    JOIN product_skus ON product_skus.product_id = products.id";
    
            $conn = $this->_conn->MySQLi();
            $result = $conn->query($sql);
            if ($result) {
                $products = $result->fetch_all(MYSQLI_ASSOC);
                return $products;
            } else {
                return [];
            }
        }
        
    }



?>
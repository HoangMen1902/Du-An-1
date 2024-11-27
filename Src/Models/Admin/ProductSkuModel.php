<?php
namespace Src\Models\Admin;

use Exception;
use Src\Models\BaseModel;

class ProductSkuModel extends BaseModel { 
    protected $table = "product_skus";
    protected $id = "id";


    public function createSku($skuData) {
      
        return $this->create($skuData);
    }

    public function getSkusByProductId($product_id) {
        return $this->findByColumn('product_id', $product_id);
    }

    public function getAllSkuByProduct($id) {
        try {
            $sql = "SELECT pskus.* 
            FROM products 
            JOIN product_skus AS pskus 
            ON pskus.product_id = products.id 
            WHERE products.id = ?";
            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('i', $id);
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        } catch (Exception $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function updateSku($id, $skuData) {
        return $this->update($id, $skuData);
    }

    public function deleteSku($id) {
        return $this->delete($id);
    }
    public function saveSku($skus, $productId){
        return $this->saveSku($skus, $productId);
    }

    public function getOneSku($id) {
        return $this->getOne($id);
    }
}
?>

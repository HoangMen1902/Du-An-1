<?php
namespace Src\Models\Admin;

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

    public function updateSku($id, $skuData) {
        return $this->update($id, $skuData);
    }

    public function deleteSku($id) {
        return $this->delete($id);
    }
    public function saveSku($skus, $productId){
        return $this->saveSku($skus, $productId);
    }
}
?>

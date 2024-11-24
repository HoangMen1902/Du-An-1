<?php
namespace Src\Models\Admin;

use Exception;
use Src\Models\BaseModel;

class SkuValuesModel extends BaseModel {
    protected $table = 'sku_values';
    protected $id = 'id';
    
    public function store($data) {
        return $this->create($data);
    }

    public function getAllOptionOfSku($sku_id) {
        try {
            $sql = "SELECT *, $this->table.id AS sku_values_id FROM $this->table
            JOIN product_skus AS pskus ON pskus.id = $this->table.sku_id 
            JOIN options AS o ON o.id = $this->table.option_id 
            JOIN option_values AS ov ON ov.id = $this->table.value_id
            WHERE $this->table.sku_id = ?";
            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('i', $sku_id);
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        } catch (Exception $e) {
            error_log('Lỗi: '. $e->getMessage());
            return false;
        }
    }

    public function deleteSkuVal($id) {
        return $this->delete($id);
    }
}
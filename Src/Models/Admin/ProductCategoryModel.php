<?php

namespace Src\Models\Admin;

use Exception;
use Src\Models\BaseModel;


class ProductCategoryModel extends BaseModel {
    protected $table = 'product_categories';
    protected $id = 'id';

    public function store($data) {
        return $this->create($data);
    }
    public function updateCategory($id, $data) {
        return $this->update($id,$data);
    }

    public function findCategory($productId) {
        try {
            $sql = "SELECT * FROM $this->table WHERE product_id = ?";
            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('i', $productId);
            $stmt->execute();
            return $stmt->get_result()->fetch_assoc();
        } catch (Exception $e) {
            error_log('Lỗi: '. $e->getMessage());
            return false;
        }
    }
}
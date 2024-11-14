<?php

namespace Src\Models\Admin;

use Src\Models\BaseModel;

class ProductOptionModel extends BaseModel {
    protected $table = "option_values";
    protected $is = 'id';

    public function storeReturnId($data) {
        try {
            $sql = "INSERT INTO $this->table (";
            foreach ($data as $key => $value) {
                $sql .= "$key, ";
            }
            // INSERT INTO $this->table (name, description, status, 
            $sql = rtrim($sql, ", ");
            // INSERT INTO $this->table (name, description, status
            $sql .= " ) VALUES (";
            // INSERT INTO $this->table (name, description, status) VALUES (
            foreach ($data as $key => $value) {
                $sql .= "'$value', ";
            }

            // INSERT INTO $this->table (name, description, status) VALUES ('category test', 'category test description', '1', 
            $sql = rtrim($sql, ", ");
            // INSERT INTO $this->table (name, description, status) VALUES ('category test', 'category test description', '1'

            $sql .= ")";
            // INSERT INTO $this->table (name, description, status) VALUES ('category test', 'category test description', '1')

            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            return $conn->insert_id;
        } catch (\Throwable $th) {
            error_log('Lỗi khi thêm dữ liệu: ' . $th->getMessage() . ' ' . $sql);
            return false;
        }
    }

    public function getOptions($id) {
        $result = [];
        try {
            $sql = "SELECT * FROM $this->table JOIN options ON options.id = $this->table.option_id WHERE $this->table.id =?";
            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);
            
            $stmt->bind_param('i', $id);
            $stmt->execute();

            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị chi tiết dữ liệu: ' . $th->getMessage() . ' ' . $sql);
            return $result;
        }
    }
}
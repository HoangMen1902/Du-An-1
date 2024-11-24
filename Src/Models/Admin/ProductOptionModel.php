<?php

namespace Src\Models\Admin;

use Src\Models\BaseModel;

class ProductOptionModel extends BaseModel {
    protected $table = "option_values";
    protected $id = 'id';

    public function storeReturnId($data) {
        try {
            $sql = "INSERT INTO $this->table (";
            foreach ($data as $key => $value) {
                $sql .= "$key, ";
            }
            $sql = rtrim($sql, ", ");
            $sql .= " ) VALUES (";
            foreach ($data as $key => $value) {
                $sql .= "'$value', ";
            }
            $sql = rtrim($sql, ", ");
            $sql .= ")";
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

    public function deleteOptionValue($id) {
        return $this->delete($id);
    }
    public function updateValue($id, $data) {
        return $this->update($id, $data);
    }
}
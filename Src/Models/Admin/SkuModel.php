<?php

namespace Src\Models\Admin;

use Src\Models\BaseModel;


class SkuModel extends BaseModel {
    protected $table = 'product_skus';
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
            error_log('Lỗi khi thêm dữ liệu: ' . $th->getMessage());
            return false;
        }
    }

    public function store($data) {
        return $this->create($data);
    }
}
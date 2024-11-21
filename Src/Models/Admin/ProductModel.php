<?php

namespace Src\Models\Admin;

use Src\Models\BaseModel;

class ProductModel extends BaseModel
{
    protected $table = "products";
    protected $id = "id";

    public function getAllProduct()
    {
        return $this->getAll();
    }

    public function getOneProduct($id)
    {
        $result = [];
        try {
            $sql = "SELECT *,
            $this->table.name AS product_name, 
            b.name AS brand_name ,
            cv.name AS value_name,
            ct.name as category_name
            FROM 
            $this->table 
            JOIN
            brands b ON $this->table.brand_id = b.id 
            JOIN 
            product_categories AS pc 
            ON pc.product_id = $this->table.id
            JOIN category_values AS cv 
            ON cv.id = pc.category_values_id
            JOIN categories as ct
            ON ct.id = cv.category_id
            WHERE 
            $this->table.$this->id = ?";
            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);

            $stmt->bind_param('i', $id);
            $stmt->execute();
            return $stmt->get_result()->fetch_assoc();
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị chi tiết dữ liệu: ' . $th->getMessage());
            return $result;
        }
    }

    public function createProduct($data)
    {
        return $this->create($data);
    }

    public function updateProduct($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteProduct($id)
    {
        return $this->delete($id);
    }

    public function isNameDupliProductByColumn($name)
    {
        return $this->findDuplicateByColumn('name', $name);
    }


    public function createReturnProductId($data)
    {
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
            $id = $conn->insert_id;
            return $id;
        } catch (\Throwable $th) {
            error_log('Lỗi khi thêm dữ liệu: ' . $th->getMessage());
            return false;
        }
    }
}

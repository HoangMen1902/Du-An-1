<?php

namespace Src\Models\Admin;

use Exception;
use Src\Models\BaseModel;

class ProductModel extends BaseModel
{
    protected $table = "products";
    protected $id = "id";

    public function getAllProduct()
    {
        return $this->getAll();
    }

    public function getOneNormal($id)  {
        return $this->getOne($id);
    }

    public function getOneProduct($id)
    {
        $result = [];
        try {
            $sql = "SELECT *,
            $this->table.id as product_id,
            $this->table.name AS product_name, 
            $this->table.description AS product_description,
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
            error_log($sql);

            $stmt->bind_param('i', $id);
            $stmt->execute();
            return $stmt->get_result()->fetch_assoc();
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị chi tiết dữ liệu: ' . $th->getMessage());
            return $result;
        }
    }

    public function getProductCategories($id) {
        try {
            $sql = "SELECT * FROM $this->table AS p JOIN product_categories AS pc ON p.id = pc.product_id 
            JOIN category_values AS cv ON cv.id = pc.category_values_id 
            JOIN categories AS c on c.id = cv.category_id 
            WHERE p.$this->id = ?";
            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $result = $stmt->get_result()->fetch_assoc();
            return $result;
        } catch (Exception $e) {
            error_log('Lỗi khi hiển thị chi tiết dữ liệu: ' . $e->getMessage());
            return false;
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

    public function getVariantOfProduct($id)
    {

        try {

            $sql = "SELECT 
            p.id AS product_id, 
            p.name AS product_name, 
            p.description,
            p.thumbnail,
            p.discount,
            ps.id AS sku_id,
            ps.sku,
            ps.images,
            ps.price AS original_price,
            ps.price - (ps.price * p.discount / 100) AS discounted_price,
            ps.quantity,
            GROUP_CONCAT(ov.value_name SEPARATOR ', ') AS option_values,
            GROUP_CONCAT(o.name SEPARATOR ', ') AS option_names
        FROM products AS p 
        JOIN product_skus AS ps ON p.id = ps.product_id
        LEFT JOIN sku_values AS sv ON ps.id = sv.sku_id
        LEFT JOIN option_values AS ov ON sv.value_id = ov.id
        LEFT JOIN options AS o ON sv.option_id = o.id
        WHERE p.status = 1 AND p.id = ?
        GROUP BY ps.id
        ORDER BY p.id, ps.id";
        $conn = $this->_conn->MySQLi();
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $result;

        } catch (Exception $e) {
        }
    }
}

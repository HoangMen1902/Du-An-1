<?php

namespace Src\Models;

use Src\Interfaces\Admin\CrudInterface;
use Exception;
use Src\Models\Database;

abstract class BaseModel implements CrudInterface
{
    protected $_conn;

    protected $table;
    protected $id;
    const STATUS_ENABLE = 1;
    const STATUS_DISABLE = 0;


    public function __construct()
    {
        $this->_conn = new Database();
    }

    public function getAll()
    {
        $result = [];
        try {
            $sql = "SELECT * FROM $this->table";
            $result = $this->_conn->MySQLi()->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị tất cả dữ liệu: ' . $th->getMessage());
            return $result;
        }
    }
    public function getOne(int $id)
    {
        $result = [];
        try {
            $sql = "SELECT * FROM $this->table  WHERE $this->id=?";
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


    public function create(array $data)
    {
        // $sql ="INSERT INTO $this->table (name, description, status) VALUES ('category test', 'category test description', '1')";

        // $result = $this->_conn->connect()->query($sql);
        // return $result;

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
            return $stmt->execute();
        } catch (\Throwable $th) {
            error_log('Lỗi khi thêm dữ liệu: ' . $th->getMessage());
            return false;
        }
    }
    public function update(int $id, array $data)
    {
        try {
            $sql = "UPDATE $this->table SET ";
            foreach ($data as $key => $value) {
                $sql .= "$key = '$value', ";
            }
            $sql = rtrim($sql, ", ");

            $sql .= " WHERE $this->id=$id";
            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);
            echo '<pre>';

            var_dump($sql);
            return $stmt->execute();
        } catch (\Throwable $th) {
            error_log('Lỗi khi cập nhật dữ liệu: ' . $th->getMessage());
            return false;
        }
    }
    public function delete(int $id): bool
    {
        try {
            $sql = "DELETE FROM $this->table WHERE $this->id=$id";

            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);
            $stmt->execute();

            // trả về số hàng dữ liệu bị ảnh hưởng
            return $stmt->affected_rows;
        } catch (\Throwable $th) {
            error_log('Lỗi khi xóa dữ liệu: ' . $th->getMessage());
            return false;
        }
    }
 
    public function getAllByStatus()
    {
        $sql = "SELECT * FROM $this->table WHERE status=" . self::STATUS_ENABLE;
        $result = $this->_conn->MySQLi()->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function countTotal()
    {
        $result = [];
        try {
            $sql = "SELECT count(*) AS total FROM $this->table";
            $result = $this->_conn->MySQLi()->query($sql);
            return $result->fetch_assoc();
        } catch (\Throwable $th) {
            error_log('Lỗi khi thu thập số liệu: ' . $th->getMessage());
            return $result;
        }
    }
    public function countCommentByProduct()
    {
        $result = [];
        try {
            $sql = "SELECT COUNT(*) AS count , products.name FROM comments INNER JOIN products on comments.product_id = products.id

            GROUP BY comments.product_id ORDER BY count DESC LIMIT 5";
            $result = $this->_conn->MySQLi()->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị tất cả dữ liệu: ' . $th->getMessage());
            return $result;
        }
    }

    public function countProductByView()
    {
        $result = [];
        try {
            $sql = "SELECT sum(view) AS total FROM $this->table";
            $result = $this->_conn->MySQLi()->query($sql);
            return $result->fetch_assoc();
        } catch (\Throwable $th) {
            error_log('Lỗi khi thu thập số liệu: ' . $th->getMessage());
            return $result;
        }
    }

    public function findDuplicateByColumn($column, $value)
    {
        try {
            $sql = "SELECT COUNT(*) AS count FROM $this->table WHERE $column = ?";
            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);

            // Gắn giá trị tham số
            $stmt->bind_param('s', $value);
            $stmt->execute();
            $result = $stmt->get_result()->fetch_assoc();

            return $result['count'] > 0;
        } catch (\Throwable $th) {
            error_log('Lỗi khi kiểm tra trùng lặp theo cột: ' . $th->getMessage());
            return false;
        }
    }

    public function findByColumn(int $product_id)
    {
        try {
            $sql = "SELECT * FROM product_skus WHERE product_id = ?";
            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('i', $product_id);
            $stmt->execute();
            $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            return $result;
        } catch (\Throwable $th) {
            error_log('Lỗi khi lấy tất cả SKUs của sản phẩm: ' . $th->getMessage());
            return [];
        }
    }

    public function saveSku(array $skus, int $productId)
    {
        try {
            $conn = $this->_conn->MySQLi();
            $conn->begin_transaction();
    
            foreach ($skus as $sku) {
                $images = $sku['images'] ?? null;
    
                $sql = "INSERT INTO product_skus (sku, images, price, quantity, product_id) 
                        VALUES (?, ?, ?, ?, ?)";
    
                $stmt = $conn->prepare($sql);
    
                $stmt->bind_param('ssiii', 
                    $sku['sku'],       
                    $images,           
                    $sku['price'],      
                    $sku['quantity'],  
                    $productId        
                );
    
                $stmt->execute();
            }
    
            $conn->commit();
            return true;
    
        } catch (\Throwable $th) {
            $conn->rollback();
            error_log('Lỗi khi lưu SKU: ' . $th->getMessage());
            return false;
        }
    }
    

 
}
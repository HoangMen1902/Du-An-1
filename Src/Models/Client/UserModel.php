<?php

namespace Src\Models\Client;

use Exception;
use mysqli;
use Src\Models\BaseModel;

class UserModel extends BaseModel
{
    protected $table = 'users';
    protected $id = 'id';
    public function store($data)
    {
        return $this->create($data);
    }

    public function showAll()
    {
        $result = [];
        try {
            $sql = "SELECT * FROM $this->table WHERE status = 1 ORDER BY created_at DESC";
            $result = $this->_conn->MySQLi()->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị tất cả dữ liệu: ' . $th->getMessage());
            return $result;
        }
    }

    public function getUser($id)
    {
        return $this->getOne($id);
    }

    public function findDuplicateUsersByColumn($column, $value)
    {
        return $this->findDuplicateByColumn($column, $value);
    }

    public function findDuplicateUsersForUpdate($column, $value, $id)
    {
        try {
            $sql = "SELECT COUNT(*) AS count FROM $this->table WHERE $column = ? AND id != ?";
            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);

            $stmt->bind_param('si', $value, $id);
            $stmt->execute();
            $result = $stmt->get_result()->fetch_assoc();

            return $result['count'] > 0;
        } catch (\Throwable $th) {
            error_log('Lỗi khi kiểm tra trùng lặp theo cột: ' . $th->getMessage());
            return false;
        }
    }

    public function findUserForLogin($column, $email)
    {
        try {
            $sql = "SELECT * FROM $this->table WHERE $column = ?";
            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);

            // Gắn giá trị tham số
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $result = $stmt->get_result()->fetch_assoc();

            return $result;
        } catch (\Throwable $th) {
            error_log('Lỗi khi kiểm tra dữ liệu theo cột: ' . $th->getMessage());
            return false;
        }
    }

    public function getOneUserByInfo($column, $info)
    {
        $this->id = $column;
        $result = [];
        try {
            $sql = "SELECT * FROM $this->table WHERE $this->id = ?";
            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('s', $info);
            $stmt->execute();
            return $stmt->get_result()->fetch_assoc();
        } catch (\Throwable $th) {
            error_log('Đã xảy ra lỗi khi lấy dữ liệu: ' . $th->getMessage());
            return $result;
        }
    }
    public function getUserById($id)
    {
        $this->id = 'id';
        return $this->getOne($id);
    }

    public function getAccountByEmail($email) {
        $sql = "SELECT * FROM Users WHERE email = ?";
        $conn = $this->_conn->MySQLi();
        $stmt = $conn->prepare($sql);
    
        if ($stmt) {
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $result = $stmt->get_result()->fetch_assoc();
            $stmt->close();
            return $result;
        }
    
        return null; 
    }
    
    public function insertAccount($email, $firstname, $lastname, $avatar, $method = 'local')
    {
        $sql = "INSERT INTO Users (email, firstname, lastname, avatar, status, role, method, created_at, updated_at) 
                VALUES (?, ?, ?, ?, ?, ?, ?, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
        
        $conn = $this->_conn->MySQLi();
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $status = 1; 
            $role = 1;   
            $stmt->bind_param('ssssiss', $email, $firstname, $lastname, $avatar, $status, $role, $method);
            $stmt->execute();
            $insert_id = $stmt->insert_id;
            $stmt->close();

            return $insert_id;
        }

        return null;
    }
    
    
    
}

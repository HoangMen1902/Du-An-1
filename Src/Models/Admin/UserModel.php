<?php

namespace Src\Models\Admin;

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
        return $this->getAll();
    }

    public function searchUser($data)
    {
        try {
            if(empty($data)) {
                $sql = "SELECT * FROM USERS";
                $conn = $this->_conn->MySQLi();
                $result = $conn->query($sql);
                return $result->fetch_all(MYSQLI_ASSOC);
            } else {
                $sql = "SELECT * FROM users 
                WHERE users.username LIKE ?
                   OR users.id = ?
                   OR users.firstname LIKE ?
                   OR users.lastname LIKE ?
                   OR users.email LIKE ?
                   OR users.phone LIKE ?";
                    $conn = $this->_conn->MySQLi();
                    $stmt = $conn->prepare($sql);
        
                    $data = '%' . $data . '%';
                    $stmt->bind_param('sissss', $data, $data, $data, $data, $data, $data);
                    if($stmt->execute()) {
                        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
                        return $result;
                    } else {
                        echo "Execute failed: " . $stmt->error;
                        return false;
                    };
            }
            

        } catch (Exception $e) {
            error_log('Lỗi khi hiển thị tất cả dữ liệu: ' . $e->getMessage());
            return false;
        }
    }
}

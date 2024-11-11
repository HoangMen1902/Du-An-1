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

    public function getUser($id) {
        return $this->getOne($id);
    }

    public function findDuplicateUsersByColumn($column, $value) {
        return $this->findDuplicateByColumn($column, $value);
    }

    public function findDuplicateUsersForUpdate($column, $value, $id) {
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

}

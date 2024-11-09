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

    public function getLockedUsers() {
        try {
            $sql = "SELECT * FROM $this->table WHERE status = 2 ORDER BY created_at DESC";
            $result = $this->_conn->MySQLi()->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch( Exception $e) {
            error_log('Lỗi khi lấy danh s: ' . $e->getMessage());
            return false;
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


    public function searchUser($data)
    {
        try {
            if (empty($data)) {
                $sql = "SELECT * FROM USERS";
                $conn = $this->_conn->MySQLi();
                $result = $conn->query($sql);
                return $result->fetch_all(MYSQLI_ASSOC);
            } else {
                if (is_numeric($data) && (string)$data[0] != 0 ) {
                    $sql = "SELECT * FROM users 
                            WHERE users.id = ?";
                    $conn = $this->_conn->MySQLi();
                    $stmt = $conn->prepare($sql);

                    $stmt->bind_param('i', $data);
                    if ($stmt->execute()) {
                        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
                        return $result;
                    } else {
                        return false;
                    };
                } else {
                    $sql = "SELECT * FROM users 
                WHERE users.id = ?
                   OR users.firstname LIKE ?
                   OR users.lastname LIKE ?
                   OR users.email LIKE ?
                   OR users.phone LIKE ?";
                    $conn = $this->_conn->MySQLi();
                    $stmt = $conn->prepare($sql);

                    $data = '%' . $data . '%';
                    $stmt->bind_param('issss', $data, $data, $data, $data, $data);
                    if ($stmt->execute()) {
                        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
                        return $result;
                    } else {
                        return false;
                    };
                }
            }
        } catch (Exception $e) {
            error_log('Lỗi khi search user: ' . $e->getMessage());
            return false;
        }
    }

    public function updateUser($id, $data) {
        return $this->update($id, $data);
    }

    public function deleteUser($id) {
        return $this->delete($id);
    }


}

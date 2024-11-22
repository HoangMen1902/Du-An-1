<?php

namespace Src\Models\Admin;

use Exception;
use Src\Models\BaseModel;

class CategoryValueModel extends BaseModel
{
    protected $table = 'category_values';

    protected $id = 'id';

    public function getAllCategoryValue()
    {
        return $this->getAll();
    }
    public function getOneCategoryValue($id)
    {
        return $this->getOne($id);
    }

    public function createCategoryValue($data)
    {
        return $this->create($data);
    }

    public function updateCategoryValue($id, $data)
    {
        try {
            $sql = "UPDATE $this->table SET name = ?, category_id = ?, status = ? WHERE id = ?";
            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);

            $stmt->bind_param('siii', $data['name'], $data['category_id'], $data['status'], $id);

            return $stmt->execute();
        } catch (\Throwable $th) {
            error_log('Lỗi khi cập nhật danh mục con: ' . $th->getMessage());
            return false;
        }
    }



    public function getCategoryValuesWithParent($id)
    {
        $sql = "
            SELECT category_values.*, categories.name AS category_name 
            FROM category_values
            JOIN categories ON category_values.category_id = categories.id 
            WHERE category_values.category_id = ?;
        ";

        $conn = $this->_conn->MySQLi();
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }


    public function deleteCategoryValue($id)
    {
        return $this->delete($id);
    }

    public function isNameDuplicate($name)
    {
        return $this->findDuplicateByColumn('name', $name);
    }

    public function getChildCategories()
    {
        if (isset($_POST['category_id'])) {
            $categoryId = $_POST['category_id'];

            if (is_array($categoryId) && isset($categoryId['id'])) {
                $categoryId = $categoryId['id'];
            }

            if (is_numeric($categoryId)) {
                $query = "SELECT id, name FROM $this->table
                WHERE category_id = ? AND status = 1";
                $conn = $this->_conn->MySQLi();
                $stmt = $conn->prepare($query);
                $stmt->bind_param('i', $categoryId);
                $stmt->execute();
                $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

                header('Content-Type: application/json');
                echo json_encode($result);
            } else {
                echo json_encode(['error' => 'Invalid category ID']);
            }
        } else {
            echo json_encode(['error' => 'Category ID is missing']);
        }
    }

    public function getChildCategoriesWithParentId($id)
    {
        try {
            $query = "SELECT id, name FROM $this->table
            WHERE category_id = ? AND status = 1";
            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($query);
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

            return $result;
        } catch (Exception $e) {
            error_log('Lỗi: ' . $e->getMessage());
            return false;
        }
    }
}

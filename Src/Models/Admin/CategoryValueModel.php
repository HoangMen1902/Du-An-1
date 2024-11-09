<?php

namespace Src\Models\Admin;

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



    public function getCategoryValuesWithParent()
    {
        $sql = "
            SELECT category_values.*, categories.name AS category_name
            FROM category_values
            INNER JOIN categories ON category_values.category_id = categories.id
        ";

        $result = $this->_conn->MySQLi()->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function deleteCategoryValue( $id)
    {
        return $this->delete($id);
    }

    public function isNameDuplicate($name)
    {
        return $this->findDuplicateByColumn('name', $name);
    }
}

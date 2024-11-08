<?php

namespace Src\Models\Admin;

use Src\Models\BaseModel;


class CategoryModel extends BaseModel
{

    protected $table = 'categories';

    protected $id;

    public function getAllCategory()
    {
        return $this->getAll();
    }
    public function getOneCategory($id)
    {
        return $this->getOne($id);
    }
    
    public function createCategory($data)
    {
        return $this->create($data);
    }

    public function isNameDuplicate($name)
    {
        return $this->findDuplicateByColumn('name', $name);
    }

    public function getCategoryValues()
    {
        try {
            $sql = "SELECT category_values.id, categories.name AS parent_name, category_values.name AS sub_name, category_values.status 
                    FROM category_values 
                    JOIN categories ON category_values.category_id = categories.id";

            $result = $this->_conn->MySQLi()->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi lấy dữ liệu từ bảng category_values: ' . $th->getMessage());
            return [];
        }
    }
}

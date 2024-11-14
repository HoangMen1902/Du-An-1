<?php
namespace Src\Models\Admin;

use Src\Models\BaseModel;

class ProductModel extends BaseModel {
    protected $table = "products";
    protected $id = "id";

    public function getAllProduct(){
        return $this->getAll();
    }

    public function getOneProduct($id){
        $id = (int) $id;
        return $this->getOne($id);
    }

    public function createProduct($data){
        return $this->create($data);
    }

    public function updateProduct($id, $data){
        return $this->update($id , $data);
    }

    public function deleteProduct($id){
        return $this->delete($id);
    }

    public function isNameDupliProductByColumn($name)
    {
        return $this->findDuplicateByColumn('name', $name);
    }


    public function createReturnProductId($data) {
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
?>

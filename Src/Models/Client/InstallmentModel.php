<?php

namespace Src\Models\Client;

use Exception;
use Src\Models\BaseModel;


class InstallmentModel extends BaseModel
{
    protected $table = 'installments';
    protected $id = 'id';


    public function getAllInstallment()
    {
        return $this->getAll();
    }
    public function getInstallmentBySku($sku_ids)
    {
        $result = [];
        try {
            if (is_array($sku_ids) && !empty($sku_ids)) {
                $placeholders = implode(',', array_fill(0, count($sku_ids), '?'));

                $sql = "SELECT * FROM $this->table WHERE sku_id IN ($placeholders)";
                $conn = $this->_conn->MySQLi();
                $stmt = $conn->prepare($sql);

                $types = str_repeat('i', count($sku_ids));
                $stmt->bind_param($types, ...$sku_ids); 

                $stmt->execute();
                $res = $stmt->get_result();

                while ($row = $res->fetch_assoc()) {
                    $result[] = $row;
                }
            }
        } catch (\Throwable $th) {
            error_log('Lỗi khi truy vấn theo sku_ids: ' . $th->getMessage());
        }
        return $result;
    }



    public function getOneInstallment($id)
    {
        return $this->getOne($id);
    }


    public function createInstallment($data)
    {
        return $this->create($data);
    }
    public function updateInstallment($data, $id)
    {
        return $this->update($data, $id);
    }
    public function deleteInstallment(int $id)
    {
        return $this->delete($id);
    }
}

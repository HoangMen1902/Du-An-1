<?php

namespace Src\Models\Client;

use Src\Models\BaseModel;

class SearchModel extends BaseModel

{

    public function search($keyword)
    {
        try {
            $sql = "SELECT * FROM products WHERE name LIKE ?";
            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);
            $searchTerm = "%" . $keyword . "%";
            $stmt->bind_param("s", $searchTerm);
            $stmt->execute();
            $result = $stmt->get_result();
            $data = $result->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
    
            return $data;
        } catch (\Throwable $th) {
            error_log('Lỗi khi tìm kiếm sản phẩm: ' . $th->getMessage());
            return [];
        }
    }
    
}

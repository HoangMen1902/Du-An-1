<?php

namespace Src\Models\Client;

use Src\Models\BaseModel;

class ProductSkusModel extends BaseModel
{

    public function decreaseStock(int $skuId, int $quantity)
{
    try {
        $sql = "UPDATE product_skus SET quantity = quantity - ? WHERE id = ? AND quantity >= ?";
        $conn = $this->_conn->MySQLi();
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            throw new \Exception("Không thể chuẩn bị câu lệnh: " . $conn->error);
        }

        $stmt->bind_param('iii', $quantity, $skuId, $quantity);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            return true;
        }

        throw new \Exception("Không thể giảm số lượng sản phẩm: SKU ID: $skuId, Quantity: $quantity");
    } catch (\Throwable $th) {
        error_log('Lỗi khi giảm số lượng sản phẩm: ' . $th->getMessage());
        return false;
    }
}

}

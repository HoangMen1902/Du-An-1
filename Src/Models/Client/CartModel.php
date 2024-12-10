<?php

namespace Src\Models\Client;

use Exception;
use Src\Models\BaseModel;


class CartModel extends BaseModel
{

    protected $table = 'Carts';

    protected $id = 'id';
    public function getAllCart()
    {
        return $this->getAll();
    }
    public function getCartByUser($user_id)
    {
        try {
            $sql = "SELECT Carts.id AS cart_id, Carts.sku_id, Product_skus.price - (Product_skus.price * Products.discount / 100) AS discounted_price,
                    Products.name AS product_name, Products.description  AS product_description, Products.short_description AS short_description , Users.email AS user_email, Product_skus.sku AS product_sku, 
                    Product_skus.price AS product_price, Product_skus.images  AS product_images, 
                    Carts.quantity AS quantity, ((Product_skus.price - (Product_skus.price * Products.discount / 100)) * Carts.quantity) AS total_price 
                    FROM Carts 
                    JOIN Users ON Carts.user_id = Users.id 
                    JOIN Product_skus ON Carts.sku_id = Product_skus.id 
                    JOIN Products ON Product_skus.product_id = Products.id
                    WHERE Carts.user_id = ?";

            $conn = $this->_conn->MySQLi();

            $stmt = $conn->prepare($sql);

            $stmt->bind_param("i", $user_id);

            $stmt->execute();

            $result = $stmt->get_result();

            $results = $result->fetch_all(MYSQLI_ASSOC);

            return $results;
        } catch (\Throwable $th) {
            error_log('Lỗi khi lấy giỏ hàng: ' . $th->getMessage());
            return false;
        }
    }


    public function getOneCart($id)
    {
        return $this->getOne($id);
    }

    public function createCart($data)
    {
        return $this->create($data);
    }

    public function updateCart($id, $data)
    {
        return $this->update($id, $data);
    }
    public function deleteCart($id)
    {
        return $this->delete($id);
    }

    public function findExistedSkuInCart($user_id, $sku_id) {
        try {
            $sql = "SELECT * FROM $this->table WHERE user_id = ? AND sku_id = ?";
            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ii', $user_id, $sku_id);
            $stmt->execute();
            return $stmt->get_result()->fetch_assoc();
        } catch (Exception $e) {
            error_log('Loi khi tim cart' . $e->getMessage() . $sql);
            return false;
        }
    }

    public function deleteAllCarts($userId)
    {
        try {
            $sql = "DELETE FROM $this->table WHERE user_id = ?";
            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('i', $userId);
            $result = $stmt->execute();
            return $result;
        } catch (Exception $e) {
            error_log('Loi khi delete all cart');
            return false;
        }
    }


}

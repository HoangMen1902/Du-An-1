<?php

namespace Src\Models\Client;

use Src\Models\BaseModel;
use Throwable;
use Exception;

class OrderModel extends BaseModel
{

    protected $table = 'orders';
    protected $id = 'id';

    public function createOrderReturnId($data)
    {
        return $this->createReturnId($data);
    }
    public function getAllOrdersByUser($userId)
    {
        try {
            $sql = "SELECT 
                    o.id AS order_id, 
                    o.total_price AS order_price, 
                    o.status AS order_status, 
                    ca.phone, 
                    ca.address, 
                    GROUP_CONCAT(CONCAT_WS('|', p.name, ps.images, od.quantity) SEPARATOR ';') AS products, 
                    MAX(c.name) AS category_name
                FROM orders o
                JOIN checkout_addresses ca ON o.address_id = ca.id
                JOIN order_details od ON o.id = od.order_id
                JOIN product_skus ps ON od.sku_id = ps.id
                JOIN products p ON ps.product_id = p.id
                JOIN product_categories pc ON p.id = pc.product_id
                JOIN category_values cv ON pc.category_values_id = cv.id
                JOIN categories c ON cv.category_id = c.id
                WHERE o.user_id = ?  
                GROUP BY o.id 
                ORDER BY o.created_at DESC
                LIMIT 0, 25;";

            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('i', $userId);
            $stmt->execute();
            $result = $stmt->get_result();

            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (Throwable $th) {
            error_log('Lỗi khi lấy dữ liệu: ' . $th->getMessage());
            return [];
        }
    }



    public function getAllOrderByUserAndOrderId($orderId, $userId)
    {
        try {
            $sql = "SELECT o.*, 
                       p.name AS product_name, 
                       p.thumbnail AS image_name, 
                       o.total_price AS order_price, 
                       od.quantity,
                       ca.phone,
                       ca.address,
                       o.status AS order_status, 
                       c.name AS category_name
                FROM orders o
                JOIN checkout_addresses ca ON o.address_id = ca.id
                JOIN order_details od ON o.id = od.order_id
                JOIN product_skus ps ON od.sku_id = ps.id
                JOIN products p ON ps.product_id = p.id
                JOIN product_categories pc ON p.id = pc.product_id
                JOIN category_values cv ON pc.category_values_id = cv.id
                JOIN categories c ON cv.category_id = c.id
                WHERE o.user_id = ? AND o.id = ?";

            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);

            if (!$stmt) {
                throw new Exception("Failed to prepare statement: " . $conn->error);
            }

            $stmt->bind_param('ii', $userId, $orderId);

            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                return $result->fetch_all(MYSQLI_ASSOC);
            } else {
                return [];
            }
        } catch (Throwable $e) {
            error_log('Error fetching order data for user ' . $userId . ': ' . $e->getMessage());
            return false;
        }
    }


    public function getOneOrderByOrderId($orderId)
    {
        try {
            $sql = "SELECT o.*, 
                        o.id AS order_id,
                       p.name AS product_name, 
                       p.thumbnail AS image_name, 
                       o.total_price AS order_price, 
                       od.quantity,
                       ca.phone,
                       ca.address,
                       o.status AS order_status, 
                       c.name AS category_name
                FROM orders o
                JOIN checkout_addresses ca ON o.address_id = ca.id
                JOIN order_details od ON o.id = od.order_id
                JOIN product_skus ps ON od.sku_id = ps.id
                JOIN products p ON ps.product_id = p.id
                JOIN product_categories pc ON p.id = pc.product_id
                JOIN category_values cv ON pc.category_values_id = cv.id
                JOIN categories c ON cv.category_id = c.id
                WHERE o.id = ?";

            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);
            error_log($sql);

            if (!$stmt) {
                throw new Exception("Failed to prepare statement: " . $conn->error);
            }

            $stmt->bind_param('i', $orderId);

            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                return $result->fetch_assoc();
            } else {
                return [];
            }
        } catch (Throwable $e) {
            error_log('Error fetching order data ' . $e->getMessage());
            return false;
        }
    }



    public function cancelOrder($id)
    {
        try {
            $conn = $this->_conn->MySQLi();
            $conn->begin_transaction();


            $sqlUpdateOrder = "UPDATE $this->table SET status = 6 WHERE id = ?";
            $stmtUpdateOrder = $conn->prepare($sqlUpdateOrder);
            $stmtUpdateOrder->bind_param('i', $id);
            $stmtUpdateOrder->execute();

            error_log('Updated order status affected rows: ' . $stmtUpdateOrder->affected_rows);

            if ($stmtUpdateOrder->affected_rows === 0) {
                throw new Exception("Không tìm thấy đơn hàng hoặc không thể cập nhật trạng thái.");
            }


            $sqlGetOrderDetails = "SELECT sku_id, quantity FROM order_details WHERE order_id = ?";
            $stmtGetOrderDetails = $conn->prepare($sqlGetOrderDetails);
            $stmtGetOrderDetails->bind_param('i', $id);
            $stmtGetOrderDetails->execute();
            $result = $stmtGetOrderDetails->get_result();
            $orderDetails = $result->fetch_all(MYSQLI_ASSOC);

            if (empty($orderDetails)) {
                throw new Exception("Không tìm thấy chi tiết đơn hàng.");
            }


            error_log('Order details: ' . print_r($orderDetails, true));


            $sqlUpdateQuantity = "UPDATE product_skus SET quantity = quantity + ? WHERE id = ?";
            $stmtUpdateQuantity = $conn->prepare($sqlUpdateQuantity);

            foreach ($orderDetails as $item) {
                $stmtUpdateQuantity->bind_param('ii', $item['quantity'], $item['sku_id']);
                $stmtUpdateQuantity->execute();


                error_log("Updated SKU quantity affected rows for SKU {$item['sku_id']}: " . $stmtUpdateQuantity->affected_rows);

                if ($stmtUpdateQuantity->affected_rows === 0) {
                    throw new Exception("Không thể cập nhật số lượng sản phẩm cho SKU: {$item['sku_id']}");
                }
            }


            $conn->commit();
            return true;
        } catch (Throwable $th) {
            if (isset($conn)) {
                $conn->rollback();
            }
            error_log('Lỗi khi hủy đơn hàng: ' . $th->getMessage());
            return false;
        }
    }

    public function getOneOrder($id)
    {
        return $this->getOne($id);
    }
    public function updateOrder($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteOrder($id)
    {
        return $this->deleteOrder($id);
    }

    public function getOrdersByAddressId($addressId)
    {
    $sql = "SELECT * FROM orders WHERE address_id = ?";
    
    $conn = $this->_conn->MySQLi();
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        throw new Exception("Lỗi chuẩn bị câu lệnh: " . $conn->error);
    }
    $stmt->bind_param("i", $addressId);
    if (!$stmt->execute()) {
        throw new Exception("Lỗi thực thi câu lệnh: " . $stmt->error);
    }
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
    }



    public function getOneOrdersAllDetails($orderId, $userId)
    {
        try {
            $sql = "SELECT 
            ps.id AS sku_id,
            ps.sku AS sku_code,
            ps.images AS sku_images,
            p.name AS product_name,
            od.price AS sku_price,
            od.quantity AS sku_quantity,
            o.id AS order_id,
            o.total_price,
            o.status AS order_status,
            ca.phone AS customer_phone,
            ca.address AS customer_address,
            u.fullname AS customer_name,
            c.name AS category_name,
            cv.name AS category_value_name,
            o.created_at AS order_date,
            GROUP_CONCAT(DISTINCT op.name ORDER BY op.name SEPARATOR ', ') AS option_names,
            GROUP_CONCAT(DISTINCT ov.value_name ORDER BY ov.value_name SEPARATOR ', ') AS option_values
        FROM orders o
        JOIN checkout_addresses ca ON o.address_id = ca.id
        JOIN users u ON ca.user_id = u.id
        JOIN order_details od ON o.id = od.order_id
        JOIN product_skus ps ON od.sku_id = ps.id
        JOIN products p ON ps.product_id = p.id
        JOIN product_categories pc ON p.id = pc.product_id
        JOIN category_values cv ON pc.category_values_id = cv.id
        JOIN categories c ON cv.category_id = c.id
        JOIN sku_values sv ON sv.sku_id = ps.id
        JOIN option_values ov ON ov.id = sv.value_id
        JOIN options op ON op.id = sv.option_id
        WHERE o.id = ? AND o.user_id = ?
        GROUP BY ps.id, od.price, od.quantity, o.id, o.total_price, o.status, ca.phone, ca.address, u.fullname, c.name, cv.name, o.created_at;
        ";
            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);

            if (!$stmt) {
                throw new Exception("Failed to prepare SQL statement: " . $conn->error);
            }

            $stmt->bind_param('ii', $orderId, $userId);

            $stmt->execute();
            $result = $stmt->get_result();
            $order = $result->fetch_all(MYSQLI_ASSOC);
            if (!$order) {
                throw new Exception("No order found for ID: " . $orderId);
            }

            return $order;
        } catch (Exception $e) {
            error_log('Error in getOneOrders: ' . $e->getMessage());
            return false;
        }
    }
}

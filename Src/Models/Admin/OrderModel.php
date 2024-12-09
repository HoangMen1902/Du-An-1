<?php

namespace Src\Models\Admin;

use Src\Models\BaseModel;
use Throwable;
use Exception;

class OrderModel extends BaseModel
{

    protected $table = 'orders';
    protected $id = 'id';

    public function getAllOrders()
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
            GROUP BY o.id 
            ORDER BY o.created_at DESC
            LIMIT 0, 25;";
            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (Throwable $th) {
            error_log('Lỗi khi lấy dữ liệu: ' . $th->getMessage());
            return [];
        }
    }
    public function getOneOrders($orderId)
    {
        try {
            $sql = "SELECT 
                o.id AS order_id,
                o.total_price, 
                od.price,
                o.status AS order_status, 
                p.name AS product_name, 
                ps.sku AS sku_code,
                ps.images AS sku_images,  
                od.quantity AS product_quantity, 
                ca.phone AS customer_phone, 
                ca.address AS customer_address, 
                u.fullname AS customer_name,
                c.name AS category_name, 
                cv.name AS category_value_name,
                o.created_at AS order_date
                FROM orders o
                JOIN checkout_addresses ca ON o.address_id = ca.id
                JOIN users u ON ca.user_id = u.id
                JOIN order_details od ON o.id = od.order_id
                JOIN product_skus ps ON od.sku_id = ps.id
                JOIN products p ON ps.product_id = p.id
                JOIN product_categories pc ON p.id = pc.product_id
                JOIN category_values cv ON pc.category_values_id = cv.id
                JOIN categories c ON cv.category_id = c.id
                WHERE o.id = ?";

            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);

            if (!$stmt) {
                throw new Exception("Failed to prepare SQL statement: " . $conn->error);
            }

            $stmt->bind_param('i', $orderId);

            $stmt->execute();
            $result = $stmt->get_result();
            $orderDetails = $result->fetch_all(MYSQLI_ASSOC);

            if (empty($orderDetails)) {
                throw new Exception("No order found for ID: " . $orderId);
            }


            $order = [
                'order_id' => $orderDetails[0]['order_id'],
                'total_price' => $orderDetails[0]['total_price'],
                'price' => $orderDetails[0]['price'],
                'order_status' => $orderDetails[0]['order_status'],
                'customer_name' => $orderDetails[0]['customer_name'],
                'customer_phone' => $orderDetails[0]['customer_phone'],
                'customer_address' => $orderDetails[0]['customer_address'],
                'order_date' => $orderDetails[0]['order_date'],
                'products' => [],
            ];

            foreach ($orderDetails as $detail) {
                $order['products'][] = [
                    'product_name' => $detail['product_name'],
                    'sku_code' => $detail['sku_code'],
                    'sku_images' => $detail['sku_images'],
                    'product_quantity' => $detail['product_quantity'],
                    'category_name' => $detail['category_name'],
                    'category_value_name' => $detail['category_value_name'],
                    'price' => $detail['price'],  
                ];
            }
            

            return $order;
        } catch (Exception $e) {
            error_log('Error in getOneOrders: ' . $e->getMessage());
            return false;
        }
    }



    public function getOneOrdersAllDetails($orderId)
    {
        try {
            $sql = "SELECT 
                ps.id AS sku_id,
                o.id AS order_id,
                o.total_price,
                od.quantity AS sku_quantity,
                od.price AS sku_price,
                o.status AS order_status, 
                p.name AS product_name, 
                ps.sku AS sku_code,
                ps.images AS sku_images,  
                od.quantity AS product_quantity, 
                ca.phone AS customer_phone, 
                ca.address AS customer_address, 
                u.fullname AS customer_name,
                c.name AS category_name, 
                cv.name AS category_value_name,
                o.created_at AS order_date,
                op.name AS option_name,
                ov.value_name AS option_value
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
                WHERE o.id = ?";
            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);

            if (!$stmt) {
                throw new Exception("Failed to prepare SQL statement: " . $conn->error);
            }

            $stmt->bind_param('i', $orderId);

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
    public function searchOrder($data)
    {
        try {
            if (empty($data)) {
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
            GROUP BY o.id 
            ORDER BY o.created_at DESC
            LIMIT 0, 25;";
                $conn = $this->_conn->MySQLi();
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $result = $stmt->get_result();
                return $result->fetch_all(MYSQLI_ASSOC);
            } else {
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
            WHERE ca.phone LIKE ? 
            GROUP BY o.id 
            ORDER BY o.created_at DESC
            LIMIT 0, 25;";
                $conn = $this->_conn->MySQLi();
                $stmt = $conn->prepare($sql);

                $data = '%' . $data . '%'; 
                $stmt->bind_param('s', $data);  
                if ($stmt->execute()) {
                    $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
                    return $result;
                } else {
                    return [];
                }
            }
        } catch (Exception $e) {
            error_log('Lỗi khi tìm kiếm đơn hàng: ' . $e->getMessage());
            return [];
        }
    }
    public function updateOrder($id, $data)
    {
        error_log("Cập nhật order ID: $id, Dữ liệu: " . print_r($data, true));
    
        return $this->update($id, $data);
    }
    
}

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
            $sql = "SELECT o.*, 
                        p.name AS product_name, 
                        p.thumbnail AS image_name, 
                        o.total_price AS order_price, 
                        od.quantity,
                        ca.phone,
                        ca.address,
                        o.status AS order_status, 
                        c.name AS category_name
                    FROM $this->table o
                    JOIN checkout_addresses ca ON o.address_id = ca.id
                    JOIN order_details od ON o.id = od.order_id
                    JOIN product_skus ps ON od.sku_id = ps.id
                    JOIN products p ON ps.product_id = p.id
                    JOIN product_categories pc ON p.id = pc.product_id
                    JOIN category_values cv ON pc.category_values_id = cv.id
                    JOIN categories c ON cv.category_id = c.id";
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
            $order = $result->fetch_assoc();
            if (!$order) {
                throw new Exception("No order found for ID: " . $orderId);
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
}

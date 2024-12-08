<?php

namespace Src\Models\Admin;

use Src\Models\BaseModel;

class AnalyticModel extends BaseModel
{

    protected $id = 'id';

    public function countProduct()
    {
        $result = [];
        try {
            $sql = "SELECT COUNT(*) AS product FROM products";
            $result = $this->_conn->MySQLi()->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị tất cả dữ liệu: ' . $th->getMessage());
            return $result;
        }
    }
    public function countUser()
    {
        $result = [];
        try {
            $sql = "SELECT COUNT(*) AS user FROM users";
            $result = $this->_conn->MySQLi()->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị tất cả dữ liệu: ' . $th->getMessage());
            return $result;
        }
    }
    public function countCategoryParent()
    {
        $result = [];
        try {
            $sql = "SELECT COUNT(*) AS categoryParent FROM category_values";
            $result = $this->_conn->MySQLi()->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị tất cả dữ liệu: ' . $th->getMessage());
            return $result;
        }
    }
    public function countCategory()
    {
        $result = [];
        try {
            $sql = "SELECT COUNT(*) AS category FROM categories";
            $result = $this->_conn->MySQLi()->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị tất cả dữ liệu: ' . $th->getMessage());
            return $result;
        }
    }
    public function countComment()
    {
        $result = [];
        try {
            $sql = "SELECT COUNT(*) AS comment FROM comments";
            $result = $this->_conn->MySQLi()->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị tất cả dữ liệu: ' . $th->getMessage());
            return $result;
        }
    }
    public function countRating()
    {
        $result = [];
        try {
            $sql = "SELECT COUNT(*) AS rating FROM ratings";
            $result = $this->_conn->MySQLi()->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị tất cả dữ liệu: ' . $th->getMessage());
            return $result;
        }
    }
    public function countBrand()
    {
        $result = [];
        try {
            $sql = "SELECT COUNT(*) AS brand FROM brands";
            $result = $this->_conn->MySQLi()->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị tất cả dữ liệu: ' . $th->getMessage());
            return $result;
        }
    }
    public function countOrder()
    {
        $result = [];
        try {
            $sql = "SELECT COUNT(*) AS 'order' FROM orders";
            $result = $this->_conn->MySQLi()->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị tất cả dữ liệu: ' . $th->getMessage());
            return $result;
        }
    }

    public function anaLyticProductByDay()
    {
        $result = [];
        try {

            $sql = "SELECT 
                p.id AS product_id,
                p.name AS product_name,
                SUM(od.quantity) AS total_sold,
                DATE(o.created_at) AS sold_date
                FROM products p
                JOIN product_skus ps ON p.id = ps.product_id
                JOIN order_details od ON ps.id = od.sku_id
                JOIN orders o ON o.id = od.order_id
                WHERE o.status = '5'
                AND DATE(o.created_at) = CURDATE()  
                GROUP BY p.id, p.name, sold_date
                ORDER BY total_sold DESC
                LIMIT 5;";
            $result = $this->_conn->MySQLi()->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị dữ liệu theo ngày: ' . $th->getMessage());
            return $result;
        }
    }

    public function anaLyticProductByMonth()
    {
        $result = [];
        try {
            $sql = "SELECT 
                p.id AS product_id,
                p.name AS product_name,
                SUM(od.quantity) AS total_sold,
                YEAR(o.created_at) AS sold_year,
                MONTH(o.created_at) AS sold_month
                FROM products p
                JOIN product_skus ps ON p.id = ps.product_id
                JOIN order_details od ON ps.id = od.sku_id
                JOIN orders o ON o.id = od.order_id
                WHERE o.status = '5'
                AND YEAR(o.created_at) = YEAR(CURDATE())  
                AND MONTH(o.created_at) = MONTH(CURDATE()) 
                GROUP BY p.id, p.name, sold_year, sold_month
                ORDER BY total_sold DESC
                LIMIT 5;";
            $result = $this->_conn->MySQLi()->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị dữ liệu theo tháng: ' . $th->getMessage());
            return $result;
        }
    }


    public function anaLyticProductByYear()
    {
        $result = [];
        try {

            $sql = "SELECT 
                p.id AS product_id,
                p.name AS product_name,
                SUM(od.quantity) AS total_sold,
                YEAR(o.created_at) AS sold_year
                FROM products p
                JOIN product_skus ps ON p.id = ps.product_id
                JOIN order_details od ON ps.id = od.sku_id
                JOIN orders o ON o.id = od.order_id
                WHERE o.status = '5'
                AND YEAR(o.created_at) = YEAR(CURDATE())  
                GROUP BY p.id, p.name, sold_year
                ORDER BY total_sold DESC
                LIMIT 5;";
            $result = $this->_conn->MySQLi()->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị dữ liệu theo năm: ' . $th->getMessage());
            return $result;
        }
    }
    public function anaLyticRevenueByDay()
    {
        $result = [];
        try {

            $sql = "SELECT DATE(o.created_at) AS order_date, SUM(od.quantity * od.price) AS daily_revenue
                    FROM products p
                    JOIN product_skus ps ON p.id = ps.product_id
                    JOIN order_details od ON ps.id = od.sku_id
                    JOIN orders o ON o.id = od.order_id
                    WHERE o.status = 5 AND DATE(o.created_at) >= CURDATE() - INTERVAL 6 DAY
                    GROUP BY DATE(o.created_at)
                    ORDER BY DATE(o.created_at) ASC";
            $result = $this->_conn->MySQLi()->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị dữ liệu theo năm: ' . $th->getMessage());
            return $result;
        }
    }
    public function anaLyticRevenueByMonth()
    {
        $result = [];
        try {

            $sql = "SELECT DATE_FORMAT(o.created_at, '%Y-%m') AS order_month, SUM(od.quantity * od.price) AS monthly_revenue
                    FROM products p
                    JOIN product_skus ps ON p.id = ps.product_id
                    JOIN order_details od ON ps.id = od.sku_id
                    JOIN orders o ON o.id = od.order_id
                    WHERE o.status = 5 AND YEAR(o.created_at) = YEAR(CURDATE())
                    GROUP BY DATE_FORMAT(o.created_at, '%Y-%m')
                    ORDER BY DATE_FORMAT(o.created_at, '%Y-%m') ASC";
            $result = $this->_conn->MySQLi()->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị dữ liệu theo năm: ' . $th->getMessage());
            return $result;
        }
    }
    public function anaLyticRevenueByYear()
    {
        $result = [];
        try {

            $sql = "SELECT YEAR(o.created_at) AS order_year, SUM(od.quantity * od.price) AS yearly_revenue
            FROM products p
            JOIN product_skus ps ON p.id = ps.product_id
            JOIN order_details od ON ps.id = od.sku_id
            JOIN orders o ON o.id = od.order_id
            WHERE o.status = 5 AND YEAR(o.created_at) >= YEAR(CURDATE()) - 4
            GROUP BY YEAR(o.created_at)
            ORDER BY YEAR(o.created_at) ASC;";
            $result = $this->_conn->MySQLi()->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị dữ liệu theo năm: ' . $th->getMessage());
            return $result;
        }
    }

    public function anaLyticRevenueBySpecificDate($date)
{
    $result = [];
    try {
        $sql = "SELECT DATE(o.created_at) AS order_date, SUM(od.quantity * od.price) AS daily_revenue
                FROM products p
                JOIN product_skus ps ON p.id = ps.product_id
                JOIN order_details od ON ps.id = od.sku_id
                JOIN orders o ON o.id = od.order_id
                WHERE o.status = 5 
                AND DATE(o.created_at) BETWEEN DATE_SUB(?, INTERVAL 5 YEAR) AND ?
                GROUP BY DATE(o.created_at)";
        $stmt = $this->_conn->MySQLi()->prepare($sql);
        $stmt->bind_param('ss', $date, $date);  
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    } catch (\Throwable $th) {
        error_log('Lỗi khi hiển thị dữ liệu theo ngày: ' . $th->getMessage());
    }
    return $result;
}


}

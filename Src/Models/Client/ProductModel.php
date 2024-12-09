<?php

namespace Src\Models\Client;

use Exception;
use Src\Models\BaseModel;

class ProductModel extends BaseModel
{
    protected $table = "products";
    protected $id = "id";
    public function getAllProduct()
    {
        return $this->getAll();
    }
    public function getOneProduct($id)
    {
        $id = (int) $id;
        return $this->getOne($id);
    }

    public function getAllProductWithSkus()
    {
        $sql = "SELECT 
        p.id AS product_id, 
        p.name AS product_name,
        p.short_description AS short_description,
        p.description,
        p.thumbnail,
        p.discount,
        ps.id AS sku_id,
        ps.sku,
        ps.images,
        ps.price AS original_price,
        ps.price - (ps.price * p.discount / 100) AS discounted_price,
        ps.quantity,
        ov.value_name AS option_value,
        o.name AS option_name,
        c.id AS category_id,
        COALESCE(rating_data.avg_rating, 0) AS avg_rating,
        COALESCE(rating_data.total_reviews, 0) AS total_reviews
    FROM products AS p
    JOIN product_skus AS ps ON p.id = ps.product_id
    LEFT JOIN sku_values AS sv ON ps.id = sv.sku_id
    LEFT JOIN option_values AS ov ON sv.value_id = ov.id
    LEFT JOIN options AS o ON sv.option_id = o.id
    LEFT JOIN product_categories pc ON p.id = pc.product_id
    LEFT JOIN category_values cv ON pc.category_values_id = cv.id
    LEFT JOIN categories c ON cv.category_id = c.id 
    LEFT JOIN (
        SELECT 
            product_id, 
            AVG(rating) AS avg_rating, 
            COUNT(id) AS total_reviews
        FROM ratings
        WHERE status = 1
        GROUP BY product_id
    ) AS rating_data ON p.id = rating_data.product_id
    WHERE p.status = 1
    ORDER BY p.id, ps.id";

        $conn = $this->_conn->MySQLi();
        $result = $conn->query($sql);
        $products = [];

        while ($row = $result->fetch_assoc()) {
            $productId = $row['product_id'];
            $skuId = $row['sku_id'];

            if (!isset($products[$productId])) {
                $products[$productId] = [
                    'product_id' => $row['product_id'],
                    'product_name' => $row['product_name'],
                    'description' => $row['description'],
                    'short_description' => $row['short_description'],
                    'thumbnail' => $row['thumbnail'],
                    'discount' => $row['discount'],
                    'avg_rating' => $row['avg_rating'],
                    'total_reviews' => $row['total_reviews'],
                    'skus' => []
                ];
            }


            if (!isset($products[$productId]['skus'][$skuId])) {
                $products[$productId]['skus'][$skuId] = [
                    'sku_id' => $skuId,
                    'sku' => $row['sku'],
                    'images' => $row['images'],
                    'original_price' => $row['original_price'],
                    'discounted_price' => $row['discounted_price'],
                    'quantity' => $row['quantity'],
                    'category_id' => $row['category_id'] ?? null,
                    'options' => []
                ];
            }


            $products[$productId]['skus'][$skuId]['options'][] = [
                'option_name' => $row['option_name'],
                'option_value' => $row['option_value']
            ];
        }

        return $products;
    }


    public function getOneProductWithSkus($id)
    {
        $sql = "SELECT 
            p.id AS product_id, 
            p.name AS product_name,
            p.short_description AS short_description,
            p.description,
            p.thumbnail,
            p.discount,
            ps.id AS sku_id,
            ps.sku,
            ps.images,
            ps.price AS original_price,
            ps.price - (ps.price * p.discount / 100) AS discounted_price,
            ps.quantity,
            ov.value_name AS option_value,
            o.name AS option_name,
            c.id AS category_id,
            COALESCE(rating_data.avg_rating, 0) AS avg_rating,
            COALESCE(rating_data.total_reviews, 0) AS total_reviews
        FROM products AS p
        JOIN product_skus AS ps ON p.id = ps.product_id
        LEFT JOIN sku_values AS sv ON ps.id = sv.sku_id
        LEFT JOIN option_values AS ov ON sv.value_id = ov.id
        LEFT JOIN options AS o ON sv.option_id = o.id
        LEFT JOIN product_categories pc ON p.id = pc.product_id
        LEFT JOIN category_values cv ON pc.category_values_id = cv.id
        LEFT JOIN categories c ON cv.category_id = c.id 
        LEFT JOIN (
            SELECT 
                product_id, 
                AVG(rating) AS avg_rating, 
                COUNT(id) AS total_reviews
            FROM ratings
            WHERE status = 1
            GROUP BY product_id
        ) AS rating_data ON p.id = rating_data.product_id
        WHERE p.status = 1 AND p.id = ?";
    
        $conn = $this->_conn->MySQLi();
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $id); 
        $stmt->execute();
        $result = $stmt->get_result();
        $product = null;
    
        if ($row = $result->fetch_assoc()) {
            $productId = $row['product_id'];
            $skuId = $row['sku_id'];
    
            $product = [
                'product_id' => $row['product_id'],
                'product_name' => $row['product_name'],
                'description' => $row['description'],
                'short_description' => $row['short_description'],
                'thumbnail' => $row['thumbnail'],
                'discount' => $row['discount'],
                'avg_rating' => $row['avg_rating'],
                'total_reviews' => $row['total_reviews'],
                'skus' => []
            ];
    
            $product['skus'][$skuId] = [
                'sku_id' => $skuId,
                'sku' => $row['sku'],
                'images' => $row['images'],
                'original_price' => $row['original_price'],
                'discounted_price' => $row['discounted_price'],
                'quantity' => $row['quantity'],
                'category_id' => $row['category_id'] ?? null,
                'options' => []
            ];
    
            // Thêm tùy chọn (option)
            $product['skus'][$skuId]['options'][] = [
                'option_name' => $row['option_name'],
                'option_value' => $row['option_value']
            ];
        }
    
        return $product;
    }
    
    public function getProductById($productId)
    {
        $allProducts = $this->getAllProductWithSkus();
        if (isset($allProducts[$productId])) {
            return $allProducts[$productId];
        }
        return null;
    }
    public function getAllRandomProductWithSkus()
    {
        $sql = "SELECT 
                p.id AS product_id, 
                p.name AS product_name, 
                p.description,
                p.thumbnail,
                p.discount,
                ps.id AS sku_id,
                ps.sku,
                ps.images,
                ps.price AS original_price,
                ps.price - (ps.price * p.discount / 100) AS discounted_price,
                ps.quantity,
                ov.value_name AS option_value,
                o.name AS option_name
            FROM products AS p
            JOIN product_skus AS ps ON p.id = ps.product_id
            LEFT JOIN sku_values AS sv ON ps.id = sv.sku_id
            LEFT JOIN option_values AS ov ON sv.value_id = ov.id
            LEFT JOIN options AS o ON sv.option_id = o.id
       
            WHERE p.status = 1
            ORDER BY RAND() 
            LIMIT 10";

        $conn = $this->_conn->MySQLi();
        $result = $conn->query($sql);
        $products = [];

        while ($row = $result->fetch_assoc()) {
            $productId = $row['product_id'];
            $skuId = $row['sku_id'];

            if (!isset($products[$productId])) {
                $products[$productId] = [
                    'product_id' => $row['product_id'],
                    'product_name' => $row['product_name'],
                    'description' => $row['description'],
                    'thumbnail' => $row['thumbnail'],
                    'discount' => $row['discount'],
                    'skus' => []
                ];
            }

            $products[$productId]['skus'][$skuId]['sku_id'] = $skuId;
            $products[$productId]['skus'][$skuId]['sku'] = $row['sku'];
            $products[$productId]['skus'][$skuId]['images'] = $row['images'];
            $products[$productId]['skus'][$skuId]['original_price'] = $row['original_price'];
            $products[$productId]['skus'][$skuId]['discounted_price'] = $row['discounted_price'];
            $products[$productId]['skus'][$skuId]['quantity'] = $row['quantity'];
            $products[$productId]['skus'][$skuId]['options'][] = [
                'option_name' => $row['option_name'],
                'option_value' => $row['option_value']
            ];
        }
        return $products;
    }

    public function getRelatedProducts($productId, $categoryId, $limit = 4)
    {
        $sql = "SELECT 
                p.id AS product_id,
                p.name AS product_name,
                p.thumbnail,
                p.discount,
                MIN(ps.price) AS original_price,
                MIN(ps.price) - (MIN(ps.price) * p.discount / 100) AS discounted_price
                FROM products AS p
                JOIN product_skus AS ps ON p.id = ps.product_id
                JOIN product_categories pc ON p.id = pc.product_id
                JOIN category_values cv ON pc.category_values_id = cv.id
                JOIN categories c ON cv.category_id = c.id 
                WHERE 
                    c.id = ? 
                    AND p.id != ? 
                    AND p.status = 1
                GROUP BY p.id, p.name, p.thumbnail, p.discount
                ORDER BY RAND()
                LIMIT ?";
        $conn = $this->_conn->MySQLi();
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iii", $categoryId, $productId, $limit);
        $stmt->execute();
        $result = $stmt->get_result();

        $relatedProducts = [];
        while ($row = $result->fetch_assoc()) {
            $relatedProducts[] = [
                'product_id' => $row['product_id'],
                'product_name' => $row['product_name'],
                'thumbnail' => $row['thumbnail'],
                'discount' => $row['discount'],
                'original_price' => $row['original_price'],
                'discounted_price' => $row['discounted_price']
            ];
        }

        return $relatedProducts;
    }


    public function getProductSpecsAndDesc($productId)
    {
        try {
            $sql = "SELECT p.short_description, p.description, p.specifications FROM $this->table AS p WHERE id = ?";
            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('i', $productId);
            $stmt->execute();
            return $stmt->get_result()->fetch_assoc();
        } catch (Exception $e) {
            error_log('Lỗi: ' .  $e->getMessage() . $sql);
            return false;
        }
    }

    public function filterProduct()
    {
        $inStock = $_GET['in_stock'] ?? null;
        $CategoryId = $_GET['child_category'] ?? null;
        $brandId = $_GET['brand'] ?? null;
        $minPrice = $_GET['min_price'] ?? null;
        $maxPrice = $_GET['max_price'] ?? null;
        $isNewest = $_GET['newest'] ?? null;


        $sql = "SELECT 
            p.id AS product_id, 
            p.name AS product_name, 
            p.short_description as description,
            p.thumbnail,
            p.discount,
            ps.id AS sku_id,
            ps.sku,
            ps.images,
            ps.price AS original_price,
            ps.price - (ps.price * p.discount / 100) AS discounted_price,
            ps.quantity,
            ov.value_name AS option_value,
            o.name AS option_name
        FROM products AS p
        LEFT JOIN product_skus AS ps ON p.id = ps.product_id
        LEFT JOIN sku_values AS sv ON ps.id = sv.sku_id
        LEFT JOIN option_values AS ov ON sv.value_id = ov.id
        LEFT JOIN options AS o ON sv.option_id = o.id
        LEFT JOIN product_categories AS pc ON p.id = pc.product_id
        LEFT JOIN brands AS b ON p.brand_id = b.id
        WHERE p.status = 1";

        if (!empty($CategoryId)) {
            $sql .= " AND pc.category_values_id = " . (int)$CategoryId;
        }

        if (!empty($brandId)) {
            $sql .= " AND p.brand_id = " . (int)$brandId;
        }

        if (!empty($inStock)) {
            $sql .= " AND p.total_quantity > 0";
        }

        if (!empty($minPrice)) {
            $sql .= " AND ps.price >= " . (int)$minPrice;
        }

        if (!empty($maxPrice)) {
            $sql .= " AND ps.price <= " . (int)$maxPrice;
        }
        if (!empty($isNewest)) {
            $sql .= " ORDER BY p.id DESC";
        }


        $conn = $this->_conn->MySQLi();
        $result = $conn->query($sql);

        $products = [];
        while ($row = $result->fetch_assoc()) {
            $productId = $row['product_id'];
            $skuId = $row['sku_id'];

            if (!isset($products[$productId])) {
                $products[$productId] = [
                    'product_id' => $row['product_id'],
                    'product_name' => $row['product_name'],
                    'description' => $row['description'],
                    'thumbnail' => $row['thumbnail'],
                    'discount' => $row['discount'],
                    'skus' => []
                ];
            }

            $products[$productId]['skus'][$skuId]['sku_id'] = $skuId;
            $products[$productId]['skus'][$skuId]['sku'] = $row['sku'];
            $products[$productId]['skus'][$skuId]['images'] = $row['images'];
            $products[$productId]['skus'][$skuId]['original_price'] = $row['original_price'];
            $products[$productId]['skus'][$skuId]['discounted_price'] = $row['discounted_price'];
            $products[$productId]['skus'][$skuId]['quantity'] = $row['quantity'];
            $products[$productId]['skus'][$skuId]['options'][] = [
                'option_name' => $row['option_name'],
                'option_value' => $row['option_value']
            ];
        }
        echo json_encode($products);
    }
}

<?php

namespace Src\Models\Client;

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
    public function getProductById($productId)
    {
        $allProducts = $this->getAllProductWithSkus();
        // echo '<pre>';
        // var_dump($allProducts);  
        if (isset($allProducts[$productId])) {
            return $allProducts[$productId];
        }
        return null;
    }

}

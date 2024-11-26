<?php

namespace Src\models\Client;

use Src\models\BaseModel;
use \DateTime;
use Exception;

class CommentModel extends BaseModel
{

    protected $table = 'comments';
    protected $id = 'id';
    public function getAllComment()
    {
        return $this->getAll();
    }
    public function getOneComment($id)
    {
        return $this->getOne($id);
    }
    public function createComment($data)
    {

        return $this->create($data);
    }

    public function allowRating($userId, $productId)
    {
       
         
            var_dump($userId, $productId);
    
            $sql = "SELECT COUNT(*) AS total 
                    FROM orders
                    JOIN order_details ON orders.id = order_details.order_id
                    JOIN product_skus ON order_details.sku_id = product_skus.id
                    WHERE orders.user_id = $userId
                      AND product_skus.product_id = $productId
                      AND orders.status = 5
                    GROUP BY product_skus.product_id";
    
           $result = $this->_conn->MySQLi()->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
      
    }
    






    public function getAllCommentByProductId($id)
    {
        $sql = "SELECT comments.*,concat(users.firstname, ' ' , users.lastname ) AS name, products.id as product_id  
        FROM $this->table 
        JOIN products on comments.product_id = products.id 
        JOIN users ON comments.user_id = users.id 
        where product_id = $id  AND comments.status = 1 AND parent_id IS null
        ORDER BY comments.created_at DESC";
        $result = $this->_conn->MySQLi()->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getAllCommentByParentId($id)
    {
        $sql = "SELECT comments.*,concat(users.firstname, ' ' , users.lastname ) AS name, products.id as product_id  
        FROM $this->table 
        JOIN products on comments.product_id = products.id 
        JOIN users ON comments.user_id = users.id 
        where product_id = $id  AND comments.status = 1 AND parent_id IS NOT NULL
        ORDER BY comments.created_at DESC";
        $result = $this->_conn->MySQLi()->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getTimeAgo($date)
    {
        try {
            date_default_timezone_set('Asia/Ho_Chi_Minh'); // Thiết lập múi giờ
    
            $currentDateTime = new DateTime();
            $commentDateTime = new DateTime($date);
            $interval = $currentDateTime->diff($commentDateTime);
            $timeAgo = '';
    
            if ($interval->y > 0) {
                $timeAgo = $interval->y . ' năm trước';
            } elseif ($interval->m > 0) {
                $timeAgo = $interval->m . ' tháng trước';
            } elseif ($interval->d > 0) {
                $timeAgo = $interval->d . ' ngày trước';
            } elseif ($interval->h > 0) {
                $timeAgo = $interval->h . ' giờ trước';
            } elseif ($interval->i > 0) {
                $timeAgo = $interval->i . ' phút trước';
            } else {
                $timeAgo = 'Vừa mới đây';
            }
        } catch (Exception $e) {
            $timeAgo = 'Không xác định';
        }
        return $timeAgo;
    }
    
    public function findDuplicateCommentsByColumn($column, $value)
    {
        return $this->findDuplicateByColumn($column, $value);
    }
    public function deleteComment(int $id)
    {
        return $this->delete($id);
    }

    public function updateComment(int $id, array $data)
    {

        return $this->update($id, $data);
    }
}
<?php

namespace Src\models\Client;

use Src\models\BaseModel;
use \DateTime;
use Exception;

class RatingModel extends BaseModel
{
    protected $table = 'ratings';
    protected $id = 'id';

  
    public function getAllRating()
    {
        return $this->getAll();
    }

  
    public function getOneRating($id)
    {
        return $this->getOne($id);
    }


    public function createRating($data)
    {
        return $this->create($data);
    }
    public function updateRating($data,$id){
        return $this->update($data,$id);
    }
    public function deleteRating(int $id)
    {
        return $this->delete($id);
    }


    public function getAllRatingByProductId($id)
    {
        $sql = "SELECT Ratings.*,concat(users.firstname, ' ' , users.lastname ) AS name, products.id as product_id  
        FROM $this->table 
        JOIN products on Ratings.product_id = products.id 
        JOIN users ON Ratings.user_id = users.id 
        where product_id = $id  AND Ratings.status = 1 
        ORDER BY Ratings.created_at DESC";
        $result = $this->_conn->MySQLi()->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getUserRating($userId, $productId)
    {
        $sql = "SELECT * FROM $this->table
                WHERE user_id = $userId AND product_id = $productId";

        $result = $this->_conn->MySQLi()->query($sql);
        return $result->fetch_assoc();  
    }
    public function getTimeAgo($date)
    {
        try {
            date_default_timezone_set('Asia/Ho_Chi_Minh');
    
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
    
}

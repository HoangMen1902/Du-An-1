<?php

namespace Src\Controllers\Client;

use Src\Controllers\BaseController;
use Src\Models\Client\CommentModel;
use Src\Validations\Client\RatingValidation;
use Src\Notifications\Notification;
use Src\Models\Client\RatingModel;

class RatingController extends BaseController
{
    public function store()
{
    $productId = $_POST['product_id'] ?? null;


    if (!$productId || !is_numeric($productId)) {
        Notification::error('Lỗi', 'ID sản phẩm không hợp lệ');
        header("Location: /detail/$productId");
        exit;
    }


    $validationResult = RatingValidation::validateRatingInput($_POST);

    if ($validationResult === true) {
      
        $ratingData = [
            'preview' => $_POST['preview'],
            'rating' => $_POST['rating_value'],
            'user_id' => $_SESSION['user']['id'],
            'product_id' => (int)$productId
        ];


        $ratingModel = new RatingModel();
        $ratingResult = $ratingModel->createRating($ratingData);

        if ($ratingResult) {
            Notification::success('Đánh giá thành công', 'Đã thêm đánh giá thành công');
        } else {
            Notification::error('Đánh giá thất bại', 'Có lỗi xảy ra khi lưu đánh giá');
        }


        header("Location: /detail/$productId");
        exit;
    } else {
       
        Notification::error('Lỗi', 'Dữ liệu nhập vào không hợp lệ');
        header("Location: /detail/$productId");
        exit;
    }
}

    


public function update($id)
{
    $productId = $_POST['product_id'] ?? null;

   
    if (!$productId || !is_numeric($productId)) {
        Notification::error('Lỗi', 'ID sản phẩm không hợp lệ');
        header("Location: /detail/$productId");
        exit;
    }

    $ratingId = $_POST['rating_id'] ?? null;
    if (!$ratingId || !is_numeric($ratingId)) {
        Notification::error('Lỗi', 'ID đánh giá không hợp lệ');
        header("Location: /detail/$productId");
        exit;
    }

 
    $validationResult = RatingValidation::validateRatingInput($_POST);

    if ($validationResult === true) {
        
        $data = [
            'preview' => $_POST['preview'],
            'rating' => $_POST['rating_value'] ?? null
        ];

      
        $ratingModel = new RatingModel();
        $result = $ratingModel->updateRating($ratingId, $data);

        if ($result) {
            Notification::success('Cập nhật đánh giá thành công', 'Đánh giá đã được cập nhật');
        } else {
            Notification::error('Cập nhật đánh giá thất bại', 'Có lỗi xảy ra khi cập nhật đánh giá');
        }

      
        header("Location: /detail/$productId");
        exit;
    } else {
   
        Notification::error('Lỗi', 'Dữ liệu nhập vào không hợp lệ');
        header("Location: /detail/$productId");
        exit;
    }
}


public function delete($id)
{
    $productId = $_POST['product_id'] ?? null;
    $id = $_POST['rating_id'];
    if (!$productId || !is_numeric($productId)) {
        Notification::error('Lỗi', 'ID sản phẩm không hợp lệ');
        header("Location: /detail/$productId");
        exit;
    }

    $ratingModel = new RatingModel();
    $result = $ratingModel->deleteRating($id);

    if ($result) {
        Notification::success('Xóa thành công', 'Đánh giá đã được xóa.');
    } else {
        Notification::error('Xóa thất bại', 'Có lỗi xảy ra khi xóa đánh giá.');
    }

    header("Location: /detail/$productId");
    exit;
}
    
}
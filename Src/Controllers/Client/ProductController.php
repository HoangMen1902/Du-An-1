<?php

namespace Src\Controllers\Client;

use Src\Controllers\BaseController;
use Src\Models\Client\ProductModel;
use Src\Models\Client\CommentModel;
use Src\Models\Client\RatingModel;

class ProductController extends BaseController
{
    public function loadDescription($params) {
        $id = $params['id'];
        $ProductModel = new ProductModel();
        $data = $ProductModel->getOneProduct($id);
        echo $this->view->render('Admin/Pages/Products/Description', ['data' => $data]);
    }
    public function show($id)
    {
        $productId = $id['id'];
        $userId = $_SESSION['user']['id'] ?? 0 ;
  
    
        if (!$productId) {
            echo "ID sản phẩm không hợp lệ.";
            return;
        }
    
        $productModel = new ProductModel();
        $productData = $productModel->getProductById($productId);
        $commentModel = new CommentModel();
        $commentData = $commentModel->getAllCommentByProductId($productId);
        $commentReply = $commentModel->getAllCommentByParentId($productId);
        $allowRating = $commentModel->allowRating($userId, $productId);
        $ratingModel = new ratingModel();
        $ratingData = $ratingModel->getAllRatingByProductId($productId);
        $userRating = $ratingModel->getUserRating($userId, $productId);

        if (!$productData) {
            echo "Sản phẩm không tồn tại.";
            return;
        }

        
        
        
        echo $this->view->render('Client/Pages/Product/Detail', [
            'productData' => $productData,
            'commentData' => $commentData,
            'commentReply' => $commentReply,
            'commentModel' => $commentModel,
            'ratingModel' => $ratingModel,

            'allowRating' => $allowRating,
            'ratingData' => $ratingData,
            'userRating' => $userRating, 
            'userId' => $userId,
        ]);
    }
    
}

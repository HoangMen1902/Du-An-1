<?php

namespace Src\Controllers\Client;

use Src\Controllers\BaseController;
use Src\Models\Client\CommentModel;
use Src\Validations\Client\CommentValidation;
use Src\Notifications\Notification;

class CommentController extends BaseController
{
    public function index()
    {
       
    }

    public function create()
    {
        // return $this->view->render('Client/Pages/Comment/Create', []);
    }

   public function store()
{
    $productId = $_POST['product_id'] ?? null;


    if (!$productId || !is_numeric($productId)) {
        Notification::error('Lỗi', 'ID sản phẩm không hợp lệ');
        header("Location: /detail/$productId");
        exit;
    }

    // Validate comment
    $validationResult = CommentValidation::commentValidation($_POST);

    if ($validationResult === true) {
   
        $data = [
            'content' => $_POST['content'],
            'user_id' => $_SESSION['user']['id'],
            'product_id' => (int)$productId
        ];

        $commentModel = new CommentModel();
        $result = $commentModel->createComment($data);

        if ($result) {
            Notification::success('Bình luận thành công', 'Đã thêm bình luận thành công');
        } else {
            Notification::error('Bình luận thất bại', 'Có lỗi xảy ra khi lưu bình luận');
        }

        header("Location: /detail/$productId");
        exit;
    } else {

        header("Location: /detail/$productId");
        exit;
    }
}


public function update($id)
{
    $productId = $_POST['product_id'] ?? null;
    $id = $_POST['comment_id'];
   
    if (!$productId || !is_numeric($productId)) {
        Notification::error('Lỗi', 'ID sản phẩm không hợp lệ');
        header("Location: /detail/$productId");


        exit;
    }

    
    $validationResult = CommentValidation::commentValidation($_POST);

    if ($validationResult === true) {

        $data = [
            'content' => $_POST['content'],
            // 'rating' => $_POST['rating'],
        ];

        $commentModel = new CommentModel();
        $result = $commentModel->updateComment($id, $data);

        if ($result) {
            Notification::success('Cập nhật bình luận thành công', 'Bình luận đã được cập nhật');
        } else {
            Notification::error('Cập nhật bình luận thất bại', 'Có lỗi xảy ra khi cập nhật bình luận');
        }

        header("Location: /detail/$productId");
        exit;
    } else {
    
        header("Location: /detail/$productId");
        exit;
    }
}


    public function reply()
    {
        $productId = $_POST['product_id'] ?? null;
    
     
        if (!$productId || !is_numeric($productId)) {
            Notification::error('Lỗi', 'ID sản phẩm không hợp lệ.');
            return $this->redirect("/product-detail/$productId");
        }
    
     
        $validationResult = CommentValidation::commentValidation($_POST);
    
        if ($validationResult === true) {
            $data = [
                'content' => $_POST['content'],
                'user_id' => $_SESSION['user']['id'],
                'product_id' => (int)$productId,
                'parent_id' => $_POST['parent_id'] ?? null
            ];
    
            $commentModel = new CommentModel();
            $result = $commentModel->createComment($data);
    
            if ($result) {
                Notification::success('Thành công', 'Trả lời bình luận thành công.');
            } else {
                Notification::error('Thất bại', 'Không thể trả lời bình luận. Vui lòng thử lại.');
            }
        } else {
            header("Location: /detail/$productId");
            exit;
        }
    
        var_dump($data);
        header("Location: /detail/$productId");

    }
    
    public function updateReply($id)
    {
        $productId = $_POST['product_id'] ?? null;
        $id = $_POST['comment_id'];
    
     
        if (!$productId || !is_numeric($productId)) {
            Notification::error('Lỗi', 'ID sản phẩm không hợp lệ');
            header("Location: /detail/$productId");
            exit;
        }
    
 
        $validationResult = CommentValidation::commentValidation($_POST);
    
        if ($validationResult === true) {
         
            $data = [
                'content' => $_POST['content'], 
            ];
    
            $commentModel = new CommentModel();
            $result = $commentModel->updateComment($id, $data);
    
            if ($result) {
                Notification::success('Cập nhật trả lời thành công', 'Trả lời đã được cập nhật');
            } else {
                Notification::error('Cập nhật trả lời thất bại', 'Có lỗi xảy ra khi cập nhật trả lời');
            }
    
            header("Location: /detail/$productId");
            exit;
        } else {
          
            header("Location: /detail/$productId");
            exit;
        }
    }
    
    public function delete($id)
    {
        $productId = $_POST['product_id'] ?? null;

        if (!$productId || !is_numeric($productId)) {
            return $this->renderError('ID sản phẩm không hợp lệ.');
        }

        $commentModel = new CommentModel();
        $result = $commentModel->deleteComment($id);

        $message = $result ? 'Xoá thành công' : 'Xoá thất bại';

        return $this->redirect("/product-detail/$productId", $message);
    }

    private function renderError($errorMessage)
    {
        return $this->view->render('Client/Pages/Error', [
            'errorMessage' => $errorMessage,
        ]);
    }

    private function redirect($url, $message = null)
    {
        if ($message) {
            $_SESSION['message'] = $message;
        }
        header("Location: $url");
        exit;
    }
}

<?php
namespace Src\Controllers\Admin;

use Src\Controllers\BaseController;
use Src\Models\Admin\CommentModel;
use Src\Notifications\Notification;
class CommentController extends BaseController {
    
    public function show() {
        $commentModel = New CommentModel();
        $commentData = $commentModel->getAllComments();
        echo $this->view->render('Admin/Pages/Comments/CommentsList', ['commentData' => $commentData]);
    }

    public function add(){
        echo $this->view->render('Admin/Pages/Comments/CommentsAdd');
    }
    public function edit(){
        echo $this->view->render('Admin/Pages/Comments/CommentsEdit');
    }

    public function delete($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $CommentModel = new CommentModel();

            $deleteSuccess = $CommentModel->deleteComment($id['id']);

            if ($deleteSuccess) {
                header('Location: /admin/comments?status=success ');
            Notification::success('Xóa thành công', 'Đã xóa bình luận thành công');

            } else {
                header('Location: /admin/comments?status=failed ');
            Notification::error('Xóa không thành công', 'có lỗi khi xóa bình luận');

            }
        }
    }
}
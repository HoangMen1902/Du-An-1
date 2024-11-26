<?php

namespace Src\Controllers\Admin;

use Src\Controllers\BaseController;
use Src\Models\Admin\RatingModel;
use Src\Notifications\Notification;

class RatingController extends BaseController
{
    public function show()
    {
        $ratingModel = new RatingModel();
        $ratingData = $ratingModel->getAllRatings();
        echo $this->view->render('Admin/Pages/Ratings/RatingList', ['ratingData' => $ratingData]);
    }

    public function add()
    {
        echo $this->view->render('Admin/Pages/Ratings/RatingAdd');
    }
    public function edit()
    {
        echo $this->view->render('Admin/Pages/Ratings/RatingEdit');
    }
    public function delete($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $RatingModel = new RatingModel();

            $deleteSuccess = $RatingModel->deleteRating($id['id']);

            if ($deleteSuccess) {
                header('Location: /admin/ratings?status=success ');
                Notification::success('Xóa thành công', 'Đã xóa đánh giá thành công');
            } else {
                header('Location: /admin/ratings?status=failed ');
                Notification::success('Xóa không thành công', 'có lỗi khi xóa đánh giá');
            }
        }
    }
}

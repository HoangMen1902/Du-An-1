<?php
namespace Src\Controllers\Admin;

use Src\Controllers\BaseController;

class CommentController extends BaseController {
    public function show() {
        echo $this->view->render('Admin/Pages/Comments/CommentsList');
    }

    public function add(){
        echo $this->view->render('Admin/Pages/Comments/CommentsAdd');
    }
    public function edit(){
        echo $this->view->render('Admin/Pages/Comments/CommentsEdit');
    }
}
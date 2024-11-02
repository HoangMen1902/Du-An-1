<?php

namespace App\Views\Admin\Pages\Comments;

use App\Views\BaseView;

class CommentEdit extends BaseView
{
    public static function render($data = null)
    {

?>
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Sửa Bình luận</h4>
                            <form action="/admin/update-comment/<?=$data['id']?>" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="method" value="POST">
                                <div class="form-group">
                                    <label for="name">ID</label>
                                    <input type="text" class="form-control" id="id" placeholder="id" name="id"
                                        value="<?= $data['id'] ?>"  readonly>
                                </div>
                                <div class="form-group">
                                    <label>Tên Bình luận</label>
                                    <input type="text" class="form-control form-control-lg" readonly name="name"
                                        placeholder="Bàn phím.." value="<?= $data['name'] ?>" aria-label="Category Name">
                                </div>
                                <div class="form-group">
                                    <label>Nội dung bình luận </label>
                                    <input type="text" readonly class="form-control form-control-lg" value="<?= $data['content'] ?>" name="content"
                                        aria-label="Category Name">
                                </div>
                                <div class="form-group">
                                    <label>Ngày bình luận </label>
                                    <input type="datetime" readonly class="form-control form-control-lg" value="<?= $data['date'] ?>" name="date"
                                        aria-label="Category Name">
                                </div>

                                <div class="form-group">
                                    <label>Trạng thái</label>
                                    <div class="form-check form-check-success ">
                                        <select class="form-control form-control-sm col-lg-2"  name="status">
                                            <option value="1" <?= $data['status'] == 1 ? 'selected' : '' ?>>Hoạt động</option>
                                            <option value="2" <?= $data['status'] == 2 ? 'selected' : '' ?>>Không hoạt động</option>
                                        </select>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary" name="submit"
                                    style="justify-self: flex-end;">Sửa</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

     

<?php

}
}

?>
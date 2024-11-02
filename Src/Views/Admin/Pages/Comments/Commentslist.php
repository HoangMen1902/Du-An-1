<?php

namespace App\Views\Admin\Pages\Comments;

use App\Views\BaseView;

class CommentsList extends BaseView
{
    public static function render($data = null)
    {

?>


<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Danh sách Bình luận</h4>
            <div class="table-responsive pt-3">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>
                                ID
                            </th>
                            <th>
                                Tên người Bình luận
                            </th>
                            <th>
                                Nội dung
                            </th>

                            <th>
                                Ngày Và giờ
                            </th>
                            <th>
                                Trạng thái
                            </th>
                            <th>
                                ID sản phẩm
                            </th>
                            <th>
                                ID người dùng
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        foreach ($data as $d):
                            ?>
                            <tr>
                                <td>
                                    <?= $d['id'] ?>
                                </td>
                                <td>
                                    <?= $d['name'] ?>

                                </td>
                                <td>
                                    <?= $d['content'] ?>


                                </td>
                                <td>
                                    <?= $d['date'] ?>


                                </td>
                                <td>
                                    <?= $d['product_id'] ?>


                                </td>
                                <td>
                                    <?= $d['user_id'] ?>


                                </td>
                                <td>
                                    <?= $d['status'] == 1 ? 'Hoạt động' : 'Không hoạt động' ?>

                                </td>
                                <td>
                                    <div class="d-flex align-items-center">

                                        <a href="/admin/commentEdit/<?= $d['id'] ?>"
                                            class="btn btn-success btn-sm btn-icon-text mr-3">
                                            Sửa
                                            <i class="typcn typcn-edit btn-icon-append"></i>
                                        </a>

                                        <a href="/admin/delete-comment/<?= $d['id'] ?>"
                                            onclick="return confirm('Bạn chắc chứ?')"
                                            class="btn btn-danger btn-sm btn-icon-text">
                                            Xóa
                                            <i class="typcn typcn-delete-outline btn-icon-append"></i>
                                        </a>
                                        <?php if ($d['approved'] == 0): ?>
                                            <a href="/admin/approve-comment/<?= $d['id'] ?>"
                                                class="btn btn-primary btn-sm btn-icon-text ml-3">
                                                Duyệt
                                                <i class="typcn typcn-tick-outline btn-icon-append"></i>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                            </tr>
                            <?php
                        endforeach;
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php

}
}

?>
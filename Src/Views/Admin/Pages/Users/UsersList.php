<?php

namespace App\Views\Admin\Pages\Users;

use App\Views\BaseView;

class UsersList extends BaseView
{
    public static function render($data = null)
    {


?>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="table-responsive pt-3">
                        <table class="table table-striped project-orders-table">
                            <thead>
                                <tr>
                                    <th class="ml-5">ID </th>
                                    <th>Họ Tên</th>
                                    <th>Email</th>
                                    <th>Số điện thoại</th>
                                    <th>Trạng thái</th>
                                    <th>Vai trò</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                ?>
                                <?php
                                foreach ($data as $user) :
                                ?>
                                    <tr>
                                        <td><?= $user['id'] ?></td>
                                        <td><?= $user['lastName'] ?> <?= $user['firstName'] ?></td>
                                        <td><?= $user['email'] ?></td>
                                        <td><?= $user['phone'] ?></td>
                                        <td><?= ($user['status'] == 1 ? 'Đang hoạt động' : 'vô hiệu hóa') ?></td>
                                        <td><?= ($user['role'] == 1 ? 'client' : 'admin') ?></td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="/admin/edit-user/<?= $user['id'] ?>">
                                                    <button type="button" class="btn btn-success btn-sm btn-icon-text mr-3">
                                                        Sửa
                                                        <i class="typcn typcn-edit btn-icon-append"></i>
                                                    </button>
                                                </a>
                                                <form action="/admin/delete-user/<?= $user['id'] ?>" method="get"  onsubmit="return confirm('Bạn chắc là xóa chứ?')">
                                                    <input type="hidden" name="method" value="DELETE" id="">
                                                    <button type="submit" class="btn btn-danger btn-sm btn-icon-text" >Xóa</button>
                                                </form>
                                             

                                            </div>
                                        </td>

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
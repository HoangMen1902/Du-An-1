<?php $this->layout('Admin/Layouts/Layout') ?>


<?php
$this->start('main_content');
?>
<form action="/admin/user-search" class="mb-3" method="post" id="user-search">
    <div class="row">
        <div class="col-lg-12">
            <label for="user">Tìm kiếm người dùng</label>
            <input type="text" class="form-control" placeholder="Tìm kiếm người dùng" name="user" id="userSearch">
        </div>
    </div>
</form>
<div class="mb-3 ">
    <a href="/admin/users" class="d-flex">Quay lại</a>
</div>
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
                    <tbody id="lockedUserTable">
                        <?php
                        if (isset($data) && !empty($data) && $data != null) :
                            foreach ($data as $user):
                        ?>
                                <tr>
                                    <td><?= $user['id'] ?></td>
                                    <td><?= $user['firstname'] . ' '  . $user['lastname'] ?></td>
                                    <td><?= $user['email'] ?></td>
                                    <td><?= isset($user['phone']) ? $user['phone'] : 'Trống' ?></td>
                                    <td><?= $user['status'] == 1 ? 'Hoạt động' : 'Khóa' ?></td>
                                    <td><?= $user['status'] == 1 ? 'Khách hàng' : 'Quản trị' ?></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="/admin/edit-user/<?= $user['id'] ?>">
                                                <button type="button" class="btn btn-success btn-sm btn-icon-text mr-3">
                                                    Sửa
                                                    <i class="typcn typcn-edit btn-icon-append"></i>
                                                </button>
                                            </a>
                                            <form action="/admin/delete-user/<?= $user['id'] ?>" data-user="<?=$user['id']?>" method="post" id="deleteForm">
                                                <button type="submit" class="btn btn-danger btn-sm btn-icon-text">Xóa</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                        <?php
                            endforeach;
                        endif;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<?php

$this->stop();
$this->push('scripts');
?>
<script src="<?= $_ENV['APP_URL'] ?>/public\Assets\Admin\js\Pages\UserScript.js"></script>
<?php

$this->end();
?>
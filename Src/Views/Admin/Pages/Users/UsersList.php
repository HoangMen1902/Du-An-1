<?php $this->layout('Admin/Layouts/Layout') ?>


<?php
$this->start('main_content');
?>

<?php
if(isset($_GET['status']) && $_GET['status'] === 'success') {
    ?>
            <div class="alert alert-success mt-5">
                <p class="m-0">Thao tác thành công</p>
            </div>
    <?php
} else if(isset($_GET['status']) && $_GET['status'] === 'failed' && $_GET['error'] == 3) {
?>
            <div class="alert alert-danger mt-5">
                <p class="m-0">Dữ liệu đã bị trùng, lỗi: <?=$_GET['name']?></p>
            </div>
<?php
}
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


    <a href="/admin/locked-account" class="d-flex"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6" style="max-width: 20px;">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
        </svg>Danh sách khóa tạm thời</a>
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
                    <tbody id="userTable">
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
                                            <form action="/admin/lock-user/<?= $user['id'] ?>" data-user="<?=$user['id']?>" method="post" id="lockForm">
                                                <button type="submit" class="btn btn-danger btn-sm btn-icon-text">Khóa tạm thời</button>
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
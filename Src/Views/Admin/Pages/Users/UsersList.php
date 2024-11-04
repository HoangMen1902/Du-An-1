<?php $this->layout('Admin/Layouts/Layout') ?>


<?php 
$this->start('main_content');
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
                        <tr>
                            <td>1</td>
                            <td>Nguyễn Văn A</td>
                            <td>nguyenvana@example.com</td>
                            <td>0123456789</td>
                            <td>Đang hoạt động</td>
                            <td>client</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <a href="/admin/edit-user/1">
                                        <button type="button" class="btn btn-success btn-sm btn-icon-text mr-3">
                                            Sửa
                                            <i class="typcn typcn-edit btn-icon-append"></i>
                                        </button>
                                    </a>
                                    <form action="/admin/delete-user/1" method="get" onsubmit="return confirm('Bạn chắc là xóa chứ?')">
                                        <input type="hidden" name="method" value="DELETE">
                                        <button type="submit" class="btn btn-danger btn-sm btn-icon-text">Xóa</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Trần Thị B</td>
                            <td>tranthib@example.com</td>
                            <td>0987654321</td>
                            <td>vô hiệu hóa</td>
                            <td>admin</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <a href="/admin/edit-user/2">
                                        <button type="button" class="btn btn-success btn-sm btn-icon-text mr-3">
                                            Sửa
                                            <i class="typcn typcn-edit btn-icon-append"></i>
                                        </button>
                                    </a>
                                    <form action="/admin/delete-user/2" method="get" onsubmit="return confirm('Bạn chắc là xóa chứ?')">
                                        <input type="hidden" name="method" value="DELETE">
                                        <button type="submit" class="btn btn-danger btn-sm btn-icon-text">Xóa</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <!-- Thêm nhiều dòng khác nếu cần -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<?php

$this->stop();
?>
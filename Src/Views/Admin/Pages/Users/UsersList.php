<?php $this->layout('Admin/Layouts/Layout') ?>


<?php

$this->push('styles');

?>
<link rel="stylesheet" href="<?= $_ENV['APP_URL'] ?>/node_modules\datatables.net-dt\css\dataTables.dataTables.min.css">
<?php
$this->end();
?>
<?php
$this->start('main_content');
?>

<?php
if (isset($_GET['status']) && $_GET['status'] === 'success') {
?>
    <div class="alert alert-success mt-5">
        <p class="m-0">Thao tác thành công</p>
    </div>
<?php
} else if (isset($_GET['status']) && $_GET['status'] === 'failed' && $_GET['error'] == 3) {
?>
    <div class="alert alert-danger mt-5">
        <p class="m-0">Dữ liệu đã bị trùng, lỗi: <?= $_GET['name'] ?></p>
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
                                            <button class="btn btn-primary btn-sm btn-icon-text mr-3" onclick="showOrders(<?= $user['id'] ?>)" data-id="<?= $user['id'] ?>">Lịch sử mua hàng</button>
                                            <a href="/admin/edit-user/<?= $user['id'] ?>">
                                                <button type="button" class="btn btn-success btn-sm btn-icon-text mr-3">
                                                    Sửa
                                                    <i class="typcn typcn-edit btn-icon-append"></i>
                                                </button>
                                            </a>
                                            <form action="/admin/lock-user/<?= $user['id'] ?>" data-user="<?= $user['id'] ?>" method="post" id="lockForm">
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
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content ">
                <div class="modal-header">
                    <h1 class="modal-title" style="font-size: 24px;" id="exampleModalLabel">Lịch sử mua hàng</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
</div>


<?php

$this->stop();
$this->push('scripts');
?>

<script src="<?= $_ENV['APP_URL'] ?>/node_modules/datatables.net/js/datatables.js"></script>

<script>
    async function showOrders(id) {

        await $.ajax({
            type: "POST",
            url: `/admin/user/get-order/${id}`,
            data: {
                id: id
            },
            dataType: "JSON",
            success: function(response) {
                if (typeof response === 'string') {
                    $('.modal-body').empty();
                    $('.modal-body').append(response);
                    $('#exampleModal').modal('show');
                    $('.modal-dialog').removeClass('modal-lg');
                } else if (typeof response === 'object') {
                    if ($.fn.dataTable.isDataTable('#myTable')) {
                        $('#myTable').DataTable().destroy();
                    }
                    $('.modal-body').empty(); 
                    let html = `
                    <table id="myTable" class="display">
                        <thead>
                            <tr>
                                <th>Số thứ tự</th>
                                <th>Mã đơn hàng</th>
                                <th>Tổng giá</th>
                                <th>Thời gian tạo</th>
                                <th>Trạng thái</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="orderBody">
                        </tbody>
                    </table>
                    `;
                    $('.modal-body').append(html);
                    let table = new DataTable('#myTable', {
                        responsive: true,
                        language: {
                            decimal: ",",
                            thousands: ".",
                            search: "Tìm kiếm:",
                            lengthMenu: "Hiển thị _MENU_ dòng mỗi trang",
                            info: "Hiển thị _START_ đến _END_ trong tổng số _TOTAL_ dòng",
                            infoEmpty: "Không có dữ liệu",
                            infoFiltered: "(lọc từ _MAX_ dòng)",
                            loadingRecords: "Đang tải...",
                            zeroRecords: "Không tìm thấy kết quả phù hợp",
                            emptyTable: "Không có dữ liệu trong bảng",
                            paginate: {
                                first: "Đầu",
                                last: "Cuối",
                                next: "Tiếp",
                                previous: "Trước"
                            },
                            aria: {
                                sortAscending: ": kích hoạt để sắp xếp cột tăng dần",
                                sortDescending: ": kích hoạt để sắp xếp cột giảm dần"
                            }
                        }

                    });
                    $('.modal-dialog').addClass('modal-lg');

                    Object.entries(response).forEach(([key, value]) => {
                        let formattedPrice = new Intl.NumberFormat('vi-VN', {
                            style: 'currency',
                            currency: 'VND'
                        }).format(value.total_price);

                        let status = '';
                        switch (value.status) {
                            case 1:
                                status = 'Đang xử lý';
                                break;
                            case 2:
                                status = 'Chờ thanh toán';
                                break;
                            case 3:
                                status = 'Đã thanh toán';
                                break;
                            case 4:
                                status = 'Đang vận chuyển';
                                break;
                            case 5:
                                status = 'Đã giao';
                                break;
                            default:
                                status = 'Đã hủy';
                                break;
                        }

                        table.row.add([
                            key + 1,
                            value.id,
                            formattedPrice,
                            value.created_at,
                            status,
                            `<a href="/admin/user-order/${value.user_id}/${value.id}" class="btn btn-primary">Xem chi tiết</a>`
                        ]).draw(false);
                    })
                }
                $('#exampleModal').modal('show');
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
        });
    }
</script>
<script src="<?= $_ENV['APP_URL'] ?>/public\Assets\Admin\js\Pages\UserScript.js"></script>
<?php

$this->end();
?>
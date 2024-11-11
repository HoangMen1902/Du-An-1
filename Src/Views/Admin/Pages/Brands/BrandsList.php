<?php $this->layout('Admin/Layouts/Layout') ?>


<?php 
$this->start('main_content');
?>

<?php
if(isset($_GET['status']) && $_GET['status'] === 'success') :


?>

<div class="alert alert-success" role="alert">
  Đã cập nhật thương hiệu thành công
</div>
<?php
elseif (isset($_GET['status']) && $_GET['status'] === 'failed'):;

?>

<div class="alert alert-danger" role="alert">
    <?php switch ($_GET['code']) {
        case '1':
            echo 'Lỗi! Dữ liệu không hợp lệ';
            break;
        case '2':
            echo 'Lỗi! khi thêm dữ liệu';
            break;
        case '3':
            echo 'Lỗi! không thể upload file hình ảnh';
            break;
        case '4':
            echo 'Lỗi! File không phải là hình ảnh';
            break;
        case '5':
            echo 'Lỗi! không thể xóa được thương hiệu';
            break;
        default:
            break;
    }?>
</div>
<?php

endif;
?>
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Danh sách thương hiệu</h4>
            <div class="table-responsive pt-3">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên thương hiệu</th>
                            <th>Hình ảnh</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(isset($data)):
                                foreach($data as $brand):
                        ?>
                        <tr>
                            <td><?=$brand['id']?></td>
                            <td><?=$brand['name']?></td>
                            <td>
                                <img src="<?=$_ENV['APP_URL']?>/public/Uploads/Brands/<?=$brand['image']?>" 
                                     alt="Brand Image" 
                                     style="object-fit: contain; width: 100px; height: auto;">
                            </td>
                            <td><?=$brand['status'] == 1 ? 'Hoạt động' : 'Khóa'?></td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <a href="/admin/edit-brand/1" class="btn btn-success btn-sm btn-icon-text mr-3">
                                        Sửa
                                        <i class="typcn typcn-edit btn-icon-append"></i>
                                    </a>
                                    <button  onclick="deleteBrand(<?=$brand['id']?>)" class="btn btn-danger btn-sm btn-icon-text">
                                        Xóa
                                        <i class="typcn typcn-delete-outline btn-icon-append"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <?php
                        endforeach;
                    endif;
                    ?>
                        <!-- Thêm các hàng khác nếu cần -->
                    </tbody>
                </table>
            </div>
            <?php if(!isset($data) || empty($data)):?>
            <h4 class="text-center text-danger">Không có dữ liệu</h4>
            <?php endif;?>
        </div>
    </div>
</div>

<?php
$this->stop();
?>
<?php

$this->push('scripts')

?>

<script src="<?=$_ENV['APP_URL']?>/public\Assets\Admin\js\Pages\BrandScript.js"></script>


<?php
$this->end();
?>
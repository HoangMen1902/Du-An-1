<?php $this->layout('Admin/Layouts/Layout') ?>


<?php 
$this->start('main_content');
?>


<?php
if(isset($_GET['status']) && $_GET['status'] === 'success') :


?>

<div class="alert alert-success" role="alert">
  Đã thêm thương hiệu thành công
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
        default:
            break;
    }?>
</div>
<?php

endif;
?>
    
<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Thêm Thương hiệu</h4>
            <form action="/admin/add-brand" method="post" enctype="multipart/form-data" id="brandAdd">
                
                <div class="form-group">
                    <label>Tên Thương hiệu</label>
                    <input type="text" class="form-control form-control-lg brand-input" name="name" placeholder="Bàn phím.."
                        aria-label="Category Name">
                        <small class="text-danger" style="display: none;" id="name-validate">* Vui lòng nhập tên thương hiệu</small>
                </div>
                
                <div class="form-group">
                    <label>Hình Ảnh Thương Hiệu</label>
                    <input type="file" class="form-control form-control-lg brand-input" name="image" aria-label="Category Name">
                    <small class="text-danger" style="display: none;" id="image-validate">* Vui lòng tải hình thương hiệu</small>
                </div>
                
                <div class="form-group">
                    <label>Mô tả</label>
                    <textarea  class="form-control form-control-lg brand-input" name="description"></textarea>
                    <small class="text-danger" style="display: none;" id="description-validate">* Vui lòng nhập mô tả thương hiệu</small>
                </div>
                
                <div class="form-group">
                    <label>Trạng thái</label>
                    <div class="form-check form-check-success">
                        <select class="form-control form-control-sm col-lg-2" name="status" >
                            <option value="1">Hoạt động</option>
                            <option value="2">Không hoạt động</option>
                        </select>
                    </div>
                </div>
                
                <button type="submit"  class="btn btn-primary" name="submit" style="justify-self: flex-end;">Thêm</button>

                <!-- Success and Error Alerts - Toggle display based on conditions -->
                <div id="alert-success" class="alert alert-success mt-5" style="display: none;">
                    Thêm thương hiệu thành công!
                </div>
                <div id="alert-error" class="alert alert-danger mt-5" style="display: none;">
                    Có lỗi xảy ra khi thêm thương hiệu.
                </div>
            </form>
        </div>
    </div>
</div>
<?php
$this->stop();
?>

<?php
$this->push('scripts');
?>
<script src="<?=$_ENV['APP_URL']?>/public\Assets\Admin\js\Pages\BrandScript.js"></script>

<?php
$this->end();
?>




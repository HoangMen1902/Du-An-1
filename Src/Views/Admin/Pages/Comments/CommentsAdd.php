<?php $this->layout('Admin/Layouts/Layout') ?>


<?php 
$this->start('main_content');
?>

<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="alert alert-danger mt-5" role="alert">
                Lỗi: Một số lỗi đã xảy ra.
            </div>
            <div class="alert alert-success mt-5" role="alert">
                Thành công: Đã thực hiện thành công.
            </div>
            <div class="alert alert-danger mt-5" role="alert">
                Lỗi: Không thể xóa bình luận.
            </div>
            <div class="alert alert-success mt-5" role="alert">
                Thành công: Bình luận đã được xóa thành công.
            </div>
        </div>
    </div>
</div>

<?php

$this->stop();
?>
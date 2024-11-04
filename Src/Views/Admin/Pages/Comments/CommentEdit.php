<?php $this->layout('Admin/Layouts/Layout') ?>


<?php 
$this->start('main_content');
?>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Sửa Bình luận</h4>
                    <form action="/admin/update-comment/1" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="method" value="POST">
                        <div class="form-group">
                            <label for="name">ID</label>
                            <input type="text" class="form-control" id="id" placeholder="id" name="id" value="1" readonly>
                        </div>
                        <div class="form-group">
                            <label>Tên Bình luận</label>
                            <input type="text" class="form-control form-control-lg" readonly name="name" placeholder="Bàn phím.." value="Tên bình luận" aria-label="Category Name">
                        </div>
                        <div class="form-group">
                            <label>Nội dung bình luận</label>
                            <input type="text" readonly class="form-control form-control-lg" value="Nội dung bình luận" name="content" aria-label="Category Name">
                        </div>
                        <div class="form-group">
                            <label>Ngày bình luận</label>
                            <input type="datetime" readonly class="form-control form-control-lg" value="2024-11-03" name="date" aria-label="Category Name">
                        </div>
                        <div class="form-group">
                            <label>Trạng thái</label>
                            <div class="form-check form-check-success">
                                <select class="form-control form-control-sm col-lg-2" name="status">
                                    <option value="1" selected>Hoạt động</option>
                                    <option value="2">Không hoạt động</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary" name="submit" style="justify-self: flex-end;">Sửa</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

$this->stop();
?>
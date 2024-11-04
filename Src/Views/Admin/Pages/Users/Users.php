<?php $this->layout('Admin/Layouts/Layout') ?>


<?php 
$this->start('main_content');
?>


    <div class="container-scroller">
        <!-- Navbar -->
        <div class="navbar">
            <!-- Nội dung navbar sẽ được thêm vào đây -->
        </div>
        <div class="container-fluid page-body-wrapper">
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Nội dung sidebar sẽ được thêm vào đây -->
            </div>
            <div class="main-panel">
                <div class="content-wrapper">
                    <!-- Thêm người dùng -->
                    <div class="user-add">
                        <!-- Nội dung từ user-add.php sẽ được thêm vào đây -->
                    </div>
                    <!-- Danh sách người dùng -->
                    <div class="users-list">
                        <!-- Nội dung từ users-list.php sẽ được thêm vào đây -->
                    </div>
                </div>
                <footer>
                    <!-- Nội dung footer sẽ được thêm vào đây -->
                </footer>
            </div>
        </div>
    </div>

    <script src="./public/assets/js/provinceAPI.js"></script>
    <!-- Thêm các liên kết JavaScript cần thiết ở đây -->


<?php

$this->stop();
?>
<?php
include './src/views/admin/layouts/header.php';
?>

<div class="container-scroller">
    <?php
    include './src/views/admin/layouts/navbar.php';
    ?>
    <div class="container-fluid page-body-wrapper">
        <?php
            include './src/views/admin/layouts/sidebar.php';
        ?>
        <div class="main-panel">
            <div class="content-wrapper">
                <?php
                // include './src/views/admin/components/statistic.php';
                include './src/views/admin/pages/Users/user-add.php';
                include './src/views/admin/pages/Users/users-list.php';
                ?>
            </div>

            <?php
                include './src/views/admin/layouts/footer.php';
            ?>
        </div>
    </div>
</div>
<?php
include './src/views/admin/layouts/script.php';
?>
<script src="./public/assets/js/provinceAPI.js"></script>
</body>

</html>
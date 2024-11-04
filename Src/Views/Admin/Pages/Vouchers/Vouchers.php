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
                include './src/views/admin/pages/vouchers/voucher-add.php';
                include './src/views/admin/pages/vouchers/vouchers-list.php';
                
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
</body>

</html>
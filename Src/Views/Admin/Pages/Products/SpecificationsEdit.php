<?php $this->layout('Admin/Layouts/Layout') ?>


<?php
$this->start('main_content');
$specs = json_decode($data['specifications']);
?>


<div class="col-md-12 grid-margin stretch-card">
    <a href="/admin/product/detail/<?= $data['product_id'] ?>" class="btn btn-primary">Quay lại</a>
</div>
<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <form action="/admin/edit-specs/<?=$data['product_id']?>" method="post" class="m-0" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="specifications_file">Tải lên file Excel cho thông số kỹ thuật (.xls hoặc .xlsx)</label>
                    <input type="file" class="form-control" name="specifications_file" accept=".xls, .xlsx">
                </div>
                <div class="col-md-12 px-0 " style="text-align: end;">
                    <button class="btn btn-primary">Sửa</button>
                </div>
            </form>
        </div>
    </div>

</div>


<div class="col-12 grid-margin">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Thông số kỹ thuật hiện tại</h4>
            <form class="forms-sample" method="post" enctype="multipart/form-data">
                <input type="hidden" name="method" value="POST">
                <?php
                foreach ($specs as $spec):
                ?>
                    <div class="form-group">
                        <label for="cpu_technology"><?= $spec->spec_name ?></label>
                        <input type="text" class="form-control" name="technology" id="technology" value="<?= $spec->spec_value ?>" disabled>
                    </div>
                <?php
                endforeach;
                ?>
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
<?php
$this->end();
?>
<?php $this->layout('Admin/Layouts/Layout') ?>


<?php
$this->start('main_content');
?>


<div class="col-md-12 grid-margin">
        <a href="/admin/product/detail/<?=$data['id']?>" class="btn btn-primary">Quay lại</a>
</div>
<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
        <?=$data['description']?>
        </div>
    </div>
</div>
<div class="col-md-12 grid-margin">
        <a href="/admin/product/detail/<?=$data['id']?>" class="btn btn-primary">Quay lại</a>
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
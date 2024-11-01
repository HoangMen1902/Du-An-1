

<?php $this->layout('Client/Components/Header');?>

<?php $this->unshift('styles') ?>
    <link rel="stylesheet" href="style.css">
<?php $this->end()?>

<?php $this->start('main_content') ?>

<div>
    <h2 class="text-success">Đây là nội dung</h2>
</div>


<?php $this->stop() ?>

<?php $this->push('scripts')?>
    <script src="abc.js"></script>
<?php $this->end() ?>
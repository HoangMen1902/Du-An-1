

<?php $this->layout('Client/Components/Layout');?>


<?php $this->start('main_content') ?>
<!-- Insert nội dung vào đây -->
<?php
$this->insert('/Client/Home/Carousel');  
$this->insert('/Client/Home/AdsBanner');
$this->insert('/Client/Home/AdsProducts');
?>

<?php $this->stop() ?>




<?php
$this->push('scripts')
?>
<script src="<?=$_ENV['APP_URL']?>/public/Assets/Client/js/Carousel.js"></script>
<?php
$this->end();
?>



<?php $this->layout('Client/Components/Layout');?>



<?php $this->start('main_content') ?>
<!-- Insert nội dung vào đây -->
<?php
$this->insert('/Client/Home/Carousel');  
$this->insert('/Client/Home/AdsBanner');
$this->Insert("/Client/Home/popular");

$this->Insert('Client/Home/feedback');
?>


<?php $this->stop() ?>




<?php
$this->push('scripts')
?>
<script src="<?=$_ENV['APP_URL']?>/public/Assets/Client/js/Carousel.js"></script>
<?php
$this->end();
?>
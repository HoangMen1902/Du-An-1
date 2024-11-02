<?php $this->layout('Client/Components/Layout'); ?>



<?php $this->start('main_content') ?>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="filter" style="position: sticky; top: 0;">
            </div>
        </div>

        <div class="col-md-9">
            <div class="row">
                <div class="col-3">
                    <div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<?php $this->stop() ?>




<?php
$this->push('scripts')
?>

<?php
$this->end();
?>
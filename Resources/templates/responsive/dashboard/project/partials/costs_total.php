<?php

$total = 0;

?>

<div class="costs-bar spacer-10">
    <div class="total">
        <?= $this->text('regular-total') ?>
         <span><?= $this->currency($this->project->currency) ?> <strong class="amount-total"><?= $total ?></strong></span>
    </div>
</div>
<dic class="clearfix"></dic>

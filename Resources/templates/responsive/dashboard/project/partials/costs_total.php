<?php

$costs = $this->project->costs;
$total = 0;
if(!empty($costs)) {
  foreach($costs as $cost) {
    $total += $cost->amount;
  }
}

?>

<div class="costs-bar spacer-10">
    <div class="total">
        <?= $this->text('regular-total') ?>
         <span><?= $this->currency($this->project->currency) ?> <strong class="amount-total"><?= euro_format($total) ?></strong></span>
    </div>
</div>
<dic class="clearfix"></dic>

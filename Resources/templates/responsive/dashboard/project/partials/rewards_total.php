<?php
$costs = $this->project->costs;
$totalCostString = [];
foreach($costs as $cost) {
  $totalCostString[] = $cost->amount;
}
$totalCostString = implode(',', $totalCostString);
?>

<div class="costs-bar spacer-10">
    <div class="width-33-percentage">
        <input type="hidden" id="totalCostString" class="totalCostString" value="<?php echo $totalCostString; ?>" />
        <?= $this->text('rewards-total-cost') ?>
         <span class="cost-strong"><?= $this->currency($this->project->currency) ?> <strong class="rewards-total-cost"><?= euro_format($totalCost) ?></strong></span>
    </div>
    <div class="width-33-percentage text-center">
        <?= $this->text('rewards-total-collection') ?>
         <span class="cost-strong"><?= $this->currency($this->project->currency) ?> <strong class="rewards-total-collection"><?= euro_format($totalCollection) ?></strong></span>
    </div>
    <div class="width-33-percentage text-right">
        <?= $this->text('rewards-percentage') ?>
         <span class="cost-strong"><strong class="rewards-percentage"><?= euro_format($rewardsPercentage) ?></strong> %</span>
    </div>
</div>
<div class="clearfix"></div>
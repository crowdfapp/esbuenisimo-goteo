<?php
  $id = $this->reward->id;
  $form = $this->raw('form');
  $unlimited = (int)$form["units_$id"]->vars['value'] == 0;
?>
<div class="panel section-content" data-id="<?= $id ?>">
  <div class="panel-body reward-item">
      <div class="row">
        <div class="amount reward-cost width-41-percent"><?= $this->form_row($form["amount_$id"]) ?></div>
        <div class="unlimited width-17-percent form-group text-center">
            <label for="unlimited_<?= $id ?>"><?= $this->text('project-reward-unlimited') ?></label>
            <div class="input-wrap">
              <?= $this->form_row($form["unlimited_$id"]) ?>
          </div>
        </div>
        <div class="amount reward-entry width-41-percent units hide"><?= $this->form_row($form["units_$id"]) ?></div>
      </div>
      <?= $this->form_row($form["reward_$id"]) ?>
      <?= $this->form_row($form["description_$id"]) ?>
     <div class="remove"><?= $this->form_row($form["remove_$id"], [],  true) ?></div>
    <?php if($this->show_taken): ?>
         <p class="text-muted"><i class="fa fa-hand-o-right"></i> <?= $this->text('project-donors-with-reward', $this->reward->getTaken()) ?></p>
     <?php endif ?>
  </div>
</div>
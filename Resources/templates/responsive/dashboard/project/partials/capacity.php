<?php
  $form = $this->raw('form');
  $project = $this->project;
?>

<div class="panel section-content">
  <div class="panel-body cost-item">

    <div class="amount">
      <?= $this->form_row($form['capacity']) ?>      
    </div>

    <?= $this->form_row($form['tickets_to_support']) ?>      
    
    <div class="supported-tickets-section" <?php if($project->tickets_to_support == 1): ?>style="display: none;"<?php endif; ?>>
      
      <div class="amount">
        <?= $this->form_row($form['supported_tickets_number']) ?>      
      </div>    

      <div class="col-xs-12 title-supported-tickets-percentage">
            <?= $this->form_row($form['title-supported-tickets-percentage']) ?> 
      </div>      
      
    </div>    
  </div>
</div>
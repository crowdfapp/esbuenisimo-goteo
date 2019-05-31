<?php
  $form = $this->raw('form');
  $project = $this->project;
?>

<div class="panel section-content">
  <div class="panel-body cost-item">

    <div class="amount">
      <?= $this->form_row($form['capacity']) ?>      
    </div>

    <?= $this->form_row($form['tickets-to-support']) ?>      
    
    <div class="supported-tickets-section" <?php if(empty($project->supported_tickets_number)): ?>style="display: none;"<?php endif; ?>>
      
      <div class="amount">
        <?= $this->form_row($form['supported-tickets-number']) ?>      
      </div>    

      <div class="col-xs-12">
            <?= $this->form_row($form['title-supported-tickets-percentage']) ?> 
      </div>      
      
    </div>    
  </div>
</div>
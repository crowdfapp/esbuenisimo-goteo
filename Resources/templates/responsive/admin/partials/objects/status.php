<?php 
$ob = $this->raw('ob');

if(Goteo\Application\Session::isAdmin()):  ?> 

  <form method="post" class="float-left margin-right-15-pixels">
    
      <input type="hidden" name="request-id" id="request-id" value="<?php echo $ob->getId(); ?>" />
  
      <div class="form-group">

        <select class="form-control" name="status" id="status" onchange="this.form.submit();">
          <?php foreach(Goteo\Model\ProjectRequestStatus::getList() as $index => $status): ?>
            <option value="<?php echo $index; ?>" <?php if($ob->getStatus() == $index): ?> selected <?php endif; ?>>
              <?php echo $status; ?>
            </option>
          <?php endforeach; ?>                         
        </select>        
        
        <input type="hidden" name="form-action" id="form-action" value="change-status" />
        
      </div>
    
  </form>    
    
  <?php if($ob->isRejected()): ?>

  <form method="post" class="float-left">
    
    <input type="hidden" name="request-id" id="request-id" value="<?php echo $ob->getId(); ?>" />
    
    <div class="form-group">
      <button type="button" class="btn btn-cyan delete-request" 
              popup-title="<?php echo $this->text('project-request-delete-confirmation-title'); ?>" 
              popup-message="<?php echo $this->text('project-request-delete-confirmation-message'); ?>"
              confirm-btn="<?php echo $this->text('project-request-delete-confirmation-confirm-button') ?>"
              cancel-btn="<?php echo $this->text('project-request-delete-confirmation-cancel-button') ?>">Eliminar</button>    
    </div>    
    
    <input type="hidden" name="form-action" id="form-action" value="delete-request" />
    
  </form>

  <?php endif; ?>
    


<?php else: ?>
  <?= $this->text(Goteo\Model\ProjectRequestStatus::$statuses[$ob->getStatus()]); ?> 
<?php endif; ?> 
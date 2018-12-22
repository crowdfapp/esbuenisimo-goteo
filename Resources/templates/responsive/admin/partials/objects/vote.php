<?php 
$ob = $this->raw('ob');
?>

<?php if($ob->getStatus() == Goteo\Model\ProjectRequestStatus::STATUS_APPROVED): ?>

  <?php if(Goteo\Application\Session::isAdmin() || empty($ob->getUserId())): ?>

    <form class="form-inline" method="post">

      <input type="hidden" name="request-id" id="request-id" value="<?php echo $ob->getId(); ?>" />

      <input type="submit" class="btn btn-cyan btn-vote" value="<?php echo $this->text('admin-title-vote'); ?>" 
             request-id="<?php echo $this->raw('ob')->getId(); ?>" />

      <input type="hidden" name="form-action" id="form-action" value="vote-for-request" />

    </form>

  <?php else: ?>

    <?php echo $this->text('project-request-already-voted'); ?>

  <?php endif; ?>

<?php elseif($ob->getStatus() == Goteo\Model\ProjectRequestStatus::STATUS_PENDING): ?>

  <?php echo $this->text('project-request-can-vote-for-pending'); ?>

<?php endif; ?>
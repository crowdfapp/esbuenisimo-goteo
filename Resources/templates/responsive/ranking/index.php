<?php

$this->layout('layout', [
    'bodyClass' => 'about',
    'title' => $this->text('meta-title-ranking'),
    'meta_description' => $this->text('meta-description-ranking')
    ]);

?>

<?php $this->section('subheader') ?>
<?php if ($this->is_master_node()) : ?>
    <div id="sub-header">
        <div>
            <h2><?= $this->page->description ?></h2>
        </div>
    </div>
<?php endif ?>
<?php $this->replace() ?>

<?php $this->section('content') ?>

    <div id="ranking-content">
      
        <div class="container-fluid ranking padding-bottom-25-pixels">
          
            <?php if ($this->success) : ?>
                <div class="alert alert-success spacer-20" role="alert">
                    <a href="#" class="close custom-close col-md-offset-1" data-dismiss="alert" aria-label="close">×</a>
                    <?= $this->success; ?>
                </div>
            <?php endif ?>          
        
            <?php if ($this->errors) : ?>
                <div class="alert alert-danger spacer-20" role="alert">
                    <a href="#" class="close custom-close col-md-offset-1" data-dismiss="alert" aria-label="close">×</a>
                    <?= implode('<br />', $this->errors) ?>
                </div>
            <?php endif ?>
          
          <div id="sub-header" class="margin-bottom-20-pixels">
              <div>
                  <h2><?= $this->text('ranking-title'); ?></h2>
              </div>
          </div>          
          
          <div id="sub-description" class="margin-bottom-40-pixels">
              <div>
                  <h4><?= $this->text('ranking-description'); ?></h4>
              </div>
          </div>   
          
          <?php if($this->isAdmin): ?>
      
            <form class="form-inline form-section create-form margin-bottom-40-pixels pronto" action="<?= $filter['_action'] ?>">
              
                  <div class="form-group">

                    <select name="project_request_type_id" id="project_request_type_id" class="form-control">
                        <option value=""><?= $this->text('ranking-event-type-all') ?></option>
                        <?php foreach($this->projectRequestTypes as $index => $projectRequestType): ?>
                          <option value="<?php echo $index; ?>">
                            <?php echo $projectRequestType ?>
                          </option>
                        <?php endforeach; ?>                         
                    </select>                                         
                  </div>                   
              
                  <div class="form-group">
                    
                    <select name="status" id="status" class="form-control">
                        <option value=""><?= $this->text('ranking-status-all') ?></option>
                        <?php foreach($this->statuses as $index => $status): ?>
                          <option value="<?php echo $index; ?>" 
                                  <?php if($this->get_query('status') == $index): ?> selected <?php endif; ?>>
                            <?php echo $status; ?>
                          </option>
                        <?php endforeach; ?>                         
                    </select>                                         
                  </div>

              <div class="form-group">
                <input type="text" class="form-control" name="query" id="query" placeholder="" 
                       value="<?= $this->get_query('query') ?>">
              </div>
              <button type="submit" class="btn btn-cyan" title=""><i class="fa fa-search"></i></button>
              
              <!-- 
              <button type="button" class="btn btn-cyan reset" title="<?= $this->text('reset-filtering-criteria'); ?>">
                <i class="fa fa-undo"></i>
              </button>
              -->
              
          </form>
          
          <?php endif; ?>
          
          <div class="table-responsive-vertical margin-bottom-40-pixels">
            
             <h5><?= $this->text('admin-list-total', $this->total) ?></h5>

             <?= $this->insert('admin/partials/material_table', ['list' => $this->model_list_entries($this->list)]) ?>

        </div>
          
       

          <div id="sub-description" class="margin-bottom-40-pixels">
              <div>
                  <h4><?= $this->text('ranking-description'); ?></h4>
              </div>
          </div>                          
          
          <form class="form-inline form-section create-form margin-bottom-40-pixels" method="post"> 
            
              <div class="form-group">

                <select name="project_request_type_id" id="project_request_type_id" class="form-control">
                    <option value=""><?= $this->text('ranking-select-request-type-id') ?></option>
                    <?php foreach($this->projectRequestTypes as $index => $projectRequestType): ?>
                      <option value="<?php echo $index; ?>">
                        <?php echo $projectRequestType ?>
                      </option>
                    <?php endforeach; ?>                         
                </select>                                         
              </div>            
            
            
              <div class="form-group">
                <input type="text" class="form-control" id="project_name" name="project_name" 
                       value="<?= $this->data['project_name'] ?>" 
                       placeholder="<?= $this->text('ranking-what-events-do-you-want') ?>">
              </div>
            
              <div class="form-group">

                <select name="region_id" id="region_id" class="form-control">
                    <option value=""><?= $this->text('ranking-select-region') ?></option>
                    <?php foreach($this->regions as $region): ?>
                      <option value="<?php echo $region->id; ?>">
                        <?php echo $region->name; ?>
                      </option>
                    <?php endforeach; ?>                         
                </select>                                         
              </div>
            
              <div class="form-group">
                <select name="province_id" id="province_id" class="form-control disabled" 
                        loading-provinces-msg="<?= $this->text('loading-provinces-msg') ?>"
                        ranking-select-province-msg="<?= $this->text('ranking-select-province') ?>">
                  <option value=""><?= $this->text('ranking-no-provinces') ?></option>
                </select>                                         
              </div>

              <div class="form-group">
                <select name="commune_id" id="commune_id" class="form-control disabled"
                        ranking-no-communes-msg="<?= $this->text('ranking-no-communes') ?>"
                        loading-communes-msg="<?= $this->text('loading-communes-msg') ?>"
                        ranking-select-commune-msg="<?= $this->text('ranking-select-commune') ?>">
                  <option value=""><?= $this->text('ranking-no-communes') ?></option>
                </select>                                         
              </div>            
            
              <input type="submit" class="btn btn-cyan" value="<?= $this->text('ranking-send-button') ?>" />
          </form>
          
          <div class="add_event_message"></div>
          
        </div>

    </div>

<?php $this->replace() ?>

<?php $this->section('footer') ?>

<?php $this->append() ?>
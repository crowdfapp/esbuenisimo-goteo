<?php

$page = $this->page;
$tags = $this->tags;

$captcha = $this->captcha;


$this->layout('layout', [
    'bodyClass' => 'about',
    'title' => $this->text('meta-title-contact'),
    'meta_description' => $this->text('meta-description-contact')
    ]);

?>

<?php $this->section('subheader') ?>

<?php $this->replace() ?>

<?php $this->section('content') ?>

    <div id="main">

        <div class="container-fluid border-0-pixels-important">
          
            <?php if ($this->errors) : ?>
                <div class="alert alert-danger spacer-20" role="alert">
                    <a href="#" class="close custom-close col-md-offset-1" data-dismiss="alert" aria-label="close">×</a>
                    <?= implode('<br />', $this->errors) ?>
                </div>
            <?php endif ?>
          
          <div id="sub-header" class="margin-bottom-20-pixels">
              <div>
                  <h2><?= $this->text('contact-title'); ?></h2>
              </div>
          </div>          
          
          <div id="sub-description" class="margin-bottom-40-pixels">
              <div>
                  <h4><?= $this->text('contact-description'); ?></h4>
              </div>
          </div>                 
                    
            <div class="form-section create-form margin-top-0-pixels-important" style="float:left;width: 450px;">
                <form method="post" action="/contact">
                    <input type="hidden" name="form-token" value="<?= $this->token ?>">
                  
                    <div class="form-group">
                        <label for="name"><?= $this->text('contact-name-field') ?></label>&nbsp;<span class="color-red">*</span><br />
                        <input class="short width-100-percent" type="text" id="name" name="name" value="<?= $this->data['name'] ?>"/>
                    </div>
                  
                    <div class="form-group">
                      <label for="email"><?= $this->text('contact-email-field') ?></label>&nbsp;<span class="color-red">*</span><br />
                      <input class="short width-100-percent" type="text" id="email" name="email" value="<?= $this->data['email'] ?>"/>
                    </div>                  

                    <div class="form-group">
                        <label for="email"><?= $this->text('contact-phone-field') ?></label><br />
                        <input class="short width-100-percent" type="text" id="phone" name="phone" value="<?= $this->data['phone'] ?>"/>
                    </div>

                    <div class="form-group">
                        <label for="message"><?= $this->text('contact-subject-field') ?></label>&nbsp;<span class="color-red">*</span><br />
                        <textarea id="message width-100-percent" name="message" cols="50" rows="5"><?= $this->data['message'] ?></textarea>
                    </div>

                    <?php if ($captcha) : ?>
                  
                        <div class="form-group">
                            <label for="recaptcha_response"><?= $this->text('contact-captcha-field') ?></label><br />
                            <input type="text" id="captcha_response" name="captcha_response" value="">
                        </div>

                    <div id="recaptcha_image"></div><a href="#reload" id="reloadCaptcha"><?= $this->text('contact-captcha-refresh') ?></a>
                    <img id="captchaImage" src="<?= $captcha->inline() ?>" alt="captcha">                  
                  
                    <?php endif; ?>                  
                  
                    <button class="btn btn-block pink custom col-sm-11 text-uppercase" name="send" type="submit"><?= $this->text('contact-send_message-button') ?></button>
                </form>
            </div>

            <!-- <div style="float:left;width: 450px;">
                <?= $page->parseContent() ?>
            </div> -->

        </div>

    </div>

<?php $this->replace() ?>

<?php $this->section('footer') ?>

<script type="text/javascript">
// @license magnet:?xt=urn:btih:0b31508aeb0634b347b8270c7bee4d411b5d4109&dn=agpl-3.0.txt
    $(function(){
        $('#reloadCaptcha').click(function(e){
            e.preventDefault();
            $.get('/contact/captcha', function(data) {
                $('#captchaImage').attr('src', data);
            });
        });
    });
// @license-end
</script>

<?php $this->append() ?>
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
<?php if ($this->is_master_node()) : ?>
    <div id="sub-header">
        <div>
            <h2><?= $page->description ?></h2>
        </div>
    </div>
<?php endif ?>
<?php $this->replace() ?>

<?php $this->section('content') ?>

    <div id="main">

        <div class="widget contact-message">
            <!-- <h3 class="title"><?= $page->name ?></h3> -->

            <?php if ($this->errors) : ?>
                <p style="color:red;">
                    <?= implode('<br />', $this->errors) ?>
                </p>
            <?php endif ?>

            <div class="form-section" style="float:left;width: 450px;">
                <form method="post" action="/contact">
                    <input type="hidden" name="form-token" value="<?= $this->token ?>">
                    <table>
                        <tr>
                            <td>
                                <div class="field">
                                    <label for="name"><?= $this->text('contact-name-field') ?></label>&nbsp;<span class="required">*</span><br />
                                    <input class="short" type="text" id="name" name="name" value="<?= $this->data['name'] ?>"/>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="field">
                                    <label for="email"><?= $this->text('contact-email-field') ?></label>&nbsp;<span class="required">*</span><br />
                                    <input class="short" type="text" id="email" name="email" value="<?= $this->data['email'] ?>"/>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="field">
                                    <label for="email"><?= $this->text('contact-phone-field') ?></label><br />
                                    <input class="short" type="text" id="phone" name="phone" value="<?= $this->data['phone'] ?>"/>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="2">
                                <div class="field">
                                    <label for="message"><?= $this->text('contact-subject-field') ?></label>&nbsp;<span class="required">*</span><br />
                                    <textarea id="message" name="message" cols="50" rows="5"><?= $this->data['message'] ?></textarea>
                                </div>
                            </td>
                        </tr>

                        <?php if ($captcha) { ?>
                        <tr>
                            <td colspan="2">
                                <div class="field">
                                    <label for="recaptcha_response"><?= $this->text('contact-captcha-field') ?></label><br />
                                    <input type="text" id="captcha_response" name="captcha_response" value="">
                                </div>
                            </td>
                        </tr>
                        <?php } ?>
                    </table>

                    <?php if ($captcha) { ?>
                    <div id="recaptcha_image"></div><a href="#reload" id="reloadCaptcha"><?= $this->text('contact-captcha-refresh') ?></a>
                    <img id="captchaImage" src="<?= $captcha->inline() ?>" alt="captcha">
                    <br />
                    <?php } ?>

                    <button class="aqua" name="send" type="submit"><?= $this->text('contact-send_message-button') ?></button>
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
<?php $this->layout('home/layout') ?>

<?php $this->section('sidebar-header') ?>
    <span class="header-title">
    	<?= $this->text('home-menu-toggle-label')."..." ?>
    </span>
<?php $this->replace() ?>

<?php $this->section('sidebar-footer') ?>
    <a href="/project/create" class="btn btn-fashion">
		<?= $this->text('regular-create') ?>
	</a>
	<a href="/login" class="btn btn-light-black">
		<?= $this->text('login-title') ?>
	</a>
<?php $this->replace() ?>

<?php $this->section('sidebar-menu-toggle') ?>
    <?= $this->text('home-menu-toggle-label') ?> <i class="fa fa-angle-right"></i>
<?php $this->replace() ?>



<?php $this->section('home-content') ?>

    <h1 class="titlevideo hidden-xs">#FanáticosDeVerdad</h1>
    <video width="100%" height="auto" autoplay  loop style="    margin-top: -130px;">
        <source src="assets/video.mp4" type="video/mp4">
    </video>
    <div class="width:80%; margin: 0 auto;">
        <div class="col-md-3"><div>1 </div></div>
        <div class="col-md-3"><div>2</div></div>
        <div class="col-md-3"><div>3</div></div>
        <div class="col-md-3"><div>4</div></div>
    </div>


    <!-- Banner section -->

    <?= $this->insert('partials/components/main_slider', [
            'banners' => $this->banners,
            'nav' => 'home/partials/main_slider_nav',
            'button_text' => $this->text('invest-more-info')
    ]) ?>

    <?= $this->insert('home/partials/projects') ?>

    <?= $this->insertif('home/partials/call_to_action') ?>

    <?= $this->insertif('home/partials/advantages') ?>

    <?= $this->insertif('home/partials/matchfunding') ?>

    <?= $this->insertif('home/partials/foundation') ?>

    <?= $this->insertif('home/partials/channels') ?>

    <?= $this->insertif('home/partials/sponsors') ?>

    <?= $this->insertif('home/partials/tools') ?>

    <?= $this->insert('home/partials/modals') ?>

<?php $this->replace() ?>


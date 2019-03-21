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
    <video width="100%" height="auto" playsinline autoplay muted loop style="    margin-top: -130px;">
        <source src="assets/video.mp4" type="video/mp4">
    </video>
    <div class="row col-md-12" style="    margin: 50px auto;">
         <h2 class="title text-center" style="margin-bottom: 40px;">¿Cómo funciona?</h2>
        <!--<h2 class="title text-center" style="margin-bottom: 40px;">Como funciona</h2> -->

        <!--<img src="assets/img/comofunciona.png" style="width: 100%; margin: 30px 0px;" alt="">-->
        <div class="col-md-12 bg">
            <div class="col-md-2 col-md-offset-1 box-public">
                <img src="assets/img/Registro.png" class="wdt-img" alt="">
                <h3 class="txt-red">Registro</h3>
                <p>Te registras en <b>esbuenisimo.com</b> a través de tu mail</p>
            </div>
            <div class="col-md-2 box-public">
                <img src="assets/img/Proyecto.png" class="wdt-img" alt="">
                <h3 class="txt-red">Proyecto</h3>
                <p>Navegas y buscas tus proyectos o eventos favoritos</p>
            </div>
            <div class="col-md-2 box-public">
                <img src="assets/img/Recompensa.png" class="wdt-img" alt="">
                <h3 class="txt-red">Recompensa</h3>
                <p>Eliges la recompensa o experiencia que más te gusta</p>
            </div>
            <div class="col-md-2 box-public">
                <img src="assets/img/Aporte.png" class="wdt-img" alt="">
                <h3 class="txt-red">Aporte</h3>
                <p>Realizas el aporte a través de cualquiera de los medios de pago disponible</p>
            </div>
            <div class="col-md-2 box-public">
                <img src="assets/img/Entrega.png" class="wdt-img" alt="">
                <h3 class="txt-red">Entrega</h3>
                <p>Al finalizar la campaña del proyecto la productora o los encargados del proyecto se contactaran contigo para entregarte tu recompensa</p>
            </div>
        </div>
        <h2 class="title text-center" style="margin-bottom: 40px;">Quienes pueden colaborar</h2>
        <div class="col-md-3">
            <div class="bx-promo"> 
            <a href="#" >
                <img src="assets/img/fan.png" alt="" style="width:150px;"> 
                <h4>¿Eres un fanático?</h4>
            </a>
            </div>
        </div>
        <div class="col-md-3"><div class="bx-promo">
            
            <a href="#" >
            <img src="assets/img/building.png" style="width:150px;"  alt="">
            <h4> ¿Eres una marca sponsors?</h4>
            </a>
            </div></div>
        <div class="col-md-3"><div class="bx-promo"><a href="#" ><img src="assets/img/microphone.png" style="width:150px;" alt="">
         <h4> ¿Eres una productora?</h4>
         </a></div></div>
         <div class="col-md-3"><div class="bx-promo"><a href="#" ><img src="assets/img/Coffee.jpg" style="width:252px;" alt="">
         <h4> ¿eres influencer?</h4>
         </a></div></div>
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


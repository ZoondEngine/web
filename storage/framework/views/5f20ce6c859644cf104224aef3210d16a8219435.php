<?php $__env->startSection('header'); ?>

	<?php $__env->startSection('page-title', 'Авторизация'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('navbar'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<h3>Авторизация</h3><hr>
    <div class="row">
        <div class="col s6">
            <form method="post">
              <div class="row">
                <div class="input-field col s6">
                  <i class="material-icons prefix">email</i>
                  <input id="email" type="text" class="validate">
                  <label for="email">Email</label>
                </div>
                <div class="input-field col s6s">
                  <i class="material-icons prefix">lock</i>
                  <input id="password" type="password" class="validate">
                  <label for="password">Пароль</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s6">
                  <i class="material-icons prefix">lock</i>
                  <input id="catpcha" type="text" class="validate">
                  <label for="email">Captcha</label>
                </div>
                <div class="input-field col s6s">
                  Опа, а вот и каптча подьехала
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12">
                  <div class="g-recaptcha" data-sitekey="6LeuvSMUAAAAAK78mAGivjPa528WLYT46D2MBwnz"></div>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12">
                  <input class="btn green" type="submit" value="Войти">
                  <a class="btn grey darken-2 right" href="recovery.html">Восстановить пароль</a>
                </div>
              </div>
            </form>
          </div>
          <div class="col s6">
            <div class="card">
              <div class="card-image">
                <img src="Template/MD/assets/images/login2.jpg">
                <span class="card-title">Material Design</span>
              </div>
              <div class="card-content">
                <p>Я внес изменения в список возможных дизайнов для Вас.
                Теперь в этом списке есть возможность создания сайта на основе Material Design</p>
              </div>
              <div class="card-action">
                <a href="#" class="btn blue">Подробнее</a>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>

@ensection

<?php echo $__env->make('assets.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('assets.navbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('assets.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('assets.master_noauth', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
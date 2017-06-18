<?php $__env->startSection('header'); ?>
<?php echo $__env->make('assets.header', ['title' => 'Авторизация'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('navigation'); ?>
<?php echo $__env->make('assets.navbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('parallax-container'); ?>
<?php echo $__env->make('assets.parallax', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
<h3>Авторизация</h3><hr>
    <div class="row">
        <div class="col s6">
            <form method="post" id="login_form" action="">
              <div class="row">
                <div class="input-field col s6">
                  <i class="material-icons prefix">email</i>
                  <input name="email" id="email" type="text" class="validate">
                  <label id="label_email" for="email">Email</label>
                </div>
                <div class="input-field col s6s">
                  <i class="material-icons prefix">lock</i>
                  <input name="password" id="password" type="password" >
                  <label id="label_password" for="password">Пароль</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12">
                  <?php echo Captcha::display(); ?>

                </div>
              </div>
              <div class="row">
                <div class="input-field col s12">
                  <?php echo e(csrf_field()); ?>

                  <input class="btn green" id="submit" type="submit" value="Войти">
                  <a class="btn grey darken-2 right" href="recovery.html">Восстановить пароль</a>
                </div>
              </div>
              <!-- Progress bar -->
              <div class="progress">
                <!-- *** Progress bar here *** -->
              </div>
              <!-- END Progress bar -->
            </form>
          </div>
          <div class="col s6">
            <div class="card">
              <div class="card-image">
                <img src="<?php echo e(URL::asset('images/login2.jpg')); ?>">
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
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
<?php echo $__env->make('assets.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('assets.scripts', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<script>
$(document).ready(function() {

  $("#submit").attr('class', 'btn disabled');

  $("#email").focusout(function() {

    var email = $("#email").val();

    if(email == '') {
      $("#label_email").attr('data-error', '* обязательное поле');
      $("#email").attr('class', 'invalid');
      $("#submit").attr('class', 'btn disabled');
    } else {
      if(!isValidEmailAddress(email)) {
        $("#label_email").attr('data-error', '* некорректные данные');
        $("#email").attr('class', 'invalid');
        $("#submit").attr('class', 'btn disabled');
      } else {
        sendAjax(email);
      }
    }
  });
  $("#password").focusout(function() {
    if($("#password").val() == '') {
        $("#label_password").attr('data-error', '* обязательное поле');
        $("#password").attr('class', 'invalid');
        $("#submit").attr('class', 'btn disabled');
    } else {
      $("#password").attr('class', 'valid');
      if($("#email").attr('class') == 'valid') {
        $("#submit").attr('class', 'btn btn-green');
      } else {
        $("#label_email").attr('data-error', '* обязательное поле');
        $("#email").attr('class', 'invalid');
        $("#submit").attr('class', 'btn disabled');
      }
    }
  });
});

function isValidEmailAddress(emailAddress) {
        var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
        return pattern.test(emailAddress);
    }

function sendAjax(email) {
$(document).ready(function() {
  $.ajax({
    type: "POST",
    url: "<?php echo e(url('auth/ajax/login')); ?>",
    data: "email="+email,
    beforeSend: function(request) {
      return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
    },
    success: function(data) {
      if(data['style'] == 'green') {
        $("#label_email").attr('data-success', '* аккаунт существует');
        $("#email").attr('class', 'valid');
        if($("#password").attr('class') == 'valid') {
          $("#submit").attr('class', 'btn btn-green');
        } else {
          $("#label_password").attr('data-error', '* обязательное поле');
          $("#password").attr('class', 'invalid');
          $("#submit").attr('class', 'btn disabled');
        }
      } else if(data['style'] == 'red') {
        $("#label_email").attr('data-error', '* аккаунт не существует');
        $("#email").attr('class', 'invalid');
        $("#submit").attr('class', 'btn disabled');
      } else {
        $("#label_email").attr('data-error', '* системная ошибка');
        $("#email").attr('class', 'invalid');
        $("#submit").attr('class', 'btn disabled');
        Materialize.toast(data['msg'], 4000, data['style']);
      }
    }
  });
});
}
</script>
<script>
$(document).ready(function() {
  $("#login_form").submit(function() {
    var email = $("#email").val();
    var password = $("#password").val();
    $("div.progress").html("<div class='indeterminate'></div>");
    $("#email").attr('class', 'validate');
    $("#email").attr('disabled', 'disabled');
    $("#password").attr('class', 'validate');
    $("#password").attr('disabled', 'enable');
    $("#submit").attr('class', 'btn disabled');
    sendFullRequest(email, password);
    return false;
  });
});

function sendFullRequest(email, password)
{
  $(document).ready(function() {
    $.ajax({
      type: "POST",
      url: "<?php echo e(url('auth/login')); ?>",
      data: "email="+email+"&password="+password,
      beforeSend: function(request) {
        return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
      },
      success: function(data) {
        if(data['result'] == 200) {
            Materialize.toast(data['msg'], 2000, data['style']);
            setTimeout(function() {
                window.location.href = "/public/"+data['redirect'];
            }, 2000);
        } else if(data['result'] == 100) {
          $("#email").attr('class', 'valid');
          $("div.progress").html("");
          $("#password").removeAttr('disabled');
          $("#password").attr('class', 'invalid');
          $("#label_password").attr('data-error', '* неверный пароль');
          $("#submit").attr('class', 'btn btn-green');
        } else {
          $("#email").attr('class', 'valid');
          $("div.progress").html("");
          $("#password").removeAttr('disabled');
          $("#submit").attr('class', 'btn btn-green');
          Materialize.toast(data['msg'], 4000, 'yellow');
        }
      }
    });
  });
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('assets.master_noauth', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
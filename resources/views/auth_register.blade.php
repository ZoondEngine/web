@extends('assets.master_noauth')

@section('header')
@include('assets.header', ['title' => 'Регистрация'])
@endsection

@section('navigation')
@include('assets.navbar')
@endsection

@section('parallax-container')
@include('assets.parallax')
@endsection

@section('content')
<div class="container">
        <h3>Регистрация</h3><hr>
        <div class="row">
          <form class="col s12">
            <div class="row">
              <div class="input-field col s4">
                <i class="material-icons prefix">label_outline</i>
                  <input id="first_name" type="text" class="validate">
                  <label for="first_name">Имя</label>
              </div>
              <div class="input-field col s4">
                <i class="material-icons prefix">label</i>
                  <input id="last_name" type="text" class="validate">
                  <label for="last_name">Фамилия</label>
              </div>
              <div class="file-field input-field col s4">
                <div class="btn tooltipped blue" data-position="bottom" data-delay="250" data-tooltip="Не более 2МБ">
                  <span><i class="tiny material-icons left">add</i>Аватар</span>
                  <input type="file">
                </div>
                <div class="file-path-wrapper">
                  <input placeholder="Не обязательно" class="file-path validate" type="text">
                </div>
            </div>
            </div>
            <div class="row">
              <div class="input-field col s6">
                <i class="material-icons prefix">email</i>
                  <input id="email" type="text" class="validate">
                  <label id="label_email" for="email" data-error="Неверно" data-success="Отлично">EMail</label>
              </div>
              <div class="input-field col s6">
                <i class="material-icons prefix">email</i>
                  <input id="emailRepeat" type="text" class="validate">
                  <label for="emailRepeat" data-error="Поля не совпали" data-success="Отлично">Подтвердите EMail</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s6">
                <i class="material-icons prefix">lock</i>
                  <input id="password" type="password" class="validate" data-length="12">
                  <label for="password">Пароль</label>
              </div>
              <div class="input-field col s6">
                <i class="material-icons prefix">spellcheck</i>
                  <input id="passwordRepeat" type="password" class="validate" data-length="12">
                  <label for="passwordRepeat">Подтвердите пароль</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s9">
                <i class="material-icons prefix">call_split</i>
                  <input id="hashtag" type="text" class="validate" data-length="15">
                  <label id="label_hashtag" for="hashtag" data-error="ZTag должен начинаться с #" data-success="Отлично">Введите Ваш ZTag</label>
              </div>
              <div class="input-field col s3">
                <div class="btn blue tooltipped" data-position="bottom" data-delay="250" data-tooltip="Будет сгенерирован ZTag на основе введенных данных">
                  <span>Сгенерировать</span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s4">
                <i class="material-icons prefix">perm_contact_calendar</i>
                  <input placeholder="Дата рождения" type="date" class="datepicker">
              </div>
              <div class="input-field col s8">
                <i class="material-icons prefix">mode_edit</i>
                  <textarea id="textarea1" class="materialize-textarea" data-length="240"></textarea>
                  <label for="check_description">Опишите вкратце желаемый заказ</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12">
                <input class="btn green" type="submit" value="Зарегистрироваться и перейти к оформлению заказа">
              </div>
              </div>
            </div>
          </form>
      </div>
      </div>
@endsection

@section('footer')
@include('assets.footer')
@include('assets.scripts')
<script>

ajaxCheckField('email');
ajaxCheckField('hashtag');

function ajaxCheckField(field) {
  $("#"+field).focusout(function() {
    $.ajax({
      type: "POST",
      url: "{{ url('auth/register') }}",
      data: field+"="+$("#"+field).val(),
      beforeSend: function(request) {
        return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
      },
      success: function(data) {
        if(data['style'] == 'green') {
          $("#label_"+field).attr('data-success', field+' свободен');
          $("#"+field).attr('class', 'validate valid');
        } else {
          $("#label_"+field).attr('data-error', field+' не доступен');
          $("#"+field).attr('class', 'validate invalid');
        }
      },
    });
  });
}
</script>
<script>
//Materialize.toast(data['msg'], 4000, data['style']);
</script>
@endsection

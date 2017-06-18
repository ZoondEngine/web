<?php

namespace ZoondEngine\Http\Controllers\Auth\Collections;

class Answers
{
    private $answers = [];

    private static $i = null;

    public static function i()
    {
        if(static::$i == null) {
            static::$i = new Answers();
            return static::$i;
        } else {
            return static::$i;
        }
    }

    public function __construct()
    {
        $this->answers = collect([
                'account_is_exists' => 'Аккаунт уже существует. Попробуйте другой.',
                'account_registered_success' => 'Аккаунт успешно зарегистрирован. Сейчас Вы будете автоматически перенаправлены.',
                'unnamed_error' => 'Неизвестная ошибка. Обратитесь к администратору.',
                'incorrect_answer_type_login' => 'Внутрисистемная ошибка. Информация: 0x000002f', //LoginController::answer(->incorrect)
                'incorrect_answer_type_register' => 'Внутрисистемная ошибка. Информация: 0x000003f', //$this->answer(->incorrect)
                'incorrect_answer_type_short' => 'Внутрисистемная ошибка. Информация: 0x000004f', //ShortRequestsController::answer(->incorrect)
                'answer_msg_is_null' => 'Внутрисистемная ошибка. Информация: 0x000005f', //$this->answer()->send(->incorrect)
                'dispatch_type_incorrect' => 'Внутрисистемная ошибка. Информация: 0x000006f', //ShortRequestsController::dispatch(->incorrect)
                'think_type_incorrect' => 'Внутрисистемная ошибка. Информация: 0x000007f', //ShortRequestsController::think(->incorrect)
                'loginable_user_is_exists' => 'Аккаунт существует. Информация верна.',
                'loginable_user_does_not_exists' => 'Аккаунт не найден. Проверьте введенные данные.',
                'login_successful' => 'Вы вошли в систему. Сейчас Вы будете автоматически перенаправлены.',
                'login_incorrect_password' => 'Неверный пароль. Повторите попытку.',
                'login_incorrect_captcha' => 'Неверная Captcha. Повторите попытку.',
            ]);
    }

    public function get(string $key): string
    {
        if($this->answers->has($key)) {
            return $this->answers->get($key);
        } else {
            return null;
        }
    }
}

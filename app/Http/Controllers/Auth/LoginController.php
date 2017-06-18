<?php

namespace ZoondEngine\Http\Controllers\Auth;

use Illuminate\Http\Request;
use ZoondEngine\Models\Auth\Users as Users;
use ZoondEngine\Http\Controllers\Controller;
use ZoondEngine\Http\Controllers\Auth\Collections\Answers as Answers;

class LoginController extends Controller
{
    private $request;
    private $answer = [];

    private static $i = null;

    public static function i()
    {
        if(static::$i == null) {
            static::$i = new Users();
            return static::$i;
        } else {
            return static::$i;
        }
    }

    public function login(Request $request)
    {
        $this->request = $request;

        $request = null;

        return $this->manage();
    }

    private function manage()
    {
        if($this->captcha()) {
            if($this->check()) {
                return $this->make();
            } else {
                return $this->answer(1, array(
                        'result' => 100, 
                        'msg' => Answers::i()->get('login_incorrect_password')
                ))->send();
            }
        } else {
            return $this->answer(1, [
                    'result' => 100,
                    'msg' => Answers::i()->get('login_incorrect_captcha')
                ])->send();
        }
    }

    private function captcha(): bool
    {
        return true;
    }

    private function make()
    {
        Users::i()
            ->set($this->request, $this->request->email)
            ->online()
            ->session()
            ->make();

        $id = Users::where('email', $this->request->email)->first();

        return response()->json([
            'result' => 200,
            'msg' => Answers::i()->get('login_successful'),
            'style' => 'green',
            'redirect' => 'profile/'.$id['id']
        ]);
    }

    private function check(): bool
    {
        //return Users::i()->checkPassword($this->request->email, $this->request->password);
        return true;
    }

    public function around(string $email)
    {
        $this->request->email = $email;

        $this->make();
    }

    private function answer(int $type, array $msg)
    {
        if($type > 1 || $type < 0) {
            $this->answer = [
                    'result' => 75,
                    'msg' => Answers::i()->get('incorrect_answer_type_login'),
                    'style' => 'red'
                ];
        } else {
            if($type = 0)
            {
                $this->answer = [
                    'result' => $msg['result'],
                    'msg' => $msg['msg'],
                    'style' => 'green'
                ];
            } else {
                $this->answer = [
                    'result' => $msg['result'],
                    'msg' => $msg['msg'],
                    'style' => 'red'
                ];
            }
        }

        return $this;
    }

    private function send()
    {
        if(!$this->has('msg')) {
            return response()->json([
                    'result' => 75,
                    'msg' => Answers::i()->get('answer_msg_is_null'),
                    'style' => 'red'
                ]);
        } else {
            return response()->json($this->answer);
        }
    }

    private function has(string $key): bool
    {
        if($this->answer[$key] === null) {
            return false;
        } else {
            return true;
        }
    }
}

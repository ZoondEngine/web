<?php

namespace ZoondEngine\Http\Controllers\Auth;

use Illuminate\Support\Facades\Validator;
use ZoondEngine\Models\Auth\Users as Users;
use ZoondEngine\Http\Controllers\Controller;
use ZoondEngine\Http\Controllers\Auth\LoginController as Login;
use ZoondEngine\Http\Controller\Auth\Collections\Answers as Answers;

class RegisterController extends Controller
{
    private $request;
    private $answer = ['msg' => null];

    public function register(Request $request)
    {
        $this->request = $request;

        return $this->dispatch();
    }

    private function dispatch()
    {
        if($this->indatabase()) {
            return $this->answer(1, ['msg' => Answers::get('account_is_exists')])->send();
        } else {
            $this->create();
            if($this->created())
                return $this->answer(0, ['msg' => Answers::get('account_registered_success')])->enter();
            } else {
                return $this->answer(1, ['msg' => Answers::get('unnamed_error')])->send();
            }
        }
    }

    private function indatabase(): bool
    {
        if(Users::where('email', $this->request->email)->first()) {
            return true;
        } else {
            return false;
        }
    }

    private function create()
    {
        Users::i()->createUser($this->request->all());
    }

    private function created(): bool
    {
        $result = Users::$i()->result();
        return $result['result'];
    }

    private function answer(int $type, array $msg)
    {
        if($type > 1 || $type < 0) {
            $this->answer = [
                    'msg' => Answers::get('incorrect_answer_type_register'),
                    'style' => 'red'
                ];
        } else {
            if($type = 0)
            {
                $this->answer = [
                    'msg' => $msg['msg'],
                    'style' => 'green'
                ];
            } else {
                $this->answer = [
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
                    'msg' => Answers::get('answer_msg_is_null'),
                    'style' => 'red'
                ]);
        } else {
            return response()->json($this->answer);
        }
    }

    private function enter()
    {
        if(!$this->has('msg')) {
            return response()->json([
                    'msg' => Answers::get('answer_msg_is_null'),
                    'style' => 'red'
                ]);
        } else {
            $this->send($this->answer);
            return Login::i()->around($this->request->email, bcrypt($this->request->password));
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

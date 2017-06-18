<?php

namespace ZoondEngine\Http\Controllers\Auth;

use Illuminate\Http\Request;
use ZoondEngine\Models\Auth\Users as Users;
use ZoondEngine\Http\Controllers\Controller;
use ZoondEngine\Http\Controllers\Auth\Collections\Answers as Answers;

/**
 * |---------------------------------------------|
 * | Short Request Controller                    |
 * | ___________________________________________ |
 * | Dispatch short ajax requests.               |
 * | ------------------------------------------- |
 * | @author Alexey (mango) Novitskiy            |
 * | @since 2017                                 |
 * | @version 1.34.847                           |
 * | @copyright Zoond Engine Lab, All rights     |
 * | reserved. 2017(c)                           |
 * |---------------------------------------------|
 */
class ShortRequestsController extends Controller
{
	private $request;
	private $answer = ['msg' => null];

    public function login(Request $request)
    {
    	return $this->dispatcher($request, 0);
    }

    public function register(Request $request)
    {
    	return $this->dispatcher($request, 1);
    }

    private function dispatcher(Request $request, int $type)
    {
    	$this->request = $request;

    	$request = null;

    	if($type > 1 || $type < 0) {
    		return $this->answer(2, ['msg' => Answers::get('dispatch_type_incorrect')])->send();
    	} else {
    		if($type == 0) {
    			return $this->think('login');
    		} else {
    			return $this->think('register');
    		}
    	}
    }

    private function think(string $what)
    {
    	switch($what)
    	{
    		case 'login':
    		{
    			return $this->loginable();
    		}

    		case 'register':
    		{
    			return $this->registerable();
    		}

    		default:
    		{
    			return $this->answer(2, ['msg' => Answers::i()->get('think_type_incorrect')])->send();
    		}
    	}
    }

    private function loginable()
    {
    	$user = Users::where('email', $this->request->email)->first();
 
    	if($user == null) {
    		return $this->answer(1, ['msg' => Answers::i()->get('loginable_user_does_not_exists')])->send();
    	} else {
    		if($user->email == $this->request->email) {
    			return $this->answer(0, ['msg' => Answers::i()->get('loginable_user_is_exists')])->send();
    		} else {
    			return $this->answer(1, ['msg' => Answers::i()->get('loginable_user_does_not_exists')])->send();
    		}
    	}
    }

    private function registerable()
    {
    	//if(Users::where)
    }

    private function send()
    {
    	if(!$this->has('msg')) {
            return response()->json([
                    'msg' => Answers::i()->get('answer_msg_is_null'),
                    'style' => 'yellow'
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

    private function answer(int $type, array $msg)
    {
        if($type > 2 || $type < 0) {
            $this->answer = [
                    'msg' => Answers::i()->get('incorrect_answer_type_short'),
                    'style' => 'yellow'
                ];
        } else {
            if($type == 0)
            {
                $this->answer = [
                    'msg' => $msg['msg'],
                    'style' => 'green'
                ];
            } elseif($type == 1) {
                $this->answer = [
                    'msg' => $msg['msg'],
                    'style' => 'red'
                ];
            } else {
            	$this->answer = [
            		'msg' => $msg['msg'],
            		'style' => 'yellow'
            	];
            }
        }

        return $this;
    }
}

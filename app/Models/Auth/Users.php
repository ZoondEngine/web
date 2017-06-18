<?php

namespace ZoondEngine\Models\Auth;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Users extends Model
{
	private $lastAction = [];

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

    public function createUser(array $data)
    {
    	$this->create([
    			'first_name' => $data['first_name'],
    			'last_name' => $data['last_name'],
    			'avatar_path' => $data['avatar_path'],
    			'email' => $data['email'],
    			'password' => bcrypt($data['password']),
    			'ztag' => $data['ztag'],
    			'birthdate' => $data['birthdate']
    		]);

    	if(Users::where('email', $data['email'])->first()) {
    		$this->lastAction = ['msg' => 'Успешно ! Пользователь зарегистрирован.', 'result' => true];
    	} else {
    		$this->lastAction = ['msg' => 'Ошибка ! Пользователь не создан.', 'result' => false];
    	}
    }

    public function isAuth(int $id): bool
    {
    	$user = Users::find($id);
    	if($user->isOnline) {
    		return true;
    	} else {
    		return false;
    	}
    }

    public function updateUser(array $data)
    {
    	$user = Users::find($data['id']);
    	$data = $this->clearInputData($data);

    	foreach ($data as $property => $value) {
    		$user->{$property} = $value;
    	}
    }

    private function clearInputData(array $data): array
    {
    	if(isset($data['password'])) {
    		unset($data['password']);
    	}

    	return $data;
    }

    public function checkPassword(string $email, string $password): bool
    {
    	$user = $this->where('email', $email)->first();

    	$password = bcrypt($password);

    	if($user->password != $password) {
    		return false;
    	} else {
    		return true;
    	}
    }

    public function result(): array
    {
    	return $this->lastAction;
    }

    /**
     * @param Request $request
     * @param string $email
     * @return Authenticate
     */
    public function set(Request $request, string $email)
    {
        $userdata = Users::where('email', $email)->first();

        $auth = new Authenticate($request, $userdata->toArray());

        return $auth;
    }
}

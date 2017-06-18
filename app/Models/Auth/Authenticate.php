<?php

namespace ZoondEngine\Models\Auth;

use Illuminate\Http\Request;

class Authenticate extends Users
{
    private $user;
    private $making;
    private $request;

    public function __construct(string $email)
    {
      $this->user = parent::__construct($email)->get();
    }

    protected function online()
    {
      return $this->user->online;
    }

    protected function password(string $checkable)
    {
      if($this->user->password != $cheackable) {
        return false;
      } else {
        return true;
      }
    }

    public function session()
    {
        $this->making['session']['email'] = $this->user->email;
        $this->making['session']['first_name'] = $this->user->first_name;
        $this->making['session']['last_name'] = $this->user->last_name;

        return $this;
    }

    public function online()
    {
        $this->user->online = 1;

        return $this;
    }

    public function make()
    {
      session([
        'email' => $this->making['session']['email'],
        'first_name' => $this->making['session']['first_name'],
        'last_name' => $this->making['session']['last_name'],
      ]);

      parent::where('email', $this->user['email'])->update([
        'online' => $this->user->online,
      ]);
    }
}

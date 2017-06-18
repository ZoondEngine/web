<?php

namespace ZoondEngine\Models\Auth;

use Illuminate\Database\Eloquent\Model;

class Registenticate extends Gate
{
    private $data = array();

    public function __construct(array $data)
    {
      $this->data = $data;
    }

    public function turn()
    {
      return $this->exists();
    }

    private function exists(): bool
    {
      if(parent::__construct($data['email'])->get() == null) {
        return $this->create();
      } else {
        return 100;
      }
    }

    private function create()
    {
      parent::$user->email = $data['email'];
      parent::$user->first_name = $data['first_name'];
      parent::$user->last_name = $data['last_name'];
      parent::$user->password = bcrypt($data['password']);

      parent::save();

      return 200;
    }
}

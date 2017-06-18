<?php

namespace ZoondEngine\Models\Auth;

use Illuminate\Database\Eloquent\Model;

class Gate extends Model
{
    protected $table = 'users';
    
    private $user = array();

    public function __construct(string $email)
    {
      $this->user = $this->where('email', $email)->first();
    }

    protected function get(string $email)
    {
      return $this->user;
    }
}

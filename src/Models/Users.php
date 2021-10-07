<?php

namespace Source\Models;

use Stonks\DataLayer\DataLayer;

class Users extends DataLayer
{
      public function __construct()
      {
            parent::__construct('users', ['first_name', 'last_name', 'user_name',  'birthday', 'password'],'id', true);
      }
}

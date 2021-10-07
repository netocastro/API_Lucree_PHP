<?php

namespace Source\Models;

use Stonks\DataLayer\DataLayer;

class UserFriends extends DataLayer
{
      public function __construct()
      {
            parent::__construct('user_friends', ['user_id', 'friend_id'], 'id', true);
      }

      public function friend()
      {
            return (new Users())->find('user_id = :fi', "fi={$this->friend_id}")->fetch();
      }
}




<?php

namespace Source\Models;

use Stonks\DataLayer\DataLayer;

class Transfers extends DataLayer
{
      public function __construct()
      {
            parent::__construct('transfers', ['card_id', 'friend_id', 'total_to_transfer'], 'id', true);
      }
}

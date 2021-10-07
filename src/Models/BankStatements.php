<?php

namespace Source\Models;

use Stonks\DataLayer\DataLayer;

class BankStatements extends DataLayer
{
      public function __construct()
      {
            parent::__construct('bank_statement', ['user_id', 'friend_id', 'value', 'date', 'from_card'], 'id', true);
      }
}

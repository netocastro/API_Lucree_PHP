<?php

namespace Source\Models;

use Stonks\DataLayer\DataLayer;

class Cards extends DataLayer
{
      public function __construct()
      {
            parent::__construct('cards', ['title', 'pan', 'expiry_mm', 'expiry_yyyy', 'security_code', 'date'], 'id', true);
      }
}

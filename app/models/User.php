<?php

/**
 * User Class
 */

class User {
  
  use Model;

  protected $table = 'users';

  protected $allowedColumns = [
      'username',
      'email',
      'hash'
    ];
}

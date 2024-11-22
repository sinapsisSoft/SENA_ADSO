<?php

namespace App\Config;

class Filter
{

  public function __construct()
  {
    session_start();
  }

  public function logIn(): bool
  {

    return isset($_SESSION[SESSION_APP]);
  }
}

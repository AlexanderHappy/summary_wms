<?php

namespace controllers\home;

use app\action\checkAuthorization\CheckAuthorization;

class HomeController
{
  private $check;

  public function __construct()
  {
    $this->check = new CheckAuthorization();
  }

  public function index()
  {
    $this->check->checkAuthorization();
    
    $path = '/' . APP_BASE_PATH . '/goods';
    header("Location: $path");
  }
}

?>
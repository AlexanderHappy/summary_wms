<?php

namespace controllers\home;

use app\action\checkAuthorization\CheckAuthorization;

class HomeController
{ 
  public function index()
  {
    if (empty($_SESSION['login'])) {
      $checkAuth = new CheckAuthorization();
      $checkAuth->authorizate();
      return;
    }
    
    include 'app/views/home/index.php';
  }
}

?>
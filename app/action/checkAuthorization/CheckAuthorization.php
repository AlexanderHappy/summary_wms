<?php 

namespace app\action\checkAuthorization;

use controllers\auth\AuthController;

class CheckAuthorization
{
  public function checkAuthorization() {
    if (empty($_SESSION['login'])) {
      $this->authorizate();
      exit;
    }
  }

  public function authorizate()
  {
    $authController = new AuthController();
    $authController->login();
  }
}

?>
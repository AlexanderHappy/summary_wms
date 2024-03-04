<?php 

namespace app\action\checkAuthorization;

use controllers\auth\AuthController;

class CheckAuthorization
{
  public function authorizate()
  {
    $authController = new AuthController();
    $authController->login();
  }
}

?>
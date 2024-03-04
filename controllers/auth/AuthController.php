<?php

namespace controllers\auth;

use models\auth\AuthUserModel;

class AuthController
{
  public function login()
  {
    include 'app/views/auth/login.php';
  }

  public function authentication()
  {
    $_SESSION['login'] = $_POST['email'];
    $path = '/' . APP_BASE_PATH;
    header("Location: $path");
  }

  public function logout()
  {
    unset($_SESSION['login']);
    $path = '/' . APP_BASE_PATH;
    header("Location: $path");
  }
}

?>
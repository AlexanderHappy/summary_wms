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
    $email = $_POST['email'];
    $password = $_POST['password'];

    $data = [
      'email' => $email,
      'password' => $password
    ];

    $authUserModel = new AuthUserModel();
    $user = $authUserModel->findByEmail($data);
    
    if ($user && password_verify($password, $user['password'])) {
      $_SESSION['login'] = $user['user_name'];
    } else {
      $_SESSION['validation']['errors'] = 'Invalid email or password';
    }

    $path = '/' . APP_BASE_PATH;
    header("Location: $path");
  }

  public function logout()
  {
    unset($_SESSION['login'], $_SESSION['validation']);
    $path = '/' . APP_BASE_PATH;
    header("Location: $path");
    exit;
  }
}

?>
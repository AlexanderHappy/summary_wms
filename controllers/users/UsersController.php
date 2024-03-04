<?php

namespace controllers\users;

use models\users\UsersModel;

class UsersController
{
  public function index()
  {
    $usersModel = new UsersModel();
    $users = $usersModel->readAll();

    include 'app/views/users/index.php';
  }

  public function create()
  {
    include 'app/views/users/create.php';
  }

  public function store()
  {
    if (isset($_POST['user_name']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirm_password'])) {
      $password = $_POST['password'];
      $confirm_password = $_POST['confirm_password'];

      if ($password !== $confirm_password) {
        echo 'Passwords do not match';
        return;
      }

      $usersModel = new UsersModel();
      $data = [
        'user_name' => $_POST['user_name'],
        'email' => $_POST['email'],
        'password' => $_POST['password'],
      ];
      $usersModel->create($data);
    }
    $path = '/' . APP_BASE_PATH . '/users';
    header("Location: $path");
  }

  public function edit($params)
  {
    $usersModel = new UsersModel();
    $user = $usersModel->read($params['userId']);

    include 'app/views/users/edit.php';
  }

  public function update($params)
  {
    $usersModel = new UsersModel();
    $usersModel->update($params['userId'], $_POST);

    $path = '/' . APP_BASE_PATH . '/users';
    header("Location: $path");
  }

  public function delete($params)
  {
    $usersModel = new UsersModel();
    $usersModel->delete($params['userId']);

    $path = '/' . APP_BASE_PATH . '/users';
    header("Location: $path");
  }
}

?>
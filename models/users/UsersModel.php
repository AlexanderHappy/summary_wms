<?php

namespace models\users;

use models\Database;

class UsersModel
{
  private $db;

  public function __construct()
  {
    $this->db = Database::getInstance()->getConnection();

    try {
      $this->db->query("SELECT 1 FROM `users` LIMIT 1");
    } catch (\PDOException $exp) {
      $this->createTable();
    }
  }

  private function createTable()
  {
    $usersTableQuery = "CREATE TABLE IF NOT EXISTS `users` (
      `userId` INT NOT NULL AUTO_INCREMENT,
      `user_name` VARCHAR(255) NOT NULL,
      `email` VARCHAR(255) NOT NULL UNIQUE,
      `password` VARCHAR(255) NOT NULL,
      `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
      `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
      PRIMARY KEY (`userId`)
    ) ENGINE=INNODB";

    try {
      $this->db->exec($usersTableQuery);
      return true;
    } catch (\PDOException $exp) {
      echo "Something goes wrong: " . $exp->getMessage();
      return false;
    }
  }

  public function readAll()
  {
    try {
      $stmt = $this->db->query('SELECT userId, user_name, email, created_at, updated_at FROM `users`');

      $users = Array();
      while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
        array_push($users, $row);
      }
      return $users;
    } catch (\PDOException $exp) {
      echo "Something goes wrong: " . $exp->getMessage();
      return false;
    }
  }

  public function create($data)
  {
    $user_name = $data['user_name'];
    $email = $data['email'];
    $password = $data['password'];
    
    $query = "INSERT INTO `users` (user_name, email, password) VALUE (?,?,?)";

    try {
      $stmt = $this->db->prepare($query);
      $stmt->execute([$user_name, $email, password_hash($password, PASSWORD_DEFAULT)]);
      return true;
    } catch (\PDOException $exp) {
      echo "Something goes wrong: " . $exp->getMessage();
      return false;
    }
  }

  public function read($id)
  {
    $query = 'SELECT * FROM `users` WHERE userId = ?';

    try {
      $stmt = $this->db->prepare($query);
      $stmt->execute([$id]);
      $result = $stmt->fetch(\PDO::FETCH_ASSOC);
      return $result;
    } catch (\PDOException $exp) {
      echo "Something goes wrong: " . $exp->getMessage();
      return false;
    }
  }

  public function update($id, $data)
  {
    $user_name = $data['user_name'];
    $email = $data['email'];
    $password = $data['password'];

    $query = 'UPDATE `users` SET user_name = ?, email = ?, password = ? WHERE userId = ?';

    try {
      $stmt = $this->db->prepare($query);
      $stmt->execute([$user_name, $email, $password, $id]);
      return true;
    } catch (\PDOException $exp) {
      echo "Something goes wrong: " . $exp->getMessage();
      return false;
    }
  }

  public function delete($id)
  {
    $query = 'DELETE FROM `users` WHERE userId = ?';

    try {
      $stmt = $this->db->prepare($query);
      $stmt->execute([$id]);
    } catch (\PDOException $exp) {
      echo "Something goes wrong: " . $exp->getMessage();
      return false;
    }
  }
}


?>
<?php

namespace models\auth;

use models\Database;

class AuthUserModel 
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
      `email` VARCHAR(255) NOT NULL,
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

  public function register($user_name, $email, $password)
  {
    $query = 'INSERT INTO `users` (user_name, email, password) VALUES (?, ?, ?)';

    try {
      $stmt = $this->db->prepare($query);
      $stmt->execute([$user_name, $email, password_hash($password, PASSWORD_DEFAULT)]);
      return true;
    } catch (\PDOException $exp) {
      echo "Something goes wrong: " . $exp->getMessage();
      return false;
    }
  }

  public function login($email, $password)
  {
    try {
      $query = "SELECT * FROM `users WHERE email = ? LIMIT 1";

      $stmt = $this->db->prepare($query);
      $stmt->execute([$email]);
      $user = $stmt->fetch(\PDO::FETCH_ASSOC);

      if ($user && password_verify($password, $user['password'])) {
        return $user;
      }

    } catch (\PDOException $exp) {
      echo "Something goes wrong: " . $exp->getMessage();
      return false;
    }
  }

  public function findByEmail($email)
  {
    try {
      $query = "SELECT * FROM `users` WHERE email = ? LIMIT 1";

      $stmt = $this->db->prepare($query);
      $stmt->execute([$email]);
      $user = $stmt->fetch(\PDO::FETCH_ASSOC);

      return $user ? $user : false;
    } catch (\PDOException $exp) {
      echo "Something goes wrong: " . $exp->getMessage();
      return false;
    }
  }
}

?>
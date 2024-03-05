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

  public function findByEmail($data)
  {
    $email = $data['email'];
    $password = $data['password'];

    $query = "SELECT user_name, password FROM `users` WHERE email = ?";

    try {
      $stmt = $this->db->prepare($query);
      $stmt->execute([$email]);
      $result = $stmt->fetch(\PDO::FETCH_ASSOC);

      return $result;
    } catch (\PDOException $exp) {
      echo "Something goes wrong: " . $exp->getMessage();
      return false;
    }
  }
}

?>
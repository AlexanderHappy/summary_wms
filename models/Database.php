<?php

namespace models;

class Database
{
  private $conn;
  private static $instance;

  public function __construct()
  {
    $db_host = DB_HOST;
    $db_name = DB_NAME;
    $db_user = DB_USER;
    $db_pass = DB_PASS;
    
    try {
      $dsn = "mysql:dbhost=$db_host;dbname=$db_name";
      $this->conn = new \PDO($dsn, $db_user, $db_pass);
      $this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    } catch (\PDOException $exp) {
      echo 'Connect failed: ' . $exp->getMessage();
    }
  }

  public static function getInstance()
  {
    if (!isset(self::$instance)) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  public function getConnection()
  {
    return $this->conn;
  }
}

?>
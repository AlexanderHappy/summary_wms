<?php

namespace models\incomings;

use models\Database;

class IncomingsModel
{
  private $db;

  public function __construct()
  {
    $this->db = Database::getInstance()->getConnection();

    try {
      $this->db->query('SELECT 1 FROM `incomings`');
    } catch (\Throwable $th) {
      $this->createTable();
    }
  }

  private function createTable()
  {
    $incomingsTableCreateQuery = "CREATE TABLE IF NOT EXISTS `incomings` (
      
    )";
  }
}

?>
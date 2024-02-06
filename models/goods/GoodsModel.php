<?php

namespace models\goods;

use models\Database;

class GoodsModel
{
  private $db;

  public function __construct()
  {
    $this->db = Database::getInstance()->getConnection();
    
    try {
      $this->db->query("SELECT 1 FROM `goods`");
    } catch (\PDOException $exp) {
      $this->createTable();
    }
  }

  private function createTable()
  {
    $goodsCreateTableQuery = "CREATE TABLE IF NOT EXISTS `goods` (
      `id` INT NOT NULL AUTO_INCREMENT,
      `name` VARCHAR(255) DEFAULT 'Not Indicated',
      `brand` VARCHAR(255) DEFAULT 'Not Indicated',
      `stock` INT(8) DEFAULT 0,
      `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
      `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
      PRIMARY KEY (`id`)
    )";

    try {
      $this->db->exec($goodsCreateTableQuery);
    } catch (\PDOException $exp) {
      echo "Failed to create table - $exp";
      return;
    }
  }

  public function readAll()
  {
    try {
      $stmt = $this->db->query("SELECT * FROM `goods`");

      $goods = Array();
      while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
        array_push($goods, $row);
      }
      return $goods;
    } catch (\PDOException $exp) {
      echo "Failure to readAll - $exp";
      return;
    }
  }
}

?>
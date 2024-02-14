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
    $goodsTableCreateQuery = "CREATE TABLE IF NOT EXISTS `goods` (
      `good_id` INT NOT NULL AUTO_INCREMENT,
      `name` VARCHAR(255) DEFAULT 'Not Indicated',
      `brand` VARCHAR(255) DEFAULT 'Not Indicated',
      `stock` INT(8) DEFAULT 0,
      `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
      `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB";

    try {
      $this->db->exec($goodsTableCreateQuery);
    } catch (\PDOException $exp) {
      echo "Somethin goes wrong: " . $exp->getMessage();
      return false;
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
      echo "Somethin goes wrong: " . $exp->getMessage();
      return false;
    }
  }

  public function create($data)
  {
    $name = $data['name'];
    $brand = $data['brand'];
    $stock = $data['stock'];

    $query = "INSERT INTO `goods` (name, brand, stock) VALUE (?,?,?)";

    try {
      $stmt = $this->db->prepare($query);
      $stmt->execute([$name, $brand, $stock]);
      return true;
    } catch (\PDOException $exp) {
      echo "Somethin goes wrong: " . $exp->getMessage();
      return false;
    }
  }

  public function read($id)
  {
    $query = 'SELECT * FROM `goods` WHERE good_id = ?';

    try {
      $stmt = $this->db->prepare($query);
      $stmt->execute([$id]);
      $res = $stmt->fetch(\PDO::FETCH_ASSOC);
      return $res;
    } catch (\PDOException $exp) {
      echo "Somethin goes wrong: " . $exp->getMessage();
      return false;
    }
  }

  public function update($id, $data)
  {
    $name = $data['name'];
    $brand = $data['brand'];
    $stock = $data['stock'];

    $query = 'UPDATE `goods` SET name = ?, brand = ?, stock = ? WHERE good_id = ?';

    try {
      $stmt = $this->db->prepare($query);
      $stmt->execute([$name, $brand, $stock, $id]);
      return true;
    } catch (\PDOException $exp) {
      echo "Somethin goes wrong: " . $exp->getMessage();
      return false;
    }
  }

  public function delete($id)
  {
    $query = 'DELETE FROM `goods` WHERE good_id = ?';

    try {
      $stmt = $this->db->prepare($query);
      $stmt->execute([$id]);
    } catch (\PDOException $exp) {
      echo "Somethin goes wrong: " . $exp->getMessage();
      return false;
    }
  }
}

?>
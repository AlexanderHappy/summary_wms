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
      `incomings_id` INT NOT NULL AUTO_INCREMENT,
      `good_id` INT NOT NULL,
      `supplier_id` INT NOT NULL,
      `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
      `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
      INDEX `good_id` (`good_id`),
      INDEX `supplier_id` (`supplier_id`),
      CONSTRAINT `FK_Goods` FOREIGN KEY (`good_id`) REFERENCES `goods` (`goodId`) ON DELETE CASCADE,
      CONSTRAINT `FK_Suppliers` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`supplierId`) ON DELETE CASCADE,
      PRIMARY KEY (`id`)
    ) ENGINE=INNODB";
    
    try {
      $this->db->exec($incomingsTableCreateQuery);
    } catch (\PDOException $exp) {
      echo "Something goes wrong: " . $exp->getMessage();
      return false;
    }
  }

  public function readAll()
  {
    try {
      $stmt = $this->db->query('SELECT inc.incomingId,  g.good_name, g.brand, s.supplier_name, s.address, s.telephone, inc.created_at, inc.updated_at
        FROM incomings inc 
        INNER JOIN goods g ON good_id = goodId
        INNER JOIN suppliers s ON supplier_id = supplierId'
      );

      $incomings_goods = Array();
      while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
        array_push($incomings_goods, $row);
      }

      return $incomings_goods;
    } catch (\PDOException $exp) {
      echo "Somethin goes wrong: " . $exp->getMessage();
      return false;
    }
  }

  public function create($data)
  {
    $good_id = $data['good_id'];
    $supplier_id = $data['supplier_id'];

    $query = 'INSERT INTO `incomings` (good_id, supplier_id) VALUE (?, ?)';

    try {
      $stmt = $this->db->prepare($query);
      $stmt->execute([$good_id, $supplier_id]);
      return true;
    } catch (\PDOException $exp) {
      echo "Something goes wrong: " . $exp->getMessage();
      return false;
    }
  }

  public function delete($id)
  {
    $query = 'DELETE FROM `incomings` WHERE incomingId = ?';

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
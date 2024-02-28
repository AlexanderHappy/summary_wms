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
      $this->db->query("SELECT 1 FROM `incomings`");
    } catch (\Throwable $th) {
      $this->createTable();
    }
  }

  private function createTable()
  {
    $incomingsTableCreateQuery = "CREATE TABLE IF NOT EXISTS `incomings` (
      `incomingId` INT NOT NULL AUTO_INCREMENT,
      `good_id` INT NOT NULL,
      `supplier_id` INT NOT NULL,
      `total` INT DEFAULT 0,
      `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
      `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
      INDEX `good_id` (`good_id`),
      INDEX `supplier_id` (`supplier_id`),
      CONSTRAINT `FK_Goods` FOREIGN KEY (`good_id`) REFERENCES `goods` (`goodId`) ON DELETE CASCADE,
      CONSTRAINT `FK_Suppliers` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`supplierId`) ON DELETE CASCADE,
      PRIMARY KEY (`incomingId`)
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
      $stmt = $this->db->query('SELECT inc.incomingId,  g.good_name, g.brand, s.supplier_name, s.address, s.telephone, inc.total, inc.created_at, inc.updated_at
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
      echo "Something goes wrong: " . $exp->getMessage();
      return false;
    }
  }

  public function create($data)
  {
    $good_id = $data['good_id'];
    $supplier_id = $data['supplier_id'];
    $total = $data['total'];

    $query = 'INSERT INTO `incomings` (good_id, supplier_id, total) VALUE (?, ?, ?)';

    try {
      $stmt = $this->db->prepare($query);
      $stmt->execute([$good_id, $supplier_id, $total]);
      return true;
    } catch (\PDOException $exp) {
      echo "Something goes wrong: " . $exp->getMessage();
      return false;
    }
  }

  public function read($id)
  {
    $queryAll = 'SELECT inc.incomingId, g.goodId, s.supplierId,  g.good_name, g.brand, s.supplier_name, s.address, s.telephone, inc.total
      FROM incomings inc
      INNER JOIN goods g ON good_id = goodId
      INNER JOIN suppliers s ON supplier_id = supplierId
      WHERE inc.incomingId = ?';

    try {    
      $stmt = $this->db->prepare($queryAll);
      $stmt->execute([$id]);
      $read = $stmt->fetch(\PDO::FETCH_ASSOC);
      return $read;      
    } catch (\PDOException $exp) {
      echo "Something goes wrong: " . $exp->getMessage();
      return false;
    }
  }

  public function update($id, $data)
  {
    $good_id = $data['good_id'];
    $supplier_id = $data['supplier_id'];
    $total = $data['total'];
  
    $query = 'UPDATE `incomings` SET good_id = ?, supplier_id = ?, total = ? WHERE incomingId = ?';
  
    try {
      $stmt = $this->db->prepare($query);
      $stmt->execute([$good_id, $supplier_id, $total, $id]);
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
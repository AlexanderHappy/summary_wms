<?php

namespace models\outgoings;

use models\Database;

class OutgoingsModel
{
  private $db;

  public function __construct()
  {
    $this->db = Database::getInstance()->getConnection();

    try {
      $this->db->query("SELECT 1 FROM `outgoings`");
    } catch (\Throwable $th) {
      $this->createTable();
    }
  }

  private function createTable()
  {
    $outgoingsTableCreateQuery = "CREATE TABLE IF NOT EXISTS `outgoings` (
      `outgoingId` INT NOT NULL AUTO_INCREMENT,
      `good_id` INT NOT NULL,
      `customer_id` INT NOT NULL,
      `total` INT DEFAULT 0,
      `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
      `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
      INDEX `good_id` (`good_id`),
      INDEX `customer_id` (`customer_id`),
      CONSTRAINT `FK_GoodsCustomer` FOREIGN KEY (`good_id`) REFERENCES `goods` (`goodId`) ON DELETE CASCADE,
      CONSTRAINT `FK_Customers` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customerId`) ON DELETE CASCADE,
      PRIMARY KEY (`outgoingId`)
    ) ENGINE=INNODB";

    try {
      $this->db->exec($outgoingsTableCreateQuery);
    } catch (\PDOException $exp) {
      echo "Something goes wrong: " . $exp->getMessage();
      return false;
    }
  }

  public function readAll()
  {
    try {
      $stmt = $this->db->query('SELECT outg.outgoingId, g.good_name, g.brand, c.customer_name, c.address, c.telephone, outg.total, outg.created_at, outg.updated_at
      FROM outgoings outg
      INNER JOIN goods g ON good_id = goodId
      INNER JOIN customers c ON customer_id = customerId'
      );

      $outgoings_goods = Array();
      while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
        array_push($outgoings_goods, $row);
      }

      return $outgoings_goods;
    } catch (\PDOException $exp) {
      echo "Something goes wrong: " . $exp->getMessage();
      return false;
    }
  }

  public function create($data)
  {
    $good_id = $data['good_id'];
    $customer_id = $data['customer_id'];
    $total = $data['total'];

    $query = 'INSERT INTO `outgoings` (good_id, customer_id, total) VALUE (?, ?, ?)';

    try {
      $stmt = $this->db->prepare($query);
      $stmt->execute([$good_id, $customer_id, $total]);
      return true;
    } catch (\PDOException $exp) {
      echo "Something goes wrong: " . $exp->getMessage();
      return false;
    }
  }

  public function read($id)
  {
    $queryAll = 'SELECT outg.outgoingId, g.goodId, c.customerId,  g.good_name, g.brand, c.customer_name, c.address, c.telephone, outg.total
      FROM outgoings outg
      INNER JOIN goods g ON good_id = goodId
      INNER JOIN customers c ON customer_id = customerId
      WHERE outg.outgoingId = ?';

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
    $customer_id = $data['customer_id'];
    $total = $data['total'];
  
    $query = 'UPDATE `outgoings` SET good_id = ?, customer_id = ?, total = ? WHERE outgoingId = ?';
  
    try {
      $stmt = $this->db->prepare($query);
      $stmt->execute([$good_id, $customer_id, $total, $id]);
      return true;
    } catch (\PDOException $exp) {
      echo "Something goes wrong: " . $exp->getMessage();
      return false;
    }
  }

  public function delete($id)
  {
    $query = 'DELETE FROM `outgoings` WHERE outgoingId = ?';

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
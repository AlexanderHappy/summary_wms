<?php

namespace models\suppliers;

use models\Database;

class SuppliersModel
{
  private $db;

  public function __construct()
  {
    $this->db = Database::getInstance()->getConnection();

    try {
      $this->db->query('SELECT 1 FROM `suppliers`');
    } catch (\Throwable $th) {
      $this->createTable();
    }
  }

  private function createTable()
  {
    $suppliersTableCreateQuery = "CREATE TABLE IF NOT EXISTS `suppliers` (
      `supplierId` INT NOT NULL AUTO_INCREMENT,
      `supplier_name` VARCHAR(255) DEFAULT 'Not Indicated',
      `address` VARCHAR(255) DEFAULT 'Not Indicated',
      `telephone` VARCHAR(255) DEFAULT 'Not Indicated',
      `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
      `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
      PRIMARY KEY (`supplierId`)
    ) ENGINE=INNODB";

    try {
      $this->db->exec($suppliersTableCreateQuery);
      return true;
    } catch (\PDOException $exp) {
      echo "Something goes wrong: " . $exp->getMessage();
      return false;
    }
  }

  public function readAll()
  {
    try {
      $stmt = $this->db->query('SELECT * FROM `suppliers`');

      $suppliers = Array();
      while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
        array_push($suppliers, $row);
      }
      return $suppliers;
    } catch (\PDOException $exp) {
      echo "Something goes wrong: " . $exp->getMessage();
      return false;
    }
  }

  public function readAllWithException($id)
  { 
    try {
      $stmt = $this->db->query("SELECT * FROM `suppliers` WHERE supplierId != $id");

      $suppliers = Array();
      while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
        array_push($suppliers, $row);
      }
      return $suppliers;
    } catch (\PDOException $exp) {
      echo "Something goes wrong: " . $exp->getMessage();
      return false;
    }
  }

  public function create($data)
  {
    $name = $data['name'];
    $address = $data['address'];
    $telephone = $data['telephone'];

    $query = 'INSERT INTO `suppliers` (supplier_name, address, telephone) VALUE (?,?,?)';

    try {
      $stmt = $this->db->prepare($query);
      $stmt->execute([$name, $address, $telephone]);
      return true;
    } catch (\PDOException $exp) {
      echo "Something goes wrong: " . $exp->getMessage();
      return false;
    }
  }

  public function read($id)
  {
    $query = 'SELECT * FROM `suppliers` WHERE supplierId = ?';

    try {
      $stmt = $this->db->prepare($query);
      $stmt->execute([$id]);
      $res = $stmt->fetch(\PDO::FETCH_ASSOC);
      return $res;
    } catch (\PDOException $exp) {
      echo "Something goes wrong: " . $exp->getMessage();
      return false;
    }
  }

  public function update($id, $data)
  {
    $name = $data['name'];
    $address = $data['address'];
    $telephone = $data['telephone'];

    $query = 'UPDATE `suppliers` SET supplier_name = ?, address = ?, telephone = ? WHERE supplierId = ?';

    try {
      $stmt = $this->db->prepare($query);
      $stmt->execute([$name, $address, $telephone, $id]);
      return true;
    } catch (\PDOException $exp) {
      echo "Something goes wrong: " . $exp->getMessage();
      return false;
    }
  }

  public function delete($id)
  {
    $query = 'DELETE FROM `suppliers` WHERE supplierId = ?';

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
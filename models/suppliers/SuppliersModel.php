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
      `id` INT NOT NULL AUTO_INCREMENT,
      `name` VARCHAR(255) DEFAULT 'Not Indicated',
      `address` VARCHAR(255) DEFAULT 'Not Indicated',
      `telephone` VARCHAR(255) DEFAULT 'Not Indicated',
      `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
      `update_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
      PRIMARY KEY (`id`)
    )";

    try {
      $this->db->exec($suppliersTableCreateQuery);
    } catch (\PDOException $exp) {
      echo "Somethin goes wrong: " . $exp->getMessage();
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
    } catch (\PDOException $exp) {
      echo "Somethin goes wrong: " . $exp->getMessage();
      return false;
    }
  }

  public function create($data)
  {
    $name = $data['name'];
    $address = $data['address'];
    $telephone = $data['telephone'];

    $query = 'INSERT INTO `suppliers` (name, address, telephone) VALUE (?,?,?)';

    try {
      $stmt = $this->db->prepare($query);
      $stmt->execute([$name, $address, $telephone]);
      return true;
    } catch (\PDOException $exp) {
      echo "Somethin goes wrong: " . $exp->getMessage();
      return false;
    }
  }

  public function read($id)
  {
    $query = 'SELECT * FROM `suppliers` WHERE id = ?';

    try {
      $stmt = $this->db->prepare($query);
      $stmt->execute([$id]);
      $res = $stmt->fetch(\PDO::FETCH_ASSOC);
    } catch (\PDOException $exp) {
      echo "Somethin goes wrong: " . $exp->getMessage();
      return false;
    }
  }

  public function update($id, $data)
  {
    $name = $data['name'];
    $address = $data['address'];
    $telephone = $data['telephone'];

    $query = 'UPDATE `suppliers` SET name = ?, address = ?, telephone = ? WHERE id = ?';

    try {
      $stmt = $this->db->prepare($query);
      $stmt->execute([$name, $address, $telephone, $id]);
      return true;
    } catch (\PDOException $exp) {
      echo "Somethin goes wrong: " . $exp->getMessage();
      return false;
    }
  }

  public function delete($id)
  {
    $query = 'DELETE FROM `suppliers` WHERE id = ?';

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
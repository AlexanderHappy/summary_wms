<?php

namespace models\customers;

use models\Database;

class CustomersModel 
{
  private $db;

  public function __construct()
  {
    $this->db = Database::getInstance()->getConnection();

    try {
      $this->db->query('SELECT 1 FROM `customers`');
    } catch (\Throwable $th) {
      $this->createTable();
    }
  }

  private function createTable()
  {
    $customersTableCreateQuery = "CREATE TABLE IF NOT EXISTS `customers` (
      `customer_id` INT NOT NULL AUTO_INCREMENT,
      `name` VARCHAR(255) DEFAULT 'Not Indicated',
      `address` VARCHAR(255) DEFAULT 'Not Indicated',
      `telephone` VARCHAR(255) DEFAULT 'Not Indicated',
      `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
      `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB";

    try {
      $this->db->exec($customersTableCreateQuery);
    } catch (\PDOException $exp) {
      echo "Somethin goes wrong: " . $exp->getMessage();
      return false;
    }
  }

  public function readAll()
  {
    try {
      $stmt = $this->db->query('SELECT * FROM `customers`');

      $customers = Array();
      while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
        array_push($customers, $row);
      }
      return $customers;
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

    $query = 'INSERT INTO `customers` (name, address, telephone) VALUE (?,?,?)';

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
    $query = 'SELECT * FROM `customers` WHERE customer_id = ?';

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
    $address = $data['address'];
    $telephone = $data['telephone'];

    $query = 'UPDATE `customers` SET name = ?, address = ?, telephone = ? WHERE customer_id = ?';

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
    $query = 'DELETE FROM `customers` WHERE customer_id = ?';

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
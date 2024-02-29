<?php

namespace models\incomingsPDFGenerate;

use models\Database;

class IncomingsPDFGenerateModel
{
  private $db;

  public function __construct()
  {
    $this->db = Database::getInstance()->getConnection();

    try {
      $this->db->query("SELECT 1 FROM `incomings`");
    } catch (\PDOException $exp) {
      echo "Tabel 'incomings' doesn't exist: " . $exp->getMessage();
      return false;
    }
  }

  public function takeAll()
  {
    try {
      $stmt = $this->db->query('SELECT g.good_name, g.brand, s.supplier_name, s.address, s.telephone, inc.total, inc.created_at, inc.updated_at
      FROM incomings inc
      INNER JOIN goods g ON good_id = goodId
      INNER JOIN suppliers s ON supplier_id = supplierId'
      );

      $incomings_goods = Array();
      $totalAmount = 0;
      while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
        array_push($incomings_goods, $row);
        $totalAmount += $row['total'];
      }

      return ['data' => $incomings_goods, 'sum' => $totalAmount];
    } catch (\PDOException $exp) {
      echo "Something goes wrong: " . $exp->getMessage();
      return false;
    }
  }
}

?>
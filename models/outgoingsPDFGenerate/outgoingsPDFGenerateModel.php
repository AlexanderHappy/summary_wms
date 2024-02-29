<?php

namespace models\outgoingsPDFGenerate;

use models\Database;

class OutgoingsPDFGenerateModel
{
  private $db;

  public function __construct()
  {
    $this->db = Database::getInstance()->getConnection();

    try {
      $this->db->query("SELECT 1 FROM `outgoings`");
    } catch (\PDOException $exp) {
      echo "Tabel 'outgoings' doesn't exist: " . $exp->getMessage();
      return false;
    }
  }

  public function takeAll()
  {
    try {
      $stmt = $this->db->query("SELECT g.good_name, g.brand, c.customer_name, c.address, c.telephone, outg.total, 
      outg.created_at, outg.updated_at
      FROM outgoings outg
      INNER JOIN goods g ON good_id = goodId
      INNER JOIN customers c ON customer_id = customerId"
      );

      $outgoings_goods = Array();
      $totalAmount = 0;
      while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
        array_push($outgoings_goods, $row);
        $totalAmount += $row['total'];
      }

      return ['data' => $outgoings_goods, 'sum' => $totalAmount];
    } catch (\PDOException $exp) {
      echo "Something goes wrong: " . $exp->getMessage();
      return false;
    }
  }
}

?>
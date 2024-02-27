<?php

namespace models\outgoingsReport;

use models\Database;

class OutgoingsReportModel
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

  public function readAll()
  {
    try {
      $stmt = $this->db->query("SELECT g.good_name, outg.total
      FROM outgoings outg
      INNER JOIN goods g ON good_id = goodId"
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
}

?>
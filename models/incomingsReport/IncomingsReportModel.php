<?php

namespace models\incomingsReport;

use models\Database;

class IncomingsReportModel
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

  public function readAll()
  {
    try {
      $stmt = $this->db->query("SELECT g.good_name, inc.total
      FROM incomings inc
      INNER JOIN goods g ON good_id = goodId"
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
}

?>
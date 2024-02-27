<?php

namespace controllers\outgoingsReport;

use models\outgoingsReport\OutgoingsReportModel;

class OutgoingsReportController
{
  public function index()
  {
    $outgoingsReportModel = new OutgoingsReportModel();
    $outgoings = $outgoingsReportModel->readAll();

    include 'app/views/outgoingsReport/index.php';
  }
}

?>
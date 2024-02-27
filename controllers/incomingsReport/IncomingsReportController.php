<?php

namespace controllers\incomingsReport;

use models\incomingsReport\IncomingsReportModel;

class IncomingsReportController
{
  public function index()
  {
    $incomingsReportModel = new IncomingsReportModel();
    $incomings = $incomingsReportModel->readAll();

    include 'app/views/incomingsReport/index.php';
  }
}

?>
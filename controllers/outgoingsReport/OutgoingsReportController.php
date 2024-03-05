<?php

namespace controllers\outgoingsReport;

use models\outgoingsReport\OutgoingsReportModel;
use app\action\checkAuthorization\CheckAuthorization;

class OutgoingsReportController
{
  private $check;

  public function __construct()
  {
    $this->check = new CheckAuthorization();
  }

  public function index()
  {
    $this->check->checkAuthorization();
    
    $outgoingsReportModel = new OutgoingsReportModel();
    $outgoings = $outgoingsReportModel->readAll();

    include 'app/views/outgoingsReport/index.php';
  }
}

?>
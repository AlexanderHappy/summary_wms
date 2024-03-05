<?php

namespace controllers\incomingsReport;

use models\incomingsReport\IncomingsReportModel;
use app\action\checkAuthorization\CheckAuthorization;

class IncomingsReportController
{
  private $check;

  public function __construct()
  {
    $this->check = new CheckAuthorization();
  }

  public function index()
  {
    $this->check->checkAuthorization();

    $incomingsReportModel = new IncomingsReportModel();
    $incomings = $incomingsReportModel->readAll();

    include 'app/views/incomingsReport/index.php';
  }
}

?>
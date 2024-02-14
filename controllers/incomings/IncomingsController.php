<?php

namespace controllers\incomings;

use models\incomings\IncomingsModel;

class IncomingsController
{
  public function index()
  {
    $incomingsModel = new IncomingsModel();
    $incomings = $incomingsModel->readAll();
    include 'app/views/incomings/index.php';
  }
}

?>
<?php

namespace controllers\incomingsGeneratePDF;

use models\incomingsPDFGenerate\IncomingsPDFGenerateModel;
use app\action\checkAuthorization\CheckAuthorization;

class IncomingsGeneratePDFController
{
  private $check;

  public function __construct()
  {
    $this->check = new CheckAuthorization();
  }

  public function index()
  {
    $this->check->checkAuthorization();

    $incomingsPDFGenerateModel = new IncomingsPDFGenerateModel();
    $pdfData = $incomingsPDFGenerateModel->takeAll();
    
    include 'app/action/generatePDF/incomingsGoods/generate-pdf.php';
  }
}

?>
<?php

namespace controllers\outgoingsGeneratePDF;

use models\outgoingsPDFGenerate\OutgoingsPDFGenerateModel;
use app\action\checkAuthorization\CheckAuthorization;

class OutgoingsGeneratePDFController
{
  private $check;

  public function __construct()
  {
    $this->check = new CheckAuthorization();
  }

  public function index()
  {
    $this->check->checkAuthorization();

    $outgoingsPDFGenerateModel = new OutgoingsPDFGenerateModel();
    $pdfData = $outgoingsPDFGenerateModel->takeAll();
    
    include 'app/action/generatePDF/outgoingsGoods/generate-pdf.php';
  }
}

?>
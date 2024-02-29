<?php

namespace controllers\incomingsGeneratePDF;

use models\incomingsPDFGenerate\IncomingsPDFGenerateModel;

class IncomingsGeneratePDFController
{
  public function index()
  {
    $incomingsPDFGenerateModel = new IncomingsPDFGenerateModel();
    $pdfData = $incomingsPDFGenerateModel->takeAll();
    
    include 'app/action/generatePDF/incomingsGoods/generate-pdf.php';
  }
}

?>
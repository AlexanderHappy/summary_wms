<?php

namespace controllers\outgoingsGeneratePDF;

use models\outgoingsPDFGenerate\OutgoingsPDFGenerateModel;

class OutgoingsGeneratePDFController
{
  public function index()
  {
    $outgoingsPDFGenerateModel = new OutgoingsPDFGenerateModel();
    $pdfData = $outgoingsPDFGenerateModel->takeAll();
    
    include 'app/action/generatePDF/outgoingsGoods/generate-pdf.php';
  }
}

?>
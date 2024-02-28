<?php

namespace controllers\generatePDF;

class GeneratePDFController
{
  public function index()
  {
    include 'app/action/generatePDF/generate-pdf.php';
  }
}

?>
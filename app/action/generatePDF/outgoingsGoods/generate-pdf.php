<?php

// tte($path);

ob_start();
require_once('app/action/generatePDF/outgoingsGoods/template.php');
$html = ob_get_contents();
ob_end_clean();

require_once 'app/action/generatePDF/vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

$options = new Options;
$path = "C:\\xampp\\htdocs\\" . APP_BASE_PATH . "\\app\\styles\\picture\\logo.png";
$options->setChroot($path);

$dompdf = new Dompdf($options);

$dompdf->loadHtml($html);

$dompdf->render();

$dompdf->stream('Outgoings Goods.pdf', ['Attachment'=>'0']);

?>
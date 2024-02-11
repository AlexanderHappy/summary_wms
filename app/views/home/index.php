<?php
ob_start();
$title = 'Home Page!';
$link = "<a href='/record_wms/'>Dashboard</a> / ";
?>

<p>When will this end?</p>

<?php
$content = ob_get_clean();
include 'app/views/layout.php';
?>
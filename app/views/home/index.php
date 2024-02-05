<?php
ob_start();
$title = 'Home Page!';
?>

<p>When will this end?</p>

<?php
$content = ob_get_clean();
include 'app/views/layout.php';
?>
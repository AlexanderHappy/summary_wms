<?php
function tt($str){
  echo "<pre>";
    print_r($str);
  echo "</pre>";
}
function tte($str){
  echo "<pre>";
    print_r($str);
  echo "</pre>";
  exit();
}


define('APP_BASE_PATH', 'summary_wms');

define('DB_HOST', 'localhost');
define('DB_NAME', 'wms');
define('DB_USER', 'root');
define('DB_PASS', '');

?>
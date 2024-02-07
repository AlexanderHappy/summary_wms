<?php

spl_autoload_register(function($class) {
  $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
  $class_path = __DIR__ . DIRECTORY_SEPARATOR . $class . '.php';

  if (file_exists($class_path)) {
    require_once $class_path;
    return;
  }
  throw new Exception("Something goes wrong with $class_path");
});

?>
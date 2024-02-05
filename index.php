<?php

require_once 'config.php';
require_once 'autoload.php';

use app\Router;

$router = new Router();
$router->run();

?>
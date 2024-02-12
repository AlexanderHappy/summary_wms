<?php

namespace app;

class Router 
{
  private $routes = [
    '/^\/' . APP_BASE_PATH . '\/?$/' => ['controller' => 'home\\HomeController', 'action' => 'index'],
    '/^\/' . APP_BASE_PATH . '\/goods(\/(?P<action>[a-z]+)?)?$/' => ['controller' => 'goods\\GoodsController'],
  ];

  public function run()
  {
    $uri = $_SERVER['REQUEST_URI'];
    $controller = null;
    $action = null;

    foreach ($this->routes as $pattern => $route) {
      if (preg_match($pattern, $uri, $matches)) {
        $controller = 'controllers\\' . $route['controller'];
        $action = $route['action'] ?? $matches['action'] ?? 'index';
      }
    }

    if (!$controller) {
      http_response_code(404);
      echo "Something goes wrong with - $controller";
      return;
    }

    $controllerInstance = new $controller();
    if (!method_exists($controllerInstance, $action)) {
      http_response_code(404);
      echo "Something goes wrong with $controller";
      return;
    }

    call_user_func([$controllerInstance, $action]);
  }
}

?>
<?php

namespace app;

class Router
{
  private $routes = [
    '/^\/' . APP_BASE_PATH . '\/?$/' => ['controller' => 'home\\HomeController', 'action' => 'index'],
    '/^\/' . APP_BASE_PATH . '\/goods\/?$/' => ['controller' => 'goods\\GoodsController'],
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
      echo "Controller doesn't work $controller";
      return;
    }

    $controllerInstance = new $controller();
    if (!method_exists($controllerInstance, $action)) {
      http_response_code(404);
      echo "Method $action of class $controllerInstance doesn't work";
      return;
    }

    call_user_func([$controllerInstance, $action]);
  }
}

?>
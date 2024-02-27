<?php

namespace app;

class Router 
{
  private $routes = [
    '/^\/' . APP_BASE_PATH . '\/?$/' => ['controller' => 'home\\HomeController', 'action' => 'index'],
    '/^\/' . APP_BASE_PATH . '\/goods(\/(?P<action>[a-z]+)(\/(?P<goodId>\d+))?)?$/' => ['controller' => 'goods\\GoodsController'],
    '/^\/' . APP_BASE_PATH . '\/suppliers(\/(?P<action>[a-z]+)(\/(?P<supplierId>\d+))?)?$/' => ['controller' => 'suppliers\\SuppliersController'],
    '/^\/' . APP_BASE_PATH . '\/customers(\/(?P<action>[a-z]+)(\/(?P<customerId>\d+))?)?$/' => ['controller' => 'customers\\CustomersController'],
    '/^\/' . APP_BASE_PATH . '\/incomings(\/(?P<action>[a-z]+)(\/(?P<incomingId>\d+))?)?$/' => ['controller' => 'incomings\\IncomingsController'],
    '/^\/' . APP_BASE_PATH . '\/outgoings(\/(?P<action>[a-z]+)(\/(?P<outgoingId>\d+))?)?$/' => ['controller' => 'outgoings\\OutgoingsController'],
  ];

  public function run()
  {
    $uri = $_SERVER['REQUEST_URI'];
    $controller = null;
    $action = null;
    $params = null;

    foreach ($this->routes as $pattern => $route) {
      if (preg_match($pattern, $uri, $matches)) {
        $controller = 'controllers\\' . $route['controller'];
        $action = $route['action'] ?? $matches['action'] ?? 'index';
        $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
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

    call_user_func_array([$controllerInstance, $action], [$params]);
  }
}

?>
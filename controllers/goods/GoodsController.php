<?php

namespace controllers\goods;

use models\goods\GoodsModel;
use app\action\checkAuthorization\CheckAuthorization;

class GoodsController
{
  private $check;

  public function __construct()
  {
    $this->check = new CheckAuthorization();
  }

  public function index()
  {
    $this->check->checkAuthorization();

    $goodsModel = new GoodsModel();
    $goods = $goodsModel->readAll();
    include 'app/views/goods/index.php';
  }

  public function create()
  {
    $this->check->checkAuthorization();

    include 'app/views/goods/create.php';
  }

  public function store() 
  {
    $this->check->checkAuthorization();

    if (isset($_POST['name']) && isset($_POST['brand']) && isset($_POST['stock'])) {
      $goodsModel = new GoodsModel();
      $data = [
        'name' => $_POST['name'],
        'brand' => $_POST['brand'],
        'stock' => $_POST['stock']
      ];
      $goodsModel->create($data);
    }
    
    $path = '/' . APP_BASE_PATH . '/goods';
    header("Location: $path");
  }

  public function edit($params)
  {
    $this->check->checkAuthorization();

    $goodsModel = new GoodsModel();
    $good = $goodsModel->read($params['goodId']);

    include 'app/views/goods/edit.php';
  }

  public function update($params)
  {
    $this->check->checkAuthorization();

    $goodsModel = new GoodsModel();
    $goodsModel->update($params['goodId'], $_POST);

    $path = '/' . APP_BASE_PATH . '/goods';
    header("Location: $path");
  }

  public function delete($params)
  {
    $this->check->checkAuthorization();

    $goodsModel = new GoodsModel();
    $goodsModel->delete($params['goodId']);

    $path = '/' . APP_BASE_PATH . '/goods';
    header("Location: $path");
  }
}

?>
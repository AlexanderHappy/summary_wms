<?php

namespace controllers\goods;

use models\goods\GoodsModel;

class GoodsController
{
  public function index()
  {
    $goodsModel = new GoodsModel();
    $goods = $goodsModel->readAll();
    include 'app/views/goods/index.php';
  }

  public function create()
  {
    include 'app/views/goods/create.php';
  }

  public function store() 
  {
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
    $goodsModel = new GoodsModel();
    $good = $goodsModel->read($params['id']);

    include 'app/views/goods/edit.php';
  }

  public function update($params)
  {
    $goodsModel = new GoodsModel();
    $goodsModel->update($params['id'], $_POST);

    $path = '/' . APP_BASE_PATH . '/goods';
    header("Location: $path");
  }

  public function delete($params)
  {
    $goodsModel = new GoodsModel();
    $goodsModel->delete($params['id']);

    $path = '/' . APP_BASE_PATH . '/goods';
    header("Location: $path");
  }
}

?>
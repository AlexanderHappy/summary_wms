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
}

?>
<?php

namespace controllers\incomings;

use models\incomings\IncomingsModel;
use models\goods\GoodsModel;
use models\suppliers\SuppliersModel;

class IncomingsController
{
  public function index()
  {
    $incomingsModel = new IncomingsModel();
    $incomings = $incomingsModel->readAll();
    include 'app/views/incomings/index.php';
  }

  public function create()
  {
    $goodsModel = new GoodsModel();
    $goods = $goodsModel->readAll();

    $suppliersModel = new SuppliersModel();
    $suppliers = $suppliersModel->readAll();

    include 'app/views/incomings/create.php';
  }

  public function store() {
    if (isset($_POST['good_id']) && isset($_POST['supplier_id'])) {
      $incomingsModel = new IncomingsModel();
      $data = [
        'good_id' => $_POST['good_id'],
        'supplier_id' => $_POST['supplier_id']
      ];
      $incomingsModel->create($data);
    }

    $path = '/' . APP_BASE_PATH . '/incomings';
    header("Location: $path");
  }

  public function delete($params)
  {
    $incomingsModel = new IncomingsModel();
    $incomingsModel->delete($params['incomingId']);

    $path = '/' . APP_BASE_PATH . '/incomings';
    header("Location: $path");
  }
}

?>
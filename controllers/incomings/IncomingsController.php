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

  public function store() 
  {
    if (isset($_POST['good_id']) && isset($_POST['supplier_id']) && isset($_POST['total'])) {
      $incomingsModel = new IncomingsModel();
      $data = [
        'good_id' => $_POST['good_id'],
        'supplier_id' => $_POST['supplier_id'],
        'total' => $_POST['total']
      ];
      $incomingsModel->create($data);
    }

    $path = '/' . APP_BASE_PATH . '/incomings';
    header("Location: $path"); 
  }

  public function edit($params) 
  {
    $incomingsModel = new IncomingsModel();
    $incoming = $incomingsModel->read($params['incomingId']);
    
    $goodIdException = $incoming['goodId'];
    $goodsModel = new GoodsModel();
    $goods = $goodsModel->readAllWithException($goodIdException);

    $supplierIdException = $incoming['supplierId'];
    $suppliersModel = new SuppliersModel();
    $suppliers = $suppliersModel->readAllWithException($supplierIdException);
    
    include 'app/views/incomings/edit.php';
  }

  public function update($params) 
  {
    $incomingsModel = new IncomingsModel();
    $incomingsModel->update($params['incomingId'], $_POST);

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
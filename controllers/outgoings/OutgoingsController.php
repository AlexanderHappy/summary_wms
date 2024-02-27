<?php

namespace controllers\outgoings;

use models\outgoings\OutgoingsModel;
use models\goods\GoodsModel;
use models\customers\CustomersModel;

class OutgoingsController
{
  public function index()
  {
    $outgoingsModel = new OutgoingsModel();
    $outgoings = $outgoingsModel->readAll();

    include 'app/views/outgoings/index.php';
  }

  public function create()
  {
    $goodsModel = new GoodsModel();
    $goods = $goodsModel->readAll();

    $customersModel = new CustomersModel();
    $customers = $customersModel->readAll();

    include 'app/views/outgoings/create.php';
  }

  public function store()
  {
    if (isset($_POST['good_id']) && isset($_POST['customer_id']) && isset($_POST['total'])) {
      $outgoingsModel = new OutgoingsModel();
      $data = [
        'good_id' => $_POST['good_id'],
        'customer_id' => $_POST['customer_id'],
        'total' => $_POST['total']
      ];
      $outgoingsModel->create($data);
    }

    $path = '/' . APP_BASE_PATH . '/outgoings';
    header("Location: $path");
  }

  public function edit($params)
  {
    $outgoingsModel = new OutgoingsModel();
    $outgoing = $outgoingsModel->read($params['outgoingId']);

    $goodIdException = $outgoing['goodId'];
    $goodsModel = new GoodsModel();
    $goods = $goodsModel->readAllWithException($goodIdException);

    $customerIdException = $outgoing['customerId'];
    $customersModel = new CustomersModel();
    $customers = $customersModel->readAllWithException($customerIdException);

    include 'app/views/outgoings/edit.php';;
  }

  public function update($params) 
  {
    $outgoingsModel = new OutgoingsModel();
    $outgoingsModel->update($params['outgoingId'], $_POST);

    $path = '/' . APP_BASE_PATH . '/outgoings';
    header("Location: $path");
  }

  public function delete($params)
  {
    $outgoingsModel = new OutgoingsModel();
    $outgoingsModel->delete($params['outgoingId']);

    $path = '/' . APP_BASE_PATH . '/outgoings';
    header("Location: $path");
  }
}

?>
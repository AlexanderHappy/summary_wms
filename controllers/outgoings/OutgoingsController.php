<?php

namespace controllers\outgoings;

use models\outgoings\OutgoingsModel;
use models\goods\GoodsModel;
use models\customers\CustomersModel;
use app\action\checkAuthorization\CheckAuthorization;

class OutgoingsController
{
  private $check;

  public function __construct()
  {
    $this->check = new CheckAuthorization();
  }

  public function index()
  {
    $this->check->checkAuthorization();

    $outgoingsModel = new OutgoingsModel();
    $outgoings = $outgoingsModel->readAll();

    include 'app/views/outgoings/index.php';
  }

  public function create()
  {
    $this->check->checkAuthorization();

    $goodsModel = new GoodsModel();
    $goods = $goodsModel->readAll();

    $customersModel = new CustomersModel();
    $customers = $customersModel->readAll();

    include 'app/views/outgoings/create.php';
  }

  public function store()
  {
    $this->check->checkAuthorization();
    
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
    $this->check->checkAuthorization();

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
    $this->check->checkAuthorization();

    $outgoingsModel = new OutgoingsModel();
    $outgoingsModel->update($params['outgoingId'], $_POST);

    $path = '/' . APP_BASE_PATH . '/outgoings';
    header("Location: $path");
  }

  public function delete($params)
  {
    $this->check->checkAuthorization();

    $outgoingsModel = new OutgoingsModel();
    $outgoingsModel->delete($params['outgoingId']);

    $path = '/' . APP_BASE_PATH . '/outgoings';
    header("Location: $path");
  }
}

?>
<?php

namespace controllers\incomings;

use models\incomings\IncomingsModel;
use models\goods\GoodsModel;
use models\suppliers\SuppliersModel;
use app\action\checkAuthorization\CheckAuthorization;

class IncomingsController
{
  private $check;

  public function __construct()
  {
    $this->check = new CheckAuthorization();
  }

  public function index()
  {
    $this->check->checkAuthorization();

    $incomingsModel = new IncomingsModel();
    $incomings = $incomingsModel->readAll();
    
    include 'app/views/incomings/index.php';
  }

  public function create()
  {
    $this->check->checkAuthorization();

    $goodsModel = new GoodsModel();
    $goods = $goodsModel->readAll();

    $suppliersModel = new SuppliersModel();
    $suppliers = $suppliersModel->readAll();

    include 'app/views/incomings/create.php';
  }

  public function store() 
  {
    $this->check->checkAuthorization();
    
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
    $this->check->checkAuthorization();

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
    $this->check->checkAuthorization();

    $incomingsModel = new IncomingsModel();
    $incomingsModel->update($params['incomingId'], $_POST);

    $path = '/' . APP_BASE_PATH . '/incomings';
    header("Location: $path");
  }

  public function delete($params)
  {
    $this->check->checkAuthorization();

    $incomingsModel = new IncomingsModel();
    $incomingsModel->delete($params['incomingId']);

    $path = '/' . APP_BASE_PATH . '/incomings';
    header("Location: $path");
  }
}

?>
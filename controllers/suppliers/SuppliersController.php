<?php

namespace controllers\suppliers;

use models\suppliers\SuppliersModel;
use app\action\checkAuthorization\CheckAuthorization;

class SuppliersController
{
  private $check;

  public function __construct()
  {
    $this->check = new CheckAuthorization();
  }

  public function index()
  {
    $this->check->checkAuthorization();

    $suppliersModel = new SuppliersModel();
    $suppliers = $suppliersModel->readAll();
    include 'app/views/suppliers/index.php';
  }

  public function create()
  {
    $this->check->checkAuthorization();

    include 'app/views/suppliers/create.php';
  }

  public function store()
  {
    $this->check->checkAuthorization();

    if (isset($_POST['name']) && isset($_POST['address']) && isset($_POST['telephone'])) {
      $suppliersModel = new SuppliersModel();
      $data = [
        'name' => $_POST['name'],
        'address' => $_POST['address'],
        'telephone' => $_POST['telephone']
      ];
      $suppliersModel->create($data);
    }

    $path = '/' . APP_BASE_PATH . '/suppliers';
    header("Location: $path");
  }

  public function edit($params)
  {
    $this->check->checkAuthorization();

    $suppliersModel = new SuppliersModel();
    $supplier = $suppliersModel->read($params['supplierId']);

    include 'app/views/suppliers/edit.php';
  }

  public function update($params)
  {
    $this->check->checkAuthorization();

    $suppliersModel = new SuppliersModel();
    $suppliersModel->update($params['supplierId'], $_POST);

    $path = '/' . APP_BASE_PATH . '/suppliers';
    header("Location: $path");
  }

  public function delete($params)
  {
    $this->check->checkAuthorization();

    $suppliersModel = new SuppliersModel();
    $suppliersModel->delete($params['supplierId']);

    $path = '/' . APP_BASE_PATH . '/suppliers';
    header("Location: $path");
  }
}

?>
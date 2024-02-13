<?php

namespace controllers\suppliers;

use models\suppliers\SuppliersModel;

class SuppliersController
{
  public function index()
  {
    $suppliersModel = new SuppliersModel();
    $suppliers = $suppliersModel->readAll();
    include 'app/views/suppliers/index.php';
  }

  public function create()
  {
    include 'app/views/suppliers/create.php';
  }

  public function store()
  {
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
    $suppliersModel = new SuppliersModel();
    $supplier = $suppliersModel->read($params['id']);

    include 'app/views/suppliers/edit.php';
  }

  public function update($params)
  {
    $suppliersModel = new SuppliersModel();
    $suppliersModel->update($params['id'], $_POST);

    $path = '/' . APP_BASE_PATH . '/suppliers';
    header("Location: $path");
  }

  public function delete($params)
  {
    $suppliersModel = new SuppliersModel();
    $suppliersModel->delete($params['id']);

    $path = '/' . APP_BASE_PATH . '/suppliers';
    header("Location: $path");
  }
}

?>
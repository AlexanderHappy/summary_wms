<?php

namespace controllers\customers;

use models\customers\CustomersModel;


class CustomersController
{
  public function index()
  {
    $customersModel = new CustomersModel();
    $customers = $customersModel->readAll();
    include 'app/views/customers/index.php';
  }

  public function create()
  {
    include 'app/views/customers/create.php';
  }

  public function store()
  {
    if (isset($_POST['name']) && isset($_POST['address']) && isset($_POST['telephone'])) {
      $customersModel = new CustomersModel();
      $data = [
        'name' => $_POST['name'],
        'address' => $_POST['address'],
        'telephone' => $_POST['telephone']
      ];
      $customersModel->create($data);
    }

    $path = '/' . APP_BASE_PATH . '/customers';
    header("Location: $path");
  }

  public function edit($params)
  {
    $customersModel = new CustomersModel();
    $customer = $customersModel->read($params['id']);

    include 'app/views/customers/edit.php';
  }

  public function update($params)
  {
    $customersModel = new CustomersModel();
    $customersModel->update($params['id'], $_POST);

    $path = '/' . APP_BASE_PATH . '/customers';
    header("Location: $path");
  }

  public function delete($params)
  {
    $customersModel = new CustomersModel();
    $customersModel->delete($params['id']);

    $path = '/' . APP_BASE_PATH . '/customers';
    header("Location: $path");
  }
}

?>
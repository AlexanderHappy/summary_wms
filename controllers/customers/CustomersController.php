<?php

namespace controllers\customers;

use models\customers\CustomersModel;
use app\action\checkAuthorization\CheckAuthorization;


class CustomersController
{
  private $check;

  public function __construct()
  {
    $this->check = new CheckAuthorization();
  }

  public function index()
  {
    $this->check->checkAuthorization();

    $customersModel = new CustomersModel();
    $customers = $customersModel->readAll();
    include 'app/views/customers/index.php';
  }

  public function create()
  {
    $this->check->checkAuthorization();

    include 'app/views/customers/create.php';
  }

  public function store()
  {
    $this->check->checkAuthorization();

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
    $this->check->checkAuthorization();

    $customersModel = new CustomersModel();
    $customer = $customersModel->read($params['customerId']);

    include 'app/views/customers/edit.php';
  }

  public function update($params)
  {
    $this->check->checkAuthorization();

    $customersModel = new CustomersModel();
    $customersModel->update($params['customerId'], $_POST);

    $path = '/' . APP_BASE_PATH . '/customers';
    header("Location: $path");
  }

  public function delete($params)
  {
    $this->check->checkAuthorization();

    $customersModel = new CustomersModel();
    $customersModel->delete($params['customerId']);

    $path = '/' . APP_BASE_PATH . '/customers';
    header("Location: $path");
  }
}

?>
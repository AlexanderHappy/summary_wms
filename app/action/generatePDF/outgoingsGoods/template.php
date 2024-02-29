<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>PDF Outgoings</title>
  
  <style type="text/css">
    body {
      font-family: DejaVu Sans, sans-serif;
    }
    table {
      border-collapse: collapse;
      width: 100%;
    }
    thead {
      background-color: #f5f5f5;
    }
    .total-head {
      color: red;
      text-align: center;
      font-size: 16px;
    }
    .total {
      text-align: center;
    }
    .main td {
      font-size: 9px;
    }
    td, th {
      border: 1px solid #cfcfcf;
      text-align: left;
      padding: 8px;
    }
    .name-brand-cell {
      width: 200px;
    }
    tr:nth-child(even) {
      background-color: #fbfbfb;
    }
    img {
      width: 100px;
    }
    .header td,
    .header th {
      border: none;
    }
    .paragraph-cell {
      text-align: right;
    }
  </style>
</head>

<body>
  <table class="header">
    <tr>
      <td>
        <img src="app/styles/picture/logo.png">
        <p style="display: inline-block; font-size: 18px;">
          CI-WMS
        </p>
      </td>
      <td class="paragraph-cell">
        <p>Information about Outgoing Goods:</p>
      </td>
    </tr>
  </table>
  
  <table class="main">
    <thead>
      <tr>
        <th>#</th>
        <th>Goods</th>
        <th>Customer</th>
        <th class="total">Total</th>
        <th>Date</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($pdfData['data'] as $key => $data): ?>
        <tr>
          <td><?= $key + 1 ?></td>
          <td class="name-brand-cell">
            <div>Name: <?= $data['good_name'] ?></div>
            <div>Brand: <?= $data['brand'] ?></div>
          </td>
          <td>
            <div>Customer: <?= $data['customer_name'] ?></div>
            <div>Address: <?= $data['address'] ?></div>
            <div>Phone: <?= $data['telephone'] ?></div>
          </td>
          <td class="total-head" style="font-size: 16px;"><?= $data['total'] ?></td>
          <td>
            <div>Created At: <?= $data['created_at'] ?></div>
            <div>Updated At: <?= $data['updated_at'] ?></div>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <p>
    Total amount of Outgoing Goods: <span style="color: red;"><?= $pdfData['sum'] ?></span>
  </p>
</body>
</html>


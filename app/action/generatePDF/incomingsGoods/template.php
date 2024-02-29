<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>PDF Incomings</title>
  <style>
    table {
      font-family: arial, sans-serif;
      border-collapse: collapse;
      width: 100%;
    }
    thead {
      background-color: #f5f5f5;
    }
    .total-head {
      color: red;
      text-align: center;
    }
    .total {
      text-align: center;
    }
    td, th {
      border: 1px solid #cfcfcf;
      text-align: left;
      padding: 8px;
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
        <p style="display: inline-block;">
          CI-WMS
        </p>
      </td>
      <td class="paragraph-cell">
        <p style="font-family: Arial;">Information about Goods:</p>
      </td>
    </tr>
  </table>
  
  <table>
    <thead>
      <tr>
        <th>#</th>
        <th>Goods</th>
        <th>Suppliers</th>
        <th class="total">Total</th>
        <th>Date</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($pdfData['data'] as $key => $data): ?>
        <tr>
          <td><?= $key + 1 ?></td>
          <td>
            <div><?= $data['good_name'] ?></div>
            <div><?= $data['brand'] ?></div>
          </td>
          <td>
            <div><?= $data['supplier_name'] ?></div>
            <div><?= $data['address'] ?></div>
            <div><?= $data['telephone'] ?></div>
          </td>
          <td class="total-head"><?= $data['total'] ?></td>
          <td>
            <div><?= $data['created_at'] ?></div>
            <div><?= $data['updated_at'] ?></div>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <p style="font-family: Arial;">
    Total amount of Incoming Goods: <span style="color: red;"><?= $pdfData['sum'] ?></span>
  </p>
</body>
</html>


<?php
ob_start();
$title = 'Goods';
?>

<table>
  <thead>
    <th>#</th>
    <th>Name</th>
    <th>Brand</th>
    <th>Stock</th>
    <th>Created At</th>
    <th>Updated At</th>
    <th>Action</th>
  </thead>

  <tbody>
    <?php foreach ($goods as $key => $good): ?>
      <tr>
        <td><?= $key + 1 ?></td>
        <td><?= $good['name'] ?></td>
        <td><?= $good['brand'] ?></td>
        <td><?= $good['stock'] ?></td>
        <td><?= $good['created_at'] ?></td>
        <td><?= $good['updated_at'] ?></td>
        <td>
          <button>Edit</button>
          <button>Delete</button>
        </td>
      </tr>
    <?php endforeach ?>
  </tbody>
</table>

<?php
$content = ob_get_clean();
include 'app/views/layout.php';
?>
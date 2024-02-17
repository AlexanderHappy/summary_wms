<?php
ob_start();
$title = 'Edit Customer';
$info = 'Edit Form:';
$link = "<a href='/<?= APP_BASE_PATH ?>/'>Dashboard</a> / <span>Edit Customer</span>";
?>

<div class="create-form">
  <form method="POST" action="/<?= APP_BASE_PATH ?>/customers/update/<?= $customer['customerId'] ?>">
    <div class="name-input">
      <label for="name" class="form-label">Name of new Supplier:</label>
      <input type="text" class="form-control" id="name" name="name" value="<?= $customer['customer_name'] ?>">
    </div>
    <div class="brand-input">
      <label for="address" class="form-label">Address:</label>
      <input type="text" class="form-control" id="address" name="address" value="<?= $customer['address'] ?>">
    </div>
    <div class="telephone-input">
      <label for="telephone">Telephone:</label>
      <input type="text" id="telephone" name="telephone" value="<?= $customer['telephone'] ?>">
    </div>
    <input class="submit-button" type="submit" value="Edit Supplier">
  </form>
</div>

<?php
$content = ob_get_clean();
include 'app/views/layout.php';
?>
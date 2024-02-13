<?php
ob_start();
$title = 'Create new Supplier';
$info = 'Create Form:';
$link = "<a href='/<?= APP_BASE_PATH ?>/'>Dashboard</a> / <span>Master of Suppliers</span>";
?>

<div class="create-form">
  <form method="POST" action="/<?= APP_BASE_PATH ?>/suppliers/store">
    <div class="name-input">
      <label for="name" class="form-label">Name of new Supplier:</label>
      <input type="text" class="form-control" id="name" name="name" value="Not Indicated">
    </div>
    <div class="brand-input">
      <label for="address" class="form-label">Address:</label>
      <input type="text" class="form-control" id="address" name="address" value="Not Indicated">
    </div>
    <div class="stock-input">
      <label for="telephone">Telephone:</label>
      <input type="text" id="telephone" name="telephone" value="Not Indicated">
    </div>
    <input class="submit-button" type="submit" value="Add new Supplier">
  </form>
</div>

<?php
$content = ob_get_clean();
include 'app/views/layout.php';
?>
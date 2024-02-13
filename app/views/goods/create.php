<?php
ob_start();
$title = 'Create new Goods';
$info = 'Create Form:';
$link = "<a href='/<?= APP_BASE_PATH ?>/'>Dashboard</a> / <span>Master of Goods</span>";
?>

<div class="create-form">
  <form method="POST" action="/<?= APP_BASE_PATH ?>/goods/store">
    <div class="name-input">
      <label for="name" class="form-label">Name of new Good:</label>
      <input type="text" class="form-control" id="name" name="name">
    </div>
    <div class="brand-input">
      <label for="brand" class="form-label">Brand:</label>
      <input type="text" class="form-control" id="brand" name="brand">
    </div>
    <div class="stock-input">
      <label for="stock">Stock:</label>
      <input type="number" id="stock" name="stock" min="0">
    </div>
    <input class="submit-button" type="submit" value="Add new Good">
  </form>
</div>

<?php
$content = ob_get_clean();
include 'app/views/layout.php';
?>
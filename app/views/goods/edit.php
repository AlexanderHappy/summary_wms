<?php
ob_start();
$title = 'Edit Goods';
$info = 'Edit Form:';
$link = "<a href='/<?= APP_BASE_PATH ?>/'>Dashboard</a> / <span>Edit Good</span>";
?>

<div class="edit-form">
  <form method="POST" action="/<?= APP_BASE_PATH ?>/goods/update/<?= $good['goodId'] ?>">
    <div class="name-input">
      <label for="name" class="form-label">Name of new Good:</label>
      <input type="text" class="form-control" id="name" name="name" value="<?= $good['good_name'] ?>">
    </div>
    <div class="brand-input">
      <label for="brand" class="form-label">Brand:</label>
      <input type="text" class="form-control" id="brand" name="brand" value="<?= $good['brand'] ?>">
    </div>
    <div class="stock-input">
      <label for="stock">Stock:</label>
      <input type="number" id="stock" name="stock" min="0" value="<?= $good['stock'] ?>">
    </div>
    <input class="submit-button" type="submit" value="Edit Good">
  </form>
</div>

<?php
$content = ob_get_clean();
include 'app/views/layout.php';
?>
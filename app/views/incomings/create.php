<?php
ob_start();
$title = 'Create new Incomings';
$info = 'Create Form:';
$link = "<a href='/<?= APP_BASE_PATH ?>/'>Dashboard</a> / <span>Master of Incomings</span>";
?>

<div class="create-form">
  <form method="POST" action="/<?= APP_BASE_PATH ?>/incomings/store">
    
    <div class="good-incoming-input">
      <label for="good_name" class="form-label">Good Name:</label>
      <select name="good_id" id="good_id" required>
        <option value="" selected disabled hidden >Choose here</option>

        <?php foreach ($goods as $good): ?>
          <option value="<?= $good['goodId'] ?>" >Name: <?= $good['good_name'] ?> - Brand: <?= $good['brand'] ?></option>
        <?php endforeach ?>

      </select>
    </div>

    <div class="supplier-incoming-input">
      <label for="supplier_id" class="form-label">Supplier Name:</label>
      <select name="supplier_id" id="supplier_id" required>
        <option value="" selected disabled hidden >Choose here</option>

        <?php foreach ($suppliers as $supllier): ?>
          <option value="<?= $supllier['supplierId'] ?>">Name: <?= $supllier['supplier_name'] ?> - Address: <?= $supllier['address'] ?></option>
        <?php endforeach ?>
        
      </select>
    </div>

    <div class="total-incoming-input">
      <label for="total">Total:</label>
      <input type="number" id="total" name="total" min="0" value="0">
    </div>
    <input class="submit-button" type="submit" value="Add new Incomings">
  </form>
</div>

<?php
$content = ob_get_clean();
include 'app/views/layout.php';
?>
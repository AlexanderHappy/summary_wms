<?php
ob_start();
$title = 'Create new Outgoing';
$info = 'Create Form:';
$link = "<a href='/<?= APP_BASE_PATH ?>/'>Dashboard</a> / <span>Master of Outgoing</span>";
?>

<div class="create-form">
  <form method="POST" action="/<?= APP_BASE_PATH ?>/outgoings/store">
    
    <div class="good-outgoing-input">
      <label for="good_name" class="form-label">Good Name:</label>
      <select name="good_id" id="good_id" required>
        <option value="" selected disabled hidden >Choose here</option>

        <?php foreach ($goods as $good): ?>
          <option value="<?= $good['goodId'] ?>" >Name: <?= $good['good_name'] ?> - Brand: <?= $good['brand'] ?></option>
        <?php endforeach ?>

      </select>
    </div>

    <div class="supplier-outgoing-input">
      <label for="customer_id" class="form-label">Customer Name:</label>
      <select name="customer_id" id="customer_id" required>
        <option value="" selected disabled hidden >Choose here</option>

        <?php foreach ($customers as $customer): ?>
          <option value="<?= $customer['customerId'] ?>">Name: <?= $customer['customer_name'] ?> - Address: <?= $customer['address'] ?></option>
        <?php endforeach ?>
        
      </select>
    </div>

    <div class="total-outgoing-input">
      <label for="total">Total:</label>
      <input type="number" id="total" name="total" min="0" value="0">
    </div>
    <input class="submit-button" type="submit" value="Add new Outgoing">
  </form>
</div>

<?php
$content = ob_get_clean();
include 'app/views/layout.php';
?>
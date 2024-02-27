<?php
ob_start();
$title = 'Edit Outgoing';
$info = 'Edit Form:';
$link = "<a href='/<?= APP_BASE_PATH ?>/'>Dashboard</a> / <span>Master of Outgoing</span>";
?>

<div class="edit-form">
  <form method="POST" action="/<?= APP_BASE_PATH ?>/outgoings/update/<?= $outgoing['outgoingId'] ?>">
    
    <div class="good-outgoing-input">
      <label for="good_name" class="form-label">Good Name:</label>
      <select name="good_id" id="good_id">

        <option value="<?= $outgoing['goodId'] ?>" selected>Name: <?= $outgoing['good_name'] ?> - Brand: <?= $outgoing['brand'] ?></option>
        <?php foreach ($goods as $good): ?>
          <option value="<?= $good['goodId'] ?>">Name: <?= $good['good_name'] ?> - Brand: <?= $good['brand'] ?></option>
        <?php endforeach ?>

      </select>
    </div>

    <div class="customer-outgoing-input">
      <label for="customer_id" class="form-label">Supplier Name:</label>
      <select name="customer_id" id="customer_id">

        <option value="<?= $outgoing['customerId'] ?>" selected>Name: <?= $outgoing['customer_name'] ?> - Address: <?= $outgoing['address'] ?></option>
        <?php foreach ($customers as $customer): ?>
          <option value="<?= $customer['customerId'] ?>">Name: <?= $customer['customer_name'] ?> - Address: <?= $customer['address'] ?></option>
        <?php endforeach ?>
        
      </select>
    </div>

    <div class="total-outgoing-input">
      <label for="total">Total:</label>
      <input type="number" id="total" name="total" min="0" value="<?= $outgoing['total'] ?>">
    </div>

    <input class="submit-button" type="submit" value="Edit Outgoing" >
  </form>
</div>

<?php
$content = ob_get_clean();
include 'app/views/layout.php';
?>
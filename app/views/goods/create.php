<?php
ob_start();
$title = 'Create new Goods';
$info = 'Create Form:';
$link = "<a href='/summary_wms/'>Dashboard</a> / <span>Master of Goods</span>";
?>

  <h1>Create user</h1>

  <div class="create-form">
    <form method="POST" action="/<?= APP_BASE_PATH ?>/goods/store">
      <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" name="username" required>
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" class="form-control" id="email" name="email" required>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
      </div>
      <div class="mb-3">
        <label for="confirm_password" class="form-label">Confirm password</label>
        <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
      </div>
      <button type="submit" class="btn btn-primary">Create User</button>
    </form>
  </div>

<?php
$content = ob_get_clean();
include 'app/views/layout.php';
?>
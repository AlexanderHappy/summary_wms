<?php
ob_start();
$title = 'Edit User';
$info = 'Edit Form:';
$link = "<a href='/<?= APP_BASE_PATH ?>/'>Dashboard</a> / <span>Edit User</span>";
?>

<div class="create-form">
  <form method="POST" action="/<?= APP_BASE_PATH ?>/users/store">
    <div class="name-input">
      <label for="user-name" class="form-label">New name of User:</label>
      <input type="text" class="form-control" id="user_name" name="user_name" value="<?= $user['user_name'] ?>" required>
    </div>
    <!-- <div class="brand-input">
      <label for="password" class="form-label">New Password:</label>
      <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <div class="brand-input">
      <label for="confirm_password" class="form-label">Confirm password:</label>
      <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
    </div> -->
    <div class="brand-input">
      <label for="email">Email:</label>
      <input type="email" id="email" name="email" value="admin@admin.com"  value="<?= $user['email'] ?>" required>
    </div>
    <input class="submit-button" type="submit" value="Edit User">
  </form>
</div>

<?php
$content = ob_get_clean();
include 'app/views/layout.php';
?>
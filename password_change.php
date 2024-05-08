<?php
require_once 'header.php';
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user'];
?>

<form class="d-flex align-items-center justify-content center flex-column mb-2" method="post"
      action="password_change_validator.php">
    <div class="form-floating mb-3">
        <input type="password" class="form-control" name="old_password" id="old_password_input"
               placeholder="old password" required>
        <label for="old_password_input">Old Password</label>
    </div>
    <div class="form-floating mb-3">
        <input type="password" class="form-control" name="new_password" id="new_password_input"
               placeholder="new password" required>
        <label for="new_password_input">New Password</label>
    </div>
    <div class="form-floating mb-3">
        <input type="password" class="form-control" name="confirm_password" id="confirm_password_input"
               placeholder="confirm password" required>
        <label for="confirm_password_input">Confirm Password</label>
    </div>
    <input class="btn btn-outline-secondary" type="submit" value="Change password">
</form>


<?php require_once 'footer.html' ?>

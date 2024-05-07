<?php require_once 'header.html' ?>

<form action="login_validation.php" method="post">
    <input type="text" name="username" required>
    <br>
    <input type="password" name="password" required>
    <br>
    <input type="submit" value="login">
    <br>
</form>

<a href="register.php">Register</a>

<?php require_once 'footer.html' ?>

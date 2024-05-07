<?php require_once 'header.html' ?>

<form class="d-flex align-items-center justify-content center flex-column mb-2" action="login_validation.php"
      method="post">
    <div class="form-floating mb-3">
        <input class="form-control" id="name_input" type="text" name="username"
               placeholder="Username or Email"
               required>
        <label for="name_input">Username or Email</label>
    </div>
    <div class="form-floating mb-3">
        <input class="form-control" id="password_input" type="password" name="password" placeholder="password" required>
        <label for="password_input">Password</label>
    </div>
    <input class="btn btn-outline-secondary" type="submit" value="Login">
    <hr class="w-100">
</form>
<a href="register.php">
    <button class="btn btn-outline-secondary">
        Register
    </button>
</a>

<?php require_once 'footer.html' ?>

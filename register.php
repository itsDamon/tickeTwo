<?php require_once 'header.php'; ?>

<form class="d-flex align-items-center justify-content center flex-column mb-2" action="register_validation.php"
      method="post">
    <div class="form-floating mb-3">
        <input class="form-control" type="text" name="name" id="name_input" placeholder="name" required>
        <label for="name_input">Name</label>
    </div>
    <div class="form-floating mb-3">
        <input class="form-control" type="text" name="surname" id="surname_input" placeholder="surname" required>
        <label for="surname_input">Surname</label>
    </div>
    <div class="input-group mb-3 w-100">
        <span class="input-group-text">Birth date</span>
        <input class="form-control" aria-label="Birth date" type="date" name="birthdate" id="birthdate_input" required>
    </div>
    <div class="form-floating mb-3">
        <input class="form-control" type="text" name="username" id="username_input" placeholder="username or email"
               required>
        <label for="username_input">Username or Email</label>
    </div>
    <div class="form-floating mb-3">
        <input class="form-control" type="password" name="password" id="password_input" placeholder="password" required>
        <label for="password_input">Password</label>
    </div>
    <input class="btn btn-outline-secondary" type="submit" value="Sign In">
</form>
<?php require_once 'footer.html'; ?>

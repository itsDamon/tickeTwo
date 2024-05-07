<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<form action="register_validation.php" method="post">
    <input type="text" name="name" placeholder="name" required>
    <br>
    <input type="text" name="surname" placeholder="surname" required>
    <br>
    <input type="text" name="username" placeholder="username or email" required>
    <br>
    <input type="password" name="password" placeholder="password" required>
    <br>
    <input type="submit" value="login">
    <br>
</form>
<a href="login.php">Login</a>

</body>
</html>
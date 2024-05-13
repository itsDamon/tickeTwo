<?php
session_start();
date_default_timezone_set('Europe/Rome');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
</head>
<body class="d-flex flex-column min-vh-100 flex-grow-1 p-3">
<header class="text-center p-2 d-flex align-items-center justify-content-around">
    <a href="home.php" class="link-underline link-underline-opacity-0">
        <h2>TickeTwo</h2>
    </a>
    <?php if (!isset($_SESSION['user'])) { ?>
        <a href="login.php">Login</a>
    <?php } else { ?>
        <a href="profile.php">Profile</a>
    <?php } ?>
</header>
<div class="mt-auto d-flex align-items-center justify-content-center flex-column">


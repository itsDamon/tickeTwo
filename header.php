<?php
session_start();
date_default_timezone_set('Europe/Rome');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
          integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="OwlCarousel2-2.3.4/dist/assets/owl.carousel.min.css">
    <script src="OwlCarousel2-2.3.4/dist/owl.carousel.min.js"></script>
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
<div class="mt-auto d-flex align-items-center justify-content-center flex-column h-100">
    <!--mt-auto d-flex align-items-center justify-content-center flex-column-->


<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
}
header('Location: index.php');
$_SESSION = [];
session_destroy();
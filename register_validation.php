<?php
global $pdo;
require_once 'connection_db.php';

$name = $_POST['name'] ?? '';
$surname = $_POST['surname'] ?? '';
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
$birthdate = $_POST['birthdate'] ?? '';


if ($name == '' || $surname == '' || $username == '' || $password == '' || $birthdate == '') {
    header('Location: register.php?error_text=empty_fields');
    exit();
}

$query = '
INSERT INTO users (name, surname, username, password, birthdate)
VALUES (?, ?, ?, ?, ?)
';

try {
    $sql = $pdo->prepare($query);
    $sql->execute([$name, $surname, $username, password_hash($password, PASSWORD_DEFAULT), $birthdate]);
} catch (PDOException $e) {
    echo $e->getMessage();
    exit();
}

header('Location: login.php');
exit();
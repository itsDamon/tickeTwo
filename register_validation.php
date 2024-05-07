<?php
global $pdo;
require_once 'connection_db.php';

$name = $_POST['name'] ?? '';
$surname = $_POST['surname'] ?? '';
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
$role = 'user';

if ($name == '' || $surname == '' || $username == '' || $password == '') {
    header('Location: register.php?error_text=empty_fields');
    exit();
}


echo $username;

$query = '
INSERT INTO users (name, surname, username, password, role)
VALUES (?, ?, ?, ?, ?)
';

print_r([$name, $surname, $username, password_hash($password, PASSWORD_DEFAULT), $role]);
try {
    $sql = $pdo->prepare($query);
    $sql->execute([$name, $surname, $username, password_hash($password, PASSWORD_DEFAULT), $role]);

} catch (PDOException $e) {
    echo $e->getMessage();
    exit();
}

header('Location: login.php');
exit();
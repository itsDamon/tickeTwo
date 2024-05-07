<?php
global $pdo;
require_once 'connection_db.php';

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
$query = '
SELECT id, username, password, role
FROM users
WHERE users.username = ?
';


$sql = $pdo->prepare($query);
$sql->execute([$username]);

$user = $sql->fetch();

$hashed_password = $user['password'] ?? '';

if (!$user || !password_verify($password, $hashed_password)) {
    header('Location: login.php?error_text=password_error');
    exit();
} else {
    session_start();

    $_SESSION['user'] = $user['username'];
    $_SESSION['user_role'] = $user['role'];

    header('Location: index.php');
    exit();
}

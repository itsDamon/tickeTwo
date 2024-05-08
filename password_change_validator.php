<?php
session_start();
global $pdo;
require_once 'connection_db.php';

$user_id = $_SESSION['user_id'];

$old_password = $_POST['old_password'] ?? '';
$new_password = $_POST['new_password'] ?? '';
$confirm_password = $_POST['confirm_password'] ?? '';

if ($old_password == $new_password) {
    header('Location: password_change.php?error_text=same_password');
    exit();
}

if ($new_password != $confirm_password) {
    header('Location: password_change.php?error_text=password_mismatch');
    exit();
}

$query = '
SELECT password
FROM users
WHERE id = ?
';

$sql = $pdo->prepare($query);
$sql->execute([$user_id]);

$hashed_password = $sql->fetchColumn();

if (!password_verify($old_password, $hashed_password)) {
    header('Location: password_change.php?error_text=wrong_password');
    exit();
}

$query = '
UPDATE users
SET password = ?
WHERE id = ?';

$sql = $pdo->prepare($query);
$sql->execute([password_hash($new_password, PASSWORD_DEFAULT), $user_id]);

header('Location: password_change.php?success_text=password_changed');
<?php
global $pdo;
session_start();
require_once 'connection_db.php';
if (!isset($_SESSION['user'])) {
    header('Location: home.php');
    exit();
}


$user_id = $_SESSION['user_id'];
$event_id = $_POST['event_id'] ?? '';
$quantity = $_POST['quantity'] ?? '';

if (empty($event_id) || empty($quantity)) {
    header('Location: home.php');
    exit();
}

$query = "
INSERT INTO tickets (user_id, event_id)
VALUES (?,?)
";

$stmt = $pdo->prepare($query);

for ($i = 0; $i < $quantity; $i++) {
    $stmt->execute([$user_id, $event_id]);
}
header('Location: profile.php');
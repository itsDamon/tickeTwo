<?php
global $pdo;
require_once "connection_db.php";
require_once "header.php";

$user_id = $_SESSION['user'];

//recupero id utente
$query = '
SELECT *
FROM users
WHERE username = ?
';
$sql = $pdo->prepare($query);
$sql->execute([$user_id]);
$user = $sql->fetch();

//recupero biglietti dell'utente
$query1 = '
SELECT events.event_name
FROM users JOIN tickets on tickets.user_id = users.id
JOIN events on tickets.event_id = events.id
where tickets.user_id = ?
';
$sql = $pdo->prepare($query1);
$sql->execute([$user_id]);
$user = $sql->fetch();

//recupero costo di ogni biglietto
$query2 = '
SELECT SUM(events.cost)
FROM events JOIN tickets on tickets.event_id = events.id
JOIN users on tickets.user_id = users.id
WHERE tickets.user_id = ?
';
$sql = $pdo->prepare($query1);
$sql->execute([$user_id]);
$user = $sql->fetch();

?>




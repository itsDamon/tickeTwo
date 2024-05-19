<?php
require_once "connection_db.php";
require_once "header.php";

$user_id = $_SESSION['user'];

$query = '
SELECT *
FROM users
WHERE username = ?
';

$sql = $pdo->prepare($query);
$sql->execute([$user_id]);

$user = $sql->fetch();

$query = '
SELECT events.event_name
FROM users JOIN tickets on tickets.user_id = users.id
JOIN events on tickets.event_id = events.id
'

?>




<?php
require_once 'header.php';
$event_id = $_GET['event_id'] ?? '';

if ($event_id == '') {
    header('Location: home.php');
    exit('No event');
}
?>

<div>

</div>

<?php require_once 'footer.html'; ?>

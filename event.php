<?php
require_once 'header.php';
$event_id = $_GET['event_id'] ?? '';

if ($event_id == '') {
    header('Location: home.php');
    exit('No event');
}
?>

<div class="container-fluid">
    <div class="row" id="event_image">
        <div class="col-md-12">
            <img src="" alt="Event image">
        </div>
    </div>
    <div class="row" id="">
        <div class="col-md-12">

        </div>
    </div>
</div>

<?php require_once 'footer.html'; ?>

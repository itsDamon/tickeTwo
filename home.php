<?php
session_start();
global $pdo;
require_once "header.php";
require_once "connection_db.php";
$query = "
SELECT * 
FROM events 
JOIN locations
ON events.location_id = locations.id
JOIN performers
ON events.performer_id = performers.id
GROUP BY events.name
";
$sql = $pdo->query($query);
$sql->execute();
$events = $sql->fetchAll();

$query = "
SELECT * 
FROM events
JOIN locations
ON events.location_id = locations.id
JOIN performers
ON events.performer_id = performers.id
";
$sql = $pdo->query($query);
$sql->execute();
$events = $sql->fetchAll();



$first = true;

?>
    <div class="owl-carousel owl-theme">
        <?php foreach ($events as $event) { ?>
            <div class="item">
                <div class="card text-center">
                    <div class="card-header">
                        image
                    </div>
                    <div class="card-body">
                        <div class="card-title">
                            <?= $event['name'] ?>
                        </div>
                        <div class="card-footer">
                            <?= $event['stage_name'] ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    <hr class="w-50">

    <div id="artist-carousel" class="carousel slide container" data-bs-ride="carousel">

    </div>

<?php
if (isset($_SESSION['user'])) {
    echo "utente loggato";
} else {
    echo "utente non loggato";
}


require_once "footer.html";

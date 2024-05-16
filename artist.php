<?php
global $pdo;
require_once 'header.php';
require_once 'connection_db.php';
$author_id = $_GET['author_id'] ?? '';

if ($author_id == '') {
    header('Location: home.php');
    exit('No author');
}

$query = "
SELECT * 
FROM events 
JOIN locations
ON events.location_id = locations.id
JOIN performers
ON events.performer_id = performers.id
WHERE performer_id = ?";
$sql = $pdo->prepare($query);
$sql->execute([$author_id]);
$events = $sql->fetchAll();
?>

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
            </div>
        </div>
    </div>
<?php } ?>

<?php
require_once 'footer.html';
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
FROM authors
WHERE author_id = ?";
$sql = $pdo->prepare($query);
$sql->execute([$author_id]);
$author = $sql->fetchAll()[0];

$query = "
SELECT * 
FROM events
JOIN locations
ON events.location_id = locations.location_id
JOIN authors
ON events.author_id = authors.author_id
WHERE events.event_id = ?";
$sql = $pdo->prepare($query);
$sql->execute([$author_id]);
$events = $sql->fetchAll();


?>

    <!-- Artista Dettagli -->
    <section class="container mt-5">
        <div class="row">
            <div class="col-md-4 text-center">
                <img src="images/<?= strtolower(htmlspecialchars($author['stage_name'])) ?>.jpg" alt="Foto Artista"
                     class="img-fluid rounded-circle artist-photo">
            </div>
            <div class="col-md-8">
                <h2><?= $author['stage_name'] ?></h2>
                <p><?= $author['biography'] ?? 'Nessuna biografia' ?></p>
            </div>
        </div>
    </section>

    <!-- Eventi -->
    <section class="container mt-5">
        <h2>Eventi</h2>
        <div class="container-fluid">
            <?php foreach ($events as $event) { ?>
                <div class="row d-flex align-items-center justify-content-center">
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <div class="card-body">
                                <h5 class="card-title"><?= $event['event_description'] ?></h5>
                                <div class="card-text">
                                    <p><?= $event['city'] ?> - <?= $event['country'] ?> </p>
                                    <p><?= $event['location_name'] ?>
                                        - <?php $date = new DateTimeImmutable($event['date']);
                                        echo $date->format('d/m/Y'); ?></p>
                                </div>
                                <a href="event.php?event_id=<?= $event['event_id'] ?>" class="btn btn-primary">Compra
                                    Biglietti</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>

<?php
require_once 'footer.html';
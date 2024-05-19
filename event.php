<?php
global $pdo;
require_once 'header.php';
require_once 'connection_db.php';
$event_id = $_GET['event_id'] ?? '';

if ($event_id == '') {
    header('Location: home.php');
    exit('No event');
}

$query = "
SELECT * 
FROM events
JOIN locations
ON events.location_id = locations.id
JOIN authors
ON events.author_id = authors.id
WHERE events.id = ?";
$sql = $pdo->prepare($query);
$sql->execute([$event_id]);
$event = $sql->fetchAll()[0];
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h2><?php echo htmlspecialchars($event['event_name']); ?></h2>
        </div>
        <div class="card-body">
            <h5 class="card-title">Dettagli dell'Evento</h5>
            <p class="card-text">
                <strong>Descrizione:</strong> <?= htmlspecialchars($event['event_description']); ?> <br>
                <strong>Data:</strong> <?php try {
                    $birthdate = new DateTimeImmutable($event['date']);
                    echo $birthdate->format('d/m/Y');
                } catch (Exception $e) {
                } ?> <br>
                <strong>Per maggiorenni:</strong> <?= $event['over_eighteen'] ? 'Sì' : 'No'; ?> <br>
                <strong>Luogo:</strong> Nome del luogo: <?= htmlspecialchars($event['location_name']); ?> <br>
                <strong>Autore:</strong> Nome dell'autore: <?= htmlspecialchars($event['stage_name']); ?>
                <br>
                <strong>Tipo di evento:</strong> <?php echo htmlspecialchars($event['type']); ?>
            </p>
            <hr>
            <h5 class="card-title">Acquista Biglietti</h5>
            <form id="ticketForm" action="checkOut.php" method="POST">
                <div class="form-group">
                    <label for="quantity">Quantità:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <button class="btn btn-outline-secondary" type="button" id="decrease">-</button>
                        </div>
                        <input type="number" class="form-control" id="quantity" name="quantity" value="1" min="1"
                               required>
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" id="increase">+</button>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="event_id" value="<?php echo htmlspecialchars($event['id']); ?>">
                <button type="submit" class="btn btn-success">Acquista</button>
            </form>
        </div>
    </div>
</div>
<script>
    document.getElementById('decrease').addEventListener('click', function () {
        var quantityInput = document.getElementById('quantity');
        var currentValue = parseInt(quantityInput.value);
        if (currentValue > 1) {
            quantityInput.value = currentValue - 1;
        }
    });

    document.getElementById('increase').addEventListener('click', function () {
        var quantityInput = document.getElementById('quantity');
        quantityInput.value = parseInt(quantityInput.value) + 1;
    });
</script>
<?php require_once 'footer.html'; ?>

<?php
global $pdo;
require_once "connection_db.php";
require_once "header.php";

if (!isset($_SESSION['user'])) {
  header('Location: login.php');
}

$user_id = $_SESSION['user'];

$event_id = $_POST['event_id'] ?? '';
$quantity = $_POST['quantity'] ?? '';

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

$price = $event['price'] * $quantity;
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
<div class="card">
  <div class="card-header">
    <h4><?php echo htmlspecialchars($event['event_name']); ?></h4>
  </div>
  <div class="card-body">
    <p class="card-text">
      <strong>Descrizione:</strong> <?php echo htmlspecialchars($event['event_description']); ?> <br>
      <strong>Data:</strong> <?php echo htmlspecialchars($event['date']); ?> <br>
      <strong>Per maggiorenni:</strong> <?php echo $event['over_eighteen'] ? 'Sì' : 'No'; ?> <br>
      <strong>Luogo:</strong> Nome del luogo (ID: <?php echo htmlspecialchars($event['location_id']); ?>) <br>
      <strong>Autore:</strong> Nome dell'autore (ID: <?php echo htmlspecialchars($event['author_id']); ?>)
      <br>
      <strong>Tipo di evento:</strong> <?php echo htmlspecialchars($event['type']); ?>
    </p>
    <hr>
    <h5 class="card-title">Biglietti da acquistare</h5>
    <p class="card-text">
      <strong>Quantità:</strong> <?php echo htmlspecialchars($quantity); ?> <br>
      <strong>Prezzo: </strong> <?php echo $price; ?>
    </p>
    <form action="confirm_buy.php" method="POST">
      <input type="hidden" name="event_id" value="<?php echo htmlspecialchars($event['id']); ?>">
      <input type="hidden" name="quantity" value="<?php echo htmlspecialchars($quantity); ?>">
      <button type="submit" class="btn btn-success">Conferma Acquisto</button>
      <a href="event.php?event_id=<?= $event['id'] ?>" class="btn btn-primary">Torna alla pagina
        principale</a>
    </form>
  </div>
</div>
<?php
require_once "footer.html";

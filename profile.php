<?php
session_start();
global $pdo;
require_once 'header.php';
require_once 'connection_db.php';

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

$username = $_SESSION['user'];
$user_id = $_SESSION['user_id'];

$query = '
SELECT *
FROM users
WHERE username = ?
';

$sql = $pdo->prepare($query);
$sql->execute([$username]);

$user = $sql->fetch();


$query = "SELECT event_name, events.price, events.date, count(*) as quantity
        FROM tickets 
        JOIN events ON tickets.event_id = events.event_id
        WHERE tickets.user_id = ?
        GROUP BY events.event_id";

$stmt = $pdo->prepare($query);
$stmt->execute([$user_id]);
$tickets = $stmt->fetchAll();

?>
    <div class="card text-center">
        <div class="card-header">
            User Data
        </div>
        <div class="card-body">
            <h5 class="card-title"><?= $user['name'] ?> <?= $user['surname'] ?></h5>
            <p class="card-text">Username: <?= $user['username'] ?></p>
            <a href="password_change.php" class="btn btn-primary">Change Password</a>
        </div>
        <div class="card-footer text-body-secondary">
            Birth Date: <?php
            try {
                $birthdate = new DateTimeImmutable($user['birthdate']);
                echo $birthdate->format('d/m/Y');
            } catch (Exception $e) {
            } ?>
        </div>
    </div>

    <div class="mt-4">
        <a href="logout.php" id="logout">
            <button class="btn btn-primary">Logout</button>
        </a>
    </div>

    <section class="mt-3">
        <div class="card">
            <div class="card-header">
                <h4>Bought Tickets</h4>
            </div>
            <div class="card-body">
                <?php if (count($tickets) > 0): ?>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Event</th>
                            <th>Date</th>
                            <th>Quantity</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($tickets as $ticket): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($ticket['event_name']); ?></td>
                                <td><?php try {
                                        $birthdate = new DateTimeImmutable($ticket['date']);
                                        echo $birthdate->format('d/m/Y');
                                    } catch (Exception $e) {
                                    }; ?></td>
                                <td><?php echo htmlspecialchars($ticket['quantity']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>No ticket bought.</p>
                <?php endif; ?>
            </div>
    </section>

    <script>
        $(function () {
            $('a#logout').click(function () {
                return confirm('Do you really want to log out?');
            });
        });
    </script>
<?php require_once 'footer.html'; ?>
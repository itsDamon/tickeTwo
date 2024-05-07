<?php
session_start();
global $pdo;
require_once 'header.php';
require_once 'connection_db.php';

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user'];

$query = '
SELECT *
FROM users
WHERE username = ?
';

$sql = $pdo->prepare($query);
$sql->execute([$user_id]);

$user = $sql->fetch();


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
<?php require_once 'footer.html'; ?>
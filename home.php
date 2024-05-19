<?php
global $pdo;
require_once "header.php";
require_once "connection_db.php";


$query = "
SELECT * 
FROM authors
";
$sql = $pdo->query($query);
$sql->execute();
$authors = $sql->fetchAll();


$first = true;

?>

    <div id="event-carousel" class="owl-carousel owl-theme p-3">
        <?php foreach ($authors as $author) { ?>
            <div class="item">
                <div class="card p-3">
                    <img src="images/<?= strtolower(htmlspecialchars($author['stage_name'])) ?>.jpg" width="100px" height="250px"
                         alt="Foto dell'evento">
                    <h5 class="card-title"><?= $author['stage_name'] ?></h5>
                    <div class="card-text">
                        <a href="artist.php?author_id=<?= $author['id'] ?>"></a>
                        <a href="artist.php?author_id=<?= $author['id'] ?>" class="btn btn-primary mt-3">Vai
                            agli eventi</a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>

    <hr class="w-50">

    <!--    <div id="artist-carousel" class="owl-carousel owl-theme">
        <?php /*foreach ($performers as $performer) { */ ?>
            <div class="item p-3">
                <div class="card">
                    <img src="url_della_foto.jpg" class="card-img-top" alt="Foto dell'autore">
                    <div class="card-body">
                        <a href="artist.php?author_id=<?php /*= $performer['id'] */ ?>">
                            <h5 class="card-text"><?php /*= $performer['stage_name'] */ ?></h5>
                        </a>
                                              <p class="card-title"></p>
                    </div>
                </div>
            </div>
        <?php /*} */ ?>
    </div> -->

<?php
if (isset($_SESSION['user'])) {
    echo "utente loggato";
} else {
    echo "utente non loggato";
}


require_once "footer.html";

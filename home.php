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
";
$sql = $pdo->prepare($query);
$sql->execute();
$events = $sql->fetchAll();
foreach ($events as $event) {
    echo $event['id'];
}

$first = true;

?>
    <style>
        @media (max-width: 768px) {
            .carousel-inner .carousel-item > div {
                display: none;
            }

            .carousel-inner .carousel-item > div:first-child {
                display: block;
            }
        }

        .carousel-inner .carousel-item.active,
        .carousel-inner .carousel-item-start,
        .carousel-inner .carousel-item-next,
        .carousel-inner .carousel-item-prev {
            display: flex;
        / / transition-duration: 8 s;
        }

        /* display 4 */
        @media (min-width: 768px) {
            .carousel-inner .carousel-item-right.active,
            .carousel-inner .carousel-item-next,
            .carousel-item-next:not(.carousel-item-start) {
                transform: translateX(25%) !important;
            }

            .carousel-inner .carousel-item-left.active,
            .carousel-item-prev:not(.carousel-item-end),
            .active.carousel-item-start,
            .carousel-item-prev:not(.carousel-item-end) {
                transform: translateX(-25%) !important;
            }

            .carousel-item-next.carousel-item-start, .active.carousel-item-end {
                transform: translateX(0) !important;
            }

            .carousel-inner .carousel-item-prev,
            .carousel-item-prev:not(.carousel-item-end) {
                transform: translateX(-25%) !important;
            }
        }
    </style>

    <div id="event-carousel" class="carousel slide container" data-bs-ride="carousel">
        <div class="carousel-inner w-100">
            <?php foreach ($events as $event) { ?>
                <div class="carousel-item <?php if ($first) {
                    echo "active";
                    $first = false;
                } ?>">
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
        <button class="carousel-control-prev" type="button" data-bs-target="#event-carousel"
                data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#event-carousel"
                data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <hr class="w-50">

    <div id="artist-carousel" class="carousel slide container" data-bs-ride="carousel">
        <div class="carousel-inner w-100">
            <div class="carousel-item active">
                <div class="col-md-3">
                    <div class="card card-body">
                        <img class="img-fluid" src="http://placehold.it/380?text=1">
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="col-md-3">
                    <div class="card card-body">
                        <img class="img-fluid" src="http://placehold.it/380?text=2">
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="col-md-3">
                    <div class="card card-body">
                        <img class="img-fluid" src="http://placehold.it/380?text=3">
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="col-md-3">
                    <div class="card card-body">
                        <img class="img-fluid" src="http://placehold.it/380?text=4">
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="col-md-3">
                    <div class="card card-body">
                        <img class="img-fluid" src="http://placehold.it/380?text=5">
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="col-md-3">
                    <div class="card card-body">
                        <img class="img-fluid" src="http://placehold.it/380?text=6">
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="col-md-3">
                    <div class="card card-body">
                        <img class="img-fluid" src="http://placehold.it/380?text=7">
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="col-md-3">
                    <div class="card card-body">
                        <img class="img-fluid" src="http://placehold.it/380?text=8">
                    </div>
                </div>
            </div>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#artist-carousel"
                data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#artist-carousel"
                data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <script>
        $('.carousel .carousel-item').each(function () {
            var minPerSlide = 4;
            var next = $(this).next();
            if (!next.length) {
                next = $(this).siblings(':first');
            }
            next.children(':first-child').clone().appendTo($(this));

            for (var i = 0; i < minPerSlide; i++) {
                next = next.next();
                if (!next.length) {
                    next = $(this).siblings(':first');
                }
                next.children(':first-child').clone().appendTo($(this));
            }
        });
    </script>
<?php
if (isset($_SESSION['user'])) {
    echo "utente loggato";
} else {
    echo "utente non loggato";
}


require_once "footer.html";

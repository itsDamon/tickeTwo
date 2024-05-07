<?php
require_once "header.php";
session_start();
if (isset($_SESSION['user'])) {
    echo "utente loggato";
} else {
    echo "utente non loggato";
}
require_once "footer.html";

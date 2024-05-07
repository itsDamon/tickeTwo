<?php
session_start();
if (isset($_SESSION['user'])) {
    echo "utente loggato";
} else {
    echo "utente non loggato";
}
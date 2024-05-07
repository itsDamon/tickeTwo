<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$type = 'mysql';
$server = '127.0.0.1';
$db = 'ticketwo';
$port = '3306';
$charset = 'utf8mb4';

$username = 'root';
# TODO: CAMBIA LA PASSWORD E NON PUSHARE QUESTO FILE
$password = getenv('MARIADB_PASSWD');

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

$dsn = "$type:host=$server;dbname=$db;port=$port;charset=$charset";
$pdo = null;
try {
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    throw new PDOException($e->getMessage(), $e->getCode());
}
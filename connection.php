<?php
$host = 'localhost';    // Change as necessary
$database = 'project';   // Change as necessary
$user = 'root';   // Change as necessary
$pass = '';     // Change as necessary
$attr = "mysql:host=$host;dbname=$database";
$opts = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];
try {
    $pdo = new PDO($attr, $user, $pass, $opts);
} catch (PDOException $e) {
    throw new PDOException($e->getMessage(), (int)$e->getCode());
}

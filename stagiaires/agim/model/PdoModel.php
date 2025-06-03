<?php
require_once('../config-dev.php');
try {
    $pdo = new PDO(DB_DSN, DB_LOGIN, DB_PWD, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (Exception $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

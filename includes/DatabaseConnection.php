<?php
$pdo = NULL;
try {
    $pdo = new PDO('mysql:host=localhost;dbname=homestead;charset=utf8', 'homestead', 'secret');
} catch (\PDOException $e) {
    $pdo = new PDO('mysql:host=localhost;dbname=bwwdb;charset=utf8', 'bworsham', '153756Pw');
}
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
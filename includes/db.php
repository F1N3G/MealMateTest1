<?php
require_once __DIR__ . '/../config/database.php';

function select($sql, $params = []) {
    global $pdo;
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function execute($sql, $params = []) {
    global $pdo;
    $stmt = $pdo->prepare($sql);
    return $stmt->execute($params);
}

<?php
require_once '../classes/GameVault.php';
require_once 'db.php';
header('Content-Type: application/json');
$title = $_GET['title'];
$limit = $_GET['limit'] ?? 10;
$gv = new GameVault(dbCon());
$data = $gv->searchGamesByTitle($title, limit: $limit);

echo json_encode($data, JSON_PRETTY_PRINT);
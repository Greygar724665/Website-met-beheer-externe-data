<?php
declare(strict_types=1);


function dbCon(): PDO {
    $host = 'localhost';
    $db = 'gamevault';
    $user = 'root';
    $pass = '';
    $charset = 'utf8mb4';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

    try {
        return new PDO($dsn, $user, $pass, [                   // instantiate PDO
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,       // will throw exceptions
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,  // return associative array
            PDO::ATTR_EMULATE_PREPARES   => true,             // won't coerce bound parameters to strings
        ]);
    } catch (PDOException $e) {
        http_response_code(500);
        exit("Database connectie mislukt: " . htmlspecialchars($e->getMessage()));
    }
}
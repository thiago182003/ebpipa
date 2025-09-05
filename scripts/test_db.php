<?php
$host = '127.0.0.1';
$port = 3306;
$db   = 'epipa';
$user = 'root';
$pass = 'G$m7qR&pEth0';
$dsn  = "mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    echo "CONNECTED\n";
    $stmt = $pdo->query('SELECT 1 AS ok');
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    var_export($row);
} catch (PDOException $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
    exit(1);
}

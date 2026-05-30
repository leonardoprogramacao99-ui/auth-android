<?php
header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Origin: *");

$host = getenv("MYSQLHOST");
$port = getenv("MYSQLPORT");
$db   = getenv("MYSQLDATABASE");
$user = getenv("MYSQLUSER");
$pass = getenv("MYSQLPASSWORD");

try {
    $pdo = new PDO(
        "mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4",
        $user,
        $pass,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
} catch (PDOException $e) {
    echo json_encode(["sucesso" => false, "mensagem" => $e->getMessage()]);
    exit;
}

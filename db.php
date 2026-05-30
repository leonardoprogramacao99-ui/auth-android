<?php
// ── db.php ────────────────────────────────────────────────────────────────
// Credenciais do Railway MySQL
// ─────────────────────────────────────────────────────────────────────────

header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Origin: *");

define("DB_HOST", "kodama.proxy.rlwy.net");
define("DB_NAME", "railway");
define("DB_USER", "root");
define("DB_PASS", "SoXdbRTiMVsEfyCeaZDOycukWFDllPQU");
define("DB_PORT", "13302");

try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME . ";charset=utf8mb4",
        DB_USER,
        DB_PASS,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
} catch (PDOException $e) {
    echo json_encode(["sucesso" => false, "mensagem" => "Erro no banco de dados."]);
    exit;
}

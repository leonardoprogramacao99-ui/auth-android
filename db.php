<?php
// ── db.php ────────────────────────────────────────────────────────────────
// Coloque em: C:\xampp\htdocs\auth\db.php
// ─────────────────────────────────────────────────────────────────────────

define("DB_HOST", "localhost");
define("DB_NAME", "app_login");   // crie este banco no phpMyAdmin
define("DB_USER", "root");
define("DB_PASS", "");            // senha padrão do XAMPP é vazia

try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4",
        DB_USER,
        DB_PASS,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
} catch (PDOException $e) {
    header("Content-Type: application/json");
    echo json_encode(["sucesso" => false, "mensagem" => "Erro no banco de dados."]);
    exit;
}

/* ── SQL para criar a tabela (execute uma vez no phpMyAdmin) ──────────────

CREATE DATABASE IF NOT EXISTS app_login CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE app_login;

CREATE TABLE IF NOT EXISTS usuarios (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    nome        VARCHAR(120)  NOT NULL,
    email       VARCHAR(200)  NOT NULL UNIQUE,
    senha_hash  VARCHAR(255)  NOT NULL,
    criado_em   TIMESTAMP     DEFAULT CURRENT_TIMESTAMP
);

─────────────────────────────────────────────────────────────────────────── */

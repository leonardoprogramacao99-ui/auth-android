<?php
// ── login.php ─────────────────────────────────────────────────────────────
// Coloque em: C:\xampp\htdocs\auth\login.php
// ─────────────────────────────────────────────────────────────────────────

header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Origin: *");

require_once "db.php";

$email = trim($_POST["email"] ?? "");
$senha = trim($_POST["senha"] ?? "");

if (empty($email) || empty($senha)) {
    echo json_encode(["sucesso" => false, "mensagem" => "Preencha todos os campos."]);
    exit;
}

$stmt = $pdo->prepare("SELECT id, nome, senha_hash FROM usuarios WHERE email = ?");
$stmt->execute([$email]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuario || !password_verify($senha, $usuario["senha_hash"])) {
    echo json_encode(["sucesso" => false, "mensagem" => "E-mail ou senha incorretos."]);
    exit;
}

echo json_encode([
    "sucesso"  => true,
    "mensagem" => "Login realizado com sucesso! Bem-vindo, " . $usuario["nome"] . ".",
    "usuario"  => ["id" => $usuario["id"], "nome" => $usuario["nome"]]
]);

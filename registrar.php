<?php
// ── registrar.php ─────────────────────────────────────────────────────────
// Coloque em: C:\xampp\htdocs\auth\registrar.php
// ─────────────────────────────────────────────────────────────────────────

header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Origin: *");

require_once "db.php";

$nome  = trim($_POST["nome"]  ?? "");
$email = trim($_POST["email"] ?? "");
$senha = trim($_POST["senha"] ?? "");

if (empty($nome) || empty($email) || empty($senha)) {
    echo json_encode(["sucesso" => false, "mensagem" => "Preencha todos os campos."]);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(["sucesso" => false, "mensagem" => "E-mail inválido."]);
    exit;
}

if (strlen($senha) < 6) {
    echo json_encode(["sucesso" => false, "mensagem" => "A senha deve ter mínimo 6 caracteres."]);
    exit;
}

// Verificar se e-mail já existe
$stmt = $pdo->prepare("SELECT id FROM usuarios WHERE email = ?");
$stmt->execute([$email]);
if ($stmt->fetch()) {
    echo json_encode(["sucesso" => false, "mensagem" => "Este e-mail já está cadastrado."]);
    exit;
}

// Inserir novo usuário
$hash = password_hash($senha, PASSWORD_BCRYPT);
$stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, senha_hash) VALUES (?, ?, ?)");
$stmt->execute([$nome, $email, $hash]);

echo json_encode([
    "sucesso"  => true,
    "mensagem" => "Conta criada com sucesso! Faça login."
]);

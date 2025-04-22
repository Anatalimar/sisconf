<?php
require '../conexao.php';
session_start();

if (!isset($_SESSION['admin_id']) || $_SESSION['perfil'] !== 'admin') {
  http_response_code(403);
  exit;
}

$data = json_decode(file_get_contents("php://input"), true);
if (!$data) {
  http_response_code(400);
  echo json_encode(['erro' => 'Dados inválidos']);
  exit;
}

$id = $data['id'] ?? null;
$nome = $data['nome'];
$email = $data['email'];
$perfil = $data['perfil'];
$senha = $data['senha'];

if ($id) {
  if ($senha) {
    $hash = password_hash($senha, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("UPDATE usuarios_admin SET nome=?, email=?, perfil=?, senha_hash=? WHERE id=?");
    $stmt->execute([$nome, $email, $perfil, $hash, $id]);
  } else {
    $stmt = $conn->prepare("UPDATE usuarios_admin SET nome=?, email=?, perfil=? WHERE id=?");
    $stmt->execute([$nome, $email, $perfil, $id]);
  }
} else {
  $hash = password_hash($senha, PASSWORD_DEFAULT);
  $stmt = $conn->prepare("INSERT INTO usuarios_admin (nome, email, perfil, senha_hash) VALUES (?, ?, ?, ?)");
  $stmt->execute([$nome, $email, $perfil, $hash]);
}

echo json_encode(['sucesso' => true]);

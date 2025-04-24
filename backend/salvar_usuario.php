<?php
require 'db.php';

$data = json_decode(file_get_contents("php://input"), true);
if (!$data) {
  http_response_code(400);
  echo json_encode(['erro' => 'Dados inválidos']);
  exit;
}

$id = $data['id'] ?? null;
$nome = trim($data['nome'] ?? '');
$email = trim($data['email'] ?? '');
$perfil = $data['perfil'] ?? 'financeiro';
$senha = $data['senha'] ?? '';

if (empty($nome) || empty($email)) {
  http_response_code(400);
  echo json_encode(['erro' => 'Nome e e-mail são obrigatórios']);
  exit;
}

try {
  if ($id) {
    // Atualização
    if (!empty($senha)) {
      $hash = password_hash($senha, PASSWORD_DEFAULT);
      $stmt = $pdo->prepare("UPDATE usuarios_admin SET nome = ?, email = ?, perfil = ?, senha_hash = ? WHERE id = ?");
      $stmt->execute([$nome, $email, $perfil, $hash, $id]);
    } else {
      $stmt = $pdo->prepare("UPDATE usuarios_admin SET nome = ?, email = ?, perfil = ? WHERE id = ?");
      $stmt->execute([$nome, $email, $perfil, $id]);
    }
  } else {
    // Novo cadastro
    if (empty($senha)) {
      http_response_code(400);
      echo json_encode(['erro' => 'Senha é obrigatória para novo cadastro']);
      exit;
    }
    $hash = password_hash($senha, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT INTO usuarios_admin (nome, email, perfil, senha_hash) VALUES (?, ?, ?, ?)");
    $stmt->execute([$nome, $email, $perfil, $hash]);
  }

  echo json_encode(['sucesso' => true]);
} catch (PDOException $e) {
  http_response_code(500);
  echo json_encode(['erro' => 'Erro ao salvar: ' . $e->getMessage()]);
}

<?php
require 'db.php';
session_start();
/*
if (!isset($_SESSION['admin_id']) || $_SESSION['perfil'] !== 'admin') {
  http_response_code(403);
  exit;
}
*/
if (!isset($_GET['id'])) {
  http_response_code(400);
  echo json_encode(['erro' => 'ID não informado']);
  exit;
}

$id = (int) $_GET['id'];

if ($id == $_SESSION['admin_id']) {
  http_response_code(403);
  echo json_encode(['erro' => 'Você não pode excluir seu próprio usuário.']);
  exit;
}

$stmt = $conn->prepare("DELETE FROM usuarios_admin WHERE id = ?");
$stmt->execute([$id]);

echo json_encode(['sucesso' => true]);

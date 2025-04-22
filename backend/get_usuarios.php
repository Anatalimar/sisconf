<?php
require '../conexao.php';
session_start();

if (!isset($_SESSION['admin_id']) || $_SESSION['perfil'] !== 'admin') {
  http_response_code(403);
  exit;
}

$stmt = $conn->query("SELECT id, nome, email, perfil, criado_em FROM usuarios_admin ORDER BY nome");
echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));

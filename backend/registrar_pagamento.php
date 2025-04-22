<?php
require 'db.php';
session_start();
if (!isset($_SESSION['admin_id'])) exit;

$data = json_decode(file_get_contents("php://input"), true);
$colaborador_id = $data['colaborador_id'];
$valor = floatval($data['valor']);

$stmt = $pdo->prepare("INSERT INTO pagamentos (colaborador_id, valor, data_pagamento) VALUES (?, ?, NOW())");
$stmt->execute([$colaborador_id, $valor]);

echo json_encode(['status' => 'ok']);

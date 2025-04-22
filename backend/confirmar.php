<?php
require 'db.php';

$data = json_decode(file_get_contents("php://input"), true);

$colaborador_id = $data['colaborador_id'];
$vai_participar = $data['vai_participar'] === 'sim' ? 1 : 0;
$acompanhantes = (int) $data['acompanhantes'];

$stmt = $pdo->prepare("REPLACE INTO confirmacoes (colaborador_id, vai_participar, acompanhantes) VALUES (?, ?, ?)");
$stmt->execute([$colaborador_id, $vai_participar, $acompanhantes]);

echo json_encode(['status' => 'ok']);

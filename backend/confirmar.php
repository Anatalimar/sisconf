<?php
require 'db.php';

try {
    // Receber os dados
    $data = json_decode(file_get_contents("php://input"), true);

    if (
        empty($data['colaborador_id']) ||
        empty($data['vai_participar']) ||
        !isset($data['acompanhantes'])
    ) {
        throw new Exception("Dados inválidos ou ausentes.");
    }

    $colaborador_id = $data['colaborador_id'];
    $vai_participar = $data['vai_participar'] === 'sim' ? 1 : 0;
    $acompanhantes = (int) $data['acompanhantes'];

    // Preparar e executar a consulta
    $stmt = $conn->prepare("REPLACE INTO confirmacoes (colaborador_id, vai_participar, acompanhantes) VALUES (?, ?, ?)");
    $stmt->execute([$colaborador_id, $vai_participar, $acompanhantes]);

    echo json_encode(['status' => 'ok']);
} catch (Exception $e) {
    error_log("Erro ao gravar confirmação: " . $e->getMessage());
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}

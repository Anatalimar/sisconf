<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dados = json_decode(file_get_contents('php://input'), true);

    $colaboradorId = (int)$dados['colaborador_id'];
    $valorPago = (float)$dados['valor'];

    error_log("Dados recebidos: colaborador_id=$colaboradorId, valor=$valorPago");

    if ($colaboradorId > 0 && $valorPago > 0) {
        try {
            // Insere o pagamento na tabela pagamentos_parcelas
            $stmt = $conn->prepare("
                INSERT INTO pagamentos_parcelas (parcela_id, valor_pago, data_pagamento)
                SELECT p.id, :valor_pago, CURRENT_DATE
                FROM parcelas p
                WHERE p.colaborador_id = :colaborador_id AND p.status = 'pendente'
                LIMIT 1
            ");
            $stmt->execute([
                ':valor_pago' => $valorPago,
                ':colaborador_id' => $colaboradorId
            ]);

            error_log("Linhas afetadas pela inserção: " . $stmt->rowCount());

            if ($stmt->rowCount() > 0) {
                // Atualiza o status da parcela para 'pago'
                $stmt = $conn->prepare("
                    UPDATE parcelas
                    SET status = 'pago'
                    WHERE id IN (
                        SELECT p.id
                        FROM parcelas p
                        LEFT JOIN pagamentos_parcelas pp ON pp.parcela_id = p.id
                        WHERE p.colaborador_id = :colaborador_id
                        GROUP BY p.id
                        HAVING SUM(pp.valor_pago) >= p.valor
                    )
                ");
                $stmt->execute([':colaborador_id' => $colaboradorId]);

                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'error' => 'Nenhuma parcela pendente encontrada para este colaborador.']);
            }
        } catch (PDOException $e) {
            error_log("Erro PDO: " . $e->getMessage());
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Dados inválidos']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Método inválido']);
}
?>
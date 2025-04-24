<?php
require 'db.php';

// Habilitar logs de erro para depuração
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try {
    // Total de colaboradores cadastrados
    $total_colaboradores = $conn->query("SELECT COUNT(*) FROM colaboradores")->fetchColumn();

    // Total de confirmados na confraternização
    $confirmados = $conn->query("
        SELECT COUNT(*)
        FROM confirmacoes
        WHERE vai_participar = 1
    ")->fetchColumn();

    // Total de acompanhantes registrados
    $total_acompanhantes = $conn->query("
        SELECT SUM(acompanhantes)
        FROM confirmacoes
        WHERE vai_participar = 1
    ")->fetchColumn();
    $total_acompanhantes = $total_acompanhantes ?? 0;

    // Total geral de pessoas
    $total_geral = $confirmados + $total_acompanhantes;

    // Total arrecadado
    $valor_total = $conn->query("
        SELECT SUM(valor_pago)
        FROM pagamentos_parcelas
    ")->fetchColumn();
    $valor_total = $valor_total ?? 0.00;

    // Distribuição por setor
    $setores = $conn->query("
        SELECT c.setor, COUNT(cf.id) AS total
        FROM colaboradores c
        LEFT JOIN confirmacoes cf ON c.id = cf.colaborador_id AND cf.vai_participar = 1
        GROUP BY c.setor
        ORDER BY total DESC
    ")->fetchAll(PDO::FETCH_ASSOC);

    // Retornar os dados como JSON
    header('Content-Type: application/json');
    echo json_encode([
        'total_colaboradores' => $total_colaboradores,
        'confirmados' => $confirmados,
        'acompanhantes' => $total_acompanhantes,
        'total_geral' => $total_geral,
        'valor_total' => number_format($valor_total, 2, ',', '.'),
        'setores' => $setores
    ]);
} catch (Exception $e) {
    error_log("Erro ao gerar dashboard: " . $e->getMessage());
    http_response_code(500);
    echo json_encode(['error' => 'Erro ao processar os dados.', 'details' => $e->getMessage()]);
}
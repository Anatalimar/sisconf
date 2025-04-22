<?php
// dashboard_dados.php
require '../conexao.php';
session_start();

if (!isset($_SESSION['admin_id'])) {
  http_response_code(403);
  exit;
}

// Total de colaboradores cadastrados
$total_colaboradores = $conn->query("SELECT COUNT(*) FROM colaboradores")->fetchColumn();

// Total de confirmados na confraternização
$confirmados = $conn->query("SELECT COUNT(*) FROM colaboradores WHERE confirmacao = 'sim'")->fetchColumn();

// Total de acompanhantes registrados
$total_acompanhantes = $conn->query("SELECT SUM(acompanhantes) FROM colaboradores WHERE confirmacao = 'sim'")->fetchColumn();
$total_acompanhantes = $total_acompanhantes ?? 0;

// Total geral de pessoas
$total_geral = $confirmados + $total_acompanhantes;

// Total arrecadado
$valor_total = $conn->query("SELECT SUM(valor_pago) FROM pagamentos")->fetchColumn();
$valor_total = $valor_total ?? 0.00;

// Distribuição por setor
$setores = $conn->query("SELECT setor, COUNT(*) as total FROM colaboradores WHERE confirmacao = 'sim' GROUP BY setor ORDER BY total DESC")
            ->fetchAll(PDO::FETCH_ASSOC);

$data = [
  'total_colaboradores' => $total_colaboradores,
  'confirmados' => $confirmados,
  'acompanhantes' => $total_acompanhantes,
  'total_geral' => $total_geral,
  'valor_total' => number_format($valor_total, 2, ',', '.'),
  'setores' => $setores
];

header('Content-Type: application/json');
echo json_encode($data);

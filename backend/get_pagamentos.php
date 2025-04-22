<?php
require 'db.php';
session_start();
if (!isset($_SESSION['admin_id'])) exit;

$valor_participante = 50.00;
$valor_acompanhante = 30.00;

$sql = "
  SELECT c.id, c.nome, c.setor, conf.vai_participar, conf.acompanhantes,
         IFNULL(SUM(p.valor), 0) as total_pago
  FROM colaboradores c
  LEFT JOIN confirmacoes conf ON conf.colaborador_id = c.id
  LEFT JOIN pagamentos p ON p.colaborador_id = c.id
  GROUP BY c.id
  ORDER BY c.nome
";
$stmt = $pdo->query($sql);
$result = [];

foreach ($stmt as $row) {
    $total = 0;
    if ($row['vai_participar']) {
        $total += $valor_participante + ($row['acompanhantes'] * $valor_acompanhante);
    }

    $result[] = [
        'id' => $row['id'],
        'nome' => $row['nome'],
        'setor' => $row['setor'],
        'participa' => $row['vai_participar'] ? 'Sim' : 'Não',
        'acompanhantes' => $row['acompanhantes'],
        'total' => number_format($total, 2, ',', '.'),
        'pago' => number_format($row['total_pago'], 2, ',', '.'),
        'faltando' => number_format(max(0, $total - $row['total_pago']), 2, ',', '.')
    ];
}

echo json_encode($result);

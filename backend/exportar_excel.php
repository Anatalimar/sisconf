<?php
require 'db.php';
session_start();
if (!isset($_SESSION['admin_id'])) exit;

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=pagamentos_detin.xls");
header("Pragma: no-cache");
header("Expires: 0");

echo "<table border='1'>";
echo "<tr>
        <th>Colaborador</th>
        <th>Setor</th>
        <th>Participa</th>
        <th>Acompanhantes</th>
        <th>Total (R$)</th>
        <th>Pago (R$)</th>
        <th>Faltando (R$)</th>
      </tr>";

$valor_participante = 50;
$valor_acompanhante = 30;

$stmt = $pdo->query("
  SELECT c.nome, c.setor, conf.vai_participar, conf.acompanhantes,
         IFNULL(SUM(p.valor), 0) as total_pago
  FROM colaboradores c
  LEFT JOIN confirmacoes conf ON conf.colaborador_id = c.id
  LEFT JOIN pagamentos p ON p.colaborador_id = c.id
  GROUP BY c.id
");

foreach ($stmt as $r) {
  $total = $r['vai_participar'] ? $valor_participante + ($r['acompanhantes'] * $valor_acompanhante) : 0;
  $faltando = max(0, $total - $r['total_pago']);

  echo "<tr>
          <td>{$r['nome']}</td>
          <td>{$r['setor']}</td>
          <td>" . ($r['vai_participar'] ? 'Sim' : 'Não') . "</td>
          <td>{$r['acompanhantes']}</td>
          <td>" . number_format($total, 2, ',', '.') . "</td>
          <td>" . number_format($r['total_pago'], 2, ',', '.') . "</td>
          <td>" . number_format($faltando, 2, ',', '.') . "</td>
        </tr>";
}

echo "</table>";

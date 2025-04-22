<?php
// gerar_pdf.php
require '../conexao.php';
require '../vendor/autoload.php';

use Dompdf\Dompdf;

session_start();
if (!isset($_SESSION['admin_id'])) {
  http_response_code(403);
  exit;
}

// Consulta os dados de pagamentos
$sql = "
SELECT c.nome, c.setor, p.valor_pago, p.data_pagamento, p.tipo
FROM pagamentos p
JOIN colaboradores c ON p.colaborador_id = c.id
ORDER BY c.setor, c.nome, p.data_pagamento DESC
";
$stmt = $conn->query($sql);
$pagamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);

$html = '<h2 style="text-align:center;">Relatório de Pagamentos - Confraternização DETIN</h2>';
$html .= '<table width="100%" border="1" cellspacing="0" cellpadding="5">';
$html .= '<thead><tr><th>Nome</th><th>Setor</th><th>Tipo</th><th>Valor Pago</th><th>Data</th></tr></thead><tbody>';

foreach ($pagamentos as $p) {
  $html .= '<tr>';
  $html .= '<td>' . htmlspecialchars($p['nome']) . '</td>';
  $html .= '<td>' . htmlspecialchars($p['setor']) . '</td>';
  $html .= '<td>' . ($p['tipo'] == 'colaborador' ? 'Colaborador' : 'Acompanhante') . '</td>';
  $html .= '<td>R$ ' . number_format($p['valor_pago'], 2, ',', '.') . '</td>';
  $html .= '<td>' . date('d/m/Y', strtotime($p['data_pagamento'])) . '</td>';
  $html .= '</tr>';
}

$html .= '</tbody></table>';

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("relatorio_pagamentos.pdf", ["Attachment" => false]);
exit;

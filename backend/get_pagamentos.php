<?php
require 'db.php';

// Valores fixos para cálculo
$valor_participante = 50.00;
$valor_acompanhante = 30.00;

// Consulta SQL para obter os dados
$sql = "
  SELECT 
      c.id,
      c.nome,
      c.setor,
      conf.vai_participar,
      conf.acompanhantes,
      SUM(p.valor) AS total_a_pagar,
      IFNULL(SUM(pp.valor_pago), 0) AS total_pago
  FROM 
      colaboradores c
  LEFT JOIN 
      confirmacoes conf ON conf.colaborador_id = c.id
  LEFT JOIN 
      parcelas p ON p.colaborador_id = c.id
  LEFT JOIN 
      pagamentos_parcelas pp ON pp.parcela_id = p.id
  GROUP BY 
      c.id
  ORDER BY 
      c.nome
";

try {
    $stmt = $conn->query($sql);
    $result = [];

    foreach ($stmt as $row) {
        $total = 0;
        if ($row['vai_participar']) {
            $total += $valor_participante + ($row['acompanhantes'] * $valor_acompanhante);
        }

        // Soma o total das parcelas ao valor fixo
        $total += $row['total_a_pagar'];

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
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
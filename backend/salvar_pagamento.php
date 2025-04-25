<?php
include('config.php'); // Conexão com o banco

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $parcela_id = $_POST['parcela_id'];
    $valor_pago = $_POST['valor_pago'];
    $data_pagamento = $_POST['data_pagamento'];

    // Atualiza a parcela como "pago"
    $sql = "UPDATE parcelas SET status = 'pago', data_pagamento = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$data_pagamento, $parcela_id]);

    // Registra o pagamento
    $sql = "INSERT INTO pagamentos_parcelas (parcela_id, valor_pago, data_pagamento) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$parcela_id, $valor_pago, $data_pagamento]);

    echo json_encode(['status' => 'success', 'message' => 'Pagamento registrado com sucesso']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Método inválido']);
}
?>

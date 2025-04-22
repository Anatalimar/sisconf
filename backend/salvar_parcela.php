<?php
include('config.php'); // Conexão com o banco

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $colaborador_id = $_POST['colaborador_id'];
    $valor = $_POST['valor'];
    $data_vencimento = $_POST['data_vencimento'];
    $status = 'pendente'; // Inicialmente, a parcela está pendente

    // Verifica se é uma edição ou uma nova parcela
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $sql = "UPDATE parcelas SET colaborador_id = ?, valor = ?, data_vencimento = ?, status = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$colaborador_id, $valor, $data_vencimento, $status, $id]);
        echo json_encode(['status' => 'success', 'message' => 'Parcela atualizada com sucesso']);
    } else {
        // Criação de nova parcela
        $sql = "INSERT INTO parcelas (colaborador_id, valor, data_vencimento, status) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$colaborador_id, $valor, $data_vencimento, $status]);
        echo json_encode(['status' => 'success', 'message' => 'Parcela cadastrada com sucesso']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Método inválido']);
}
?>

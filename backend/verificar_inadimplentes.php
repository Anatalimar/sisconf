<?php
include('config.php'); // Conexão com o banco

$sql = "SELECT c.nome, c.setor, p.valor, p.data_vencimento FROM parcelas p 
        INNER JOIN colaboradores c ON p.colaborador_id = c.id
        WHERE p.status = 'pendente'";

$stmt = $pdo->prepare($sql);
$stmt->execute();

$inadimplentes = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($inadimplentes);
?>

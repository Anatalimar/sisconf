<?php
include('config.php'); // Conexão com o banco

$colaborador_id = $_GET['colaborador_id']; // Filtra pelo colaborador

$sql = "SELECT * FROM parcelas WHERE colaborador_id = ? ORDER BY data_vencimento ASC";
$stmt = $pdo->prepare($sql);
$stmt->execute([$colaborador_id]);

$parcelas = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($parcelas);
?>

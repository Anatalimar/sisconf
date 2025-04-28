<?php
require 'db.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

try {
    $setor = $_GET['setor'] ?? '';
    
    if (empty($setor)) {
        echo json_encode([]);
        exit;
    }

    $stmt = $conn->prepare("SELECT id, nome, contratacao FROM colaboradores WHERE setor = ? ORDER BY nome");
    $stmt->execute([$setor]);
    $colaboradores = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($colaboradores);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Erro no banco de dados: ' . $e->getMessage()]);
}
?>
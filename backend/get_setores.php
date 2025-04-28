<?php
require 'db.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); // CORS para APIs

try {
    // Verificar se a conexão com o banco está ativa
    if (!$conn) {
        throw new Exception("Não foi possível conectar ao banco de dados", 500);
    }

    // Preparar e executar a consulta com tratamento de erros
    $stmt = $conn->prepare("SELECT DISTINCT setor FROM colaboradores WHERE setor IS NOT NULL ORDER BY setor");
    
    if (!$stmt->execute()) {
        throw new Exception("Erro ao consultar setores no banco de dados", 500);
    }

    // Obter resultados
    $setores = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);

    // Verificar se há resultados
    if (empty($setores)) {
        http_response_code(204); // No Content
        exit;
    }

    // Enviar resposta
    echo json_encode([
        'status' => 'success',
        'data' => $setores,
        'count' => count($setores),
        'timestamp' => date('Y-m-d H:i:s')
    ]);

} catch (PDOException $e) {
    // Erros específicos do PDO
    error_log("PDO Error in get_setores.php: " . $e->getMessage());
    http_response_code(500);
    echo json_encode([
        'status' => 'error',
        'message' => 'Erro no banco de dados',
        'error_code' => $e->getCode()
    ]);
    
} catch (Exception $e) {
    // Outros erros
    error_log("Error in get_setores.php: " . $e->getMessage());
    http_response_code($e->getCode() ?: 500);
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}

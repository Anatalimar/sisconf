<?php
require 'db.php';

$setor = $_GET['setor'] ?? '';

// Ajuste da consulta para incluir o tipo de contratação
$query = "
    SELECT c.id, c.nome, c.tipo_contratacao
    FROM colaboradores c
    JOIN confirmacoes conf ON conf.colaborador_id = c.id
    WHERE conf.vai_participar = 1
";

if (!empty($setor)) {
    $query .= " AND c.setor = ?";
}

$query .= " ORDER BY c.nome";

$stmt = $conn->prepare($query);

if (!empty($setor)) {
    $stmt->execute([$setor]);
} else {
    $stmt->execute();
}

$colaboradores = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($colaboradores);

/*

$setor = $_GET['setor'] ?? '';
$confirmados = $_GET['confirmados'] ?? '';

if ($confirmados == '1') {
    // Retorna apenas colaboradores confirmados, ignorando o setor
    $stmt = $conn->prepare("SELECT id, nome FROM colaboradores WHERE confirmou = 1 ORDER BY nome");
    $stmt->execute();
} elseif (!empty($setor)) {
    // Retorna colaboradores de um setor específico
    $stmt = $conn->prepare("SELECT id, nome FROM colaboradores WHERE setor = ? ORDER BY nome");
    $stmt->execute([$setor]);
} else {
    // Retorna todos os colaboradores (sem filtro)
    $stmt = $conn->query("SELECT id, nome FROM colaboradores ORDER BY nome");
}

$colaboradores = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($colaboradores);

*/
?>
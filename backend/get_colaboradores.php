<?php
require 'db.php';

$setor = $_GET['setor'] ?? '';

$stmt = $conn->prepare("SELECT id, nome FROM colaboradores WHERE setor = ? ORDER BY nome");
$stmt->execute([$setor]);

$colaboradores = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($colaboradores);
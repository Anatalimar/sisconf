<?php
require 'db.php';

$stmt = $conn->query("SELECT DISTINCT setor FROM colaboradores ORDER BY setor");
$setores = $stmt->fetchAll(PDO::FETCH_COLUMN);

echo json_encode($setores);

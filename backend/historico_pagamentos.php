<?php
require 'db.php';
session_start();
if (!isset($_SESSION['admin_id'])) exit;

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT valor, DATE_FORMAT(data_pagamento, '%d/%m/%Y %H:%i') as data FROM pagamentos WHERE colaborador_id = ? ORDER BY data_pagamento DESC");
$stmt->execute([$id]);
echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));

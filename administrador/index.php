<?php
session_start();
if (!isset($_SESSION['usuario_logado']) || $_SESSION['usuario_logado'] !== true) {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISCONF - Sistema de Controle Financeiro</title>
    <link rel="stylesheet" href="assistentes/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container">
        <?php include 'header.php'; ?>
        <?php include 'sidebar.php'; ?>
        
        <main class="main-content">
            <!-- O conteúdo será carregado aqui via AJAX -->
        </main>
    </div>
    
    <?php include 'footer.php'; ?>
    <script src="assistentes/script.js"></script>
</body>
</html>
<?php
session_start();
if (!isset($_SESSION['usuario_logado'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISCONF - Sistema de Controle Financeiro</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assistentes/style.css">
</head>
<body>
    <div class="container">
        <?php include 'paginas/header.php'; ?>
        
        <div class="main-content">
            <?php include 'paginas/sidebar.php'; ?>
            
            <div class="content" id="conteudo-principal">
                <!-- O conteúdo será carregado dinamicamente aqui via AJAX -->
                <?php include 'paginas/dashboard.php'; ?>
            </div>
        </div>
        
        <?php include 'paginas/footer.php'; ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="assistentes/script.js"></script>
</body>
</html>
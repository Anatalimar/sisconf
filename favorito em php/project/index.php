<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISCONF - Sistema de Controle e Gerenciamento</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/styles.css">
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body>
    <div class="app-container">
        <?php include 'includes/sidebar.php'; ?>
        
        <div class="main-content">
            <?php include 'includes/header.php'; ?>
            
            <main class="content">
                <?php
                $page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
                $allowedPages = [
                    'dashboard',
                    'usuarios',
                    'colaboradores',
                    'pagamentos',
                    'relatorios-usuarios',
                    'relatorios-colaboradores',
                    'relatorios-pagamentos'
                ];
                
                if (in_array($page, $allowedPages)) {
                    include "pages/$page.php";
                } else {
                    include "pages/dashboard.php";
                }
                ?>
            </main>
            
            <?php include 'includes/footer.php'; ?>
        </div>
    </div>

    <script src="assets/js/app.js"></script>
</body>
</html>
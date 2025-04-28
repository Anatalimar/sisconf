<?php
session_start();
if (!isset($_SESSION['usuario'])) {
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
    <link rel="stylesheet" href="assistentes/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <?php include 'paginas/header.php'; ?>
        <?php include 'paginas/sidebar.php'; ?>
        
        <main class="main-content">
            <?php
            $pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 'dashboard';
            $paginas_validas = [
                'dashboard', 'usuarios', 'colaboradores', 'pagamentos',
                'relatorio-usuarios', 'relatorio-colaboradores', 'relatorio-pagamentos'
            ];
            
            if (in_array($pagina, $paginas_validas)) {
                include "paginas/{$pagina}.php";
            } else {
                include "paginas/dashboard.php";
            }
            ?>
        </main>
    </div>
    
    <?php include 'paginas/footer.php'; ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="assistentes/script.js"></script>
</body>
</html>
<?php
/*
session_start();
if (!isset($_SESSION['admin_id']) || $_SESSION['perfil'] !== 'admin') {
    header("Location: login.php");
    exit;
}
    */
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SISCONF - Painel Administrativo</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Estilo para fixar o rodapé */
        body {
            margin: 0; /* Remove margens padrão do corpo */
            padding-bottom: 60px; /* Espaço para evitar sobreposição com o rodapé */
            background-color: #f3f4f6; /* Cor de fundo geral */
        }
        main {
            padding: 20px; /* Espaçamento interno para o conteúdo principal */
        }
        footer {
            position: fixed; /* Fixa o rodapé na parte inferior */
            bottom: 0; /* Alinha o rodapé ao final da tela */
            left: 0;
            width: 100%; /* Ocupa toda a largura da tela */
            background-color: #1f2937; /* Cor do rodapé */
            color: white;
            text-align: center;
            padding: 1rem 0; /* Espaçamento interno do rodapé */
            z-index: 1000; /* Garante que o rodapé fique acima de outros elementos */
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-800">
    <!-- Cabeçalho -->
    <header class="bg-blue-600 text-white p-4">
        <div class="max-w-5xl mx-auto flex justify-between items-center">
            <h1 class="text-xl font-bold">SISCONF</h1>
            <nav>
                <ul class="flex space-x-4">
                    <li><a href="painel.php" class="hover:underline">Início</a></li>
                    <li><a href="painel.php?pagina=usuarios" class="hover:underline">Usuários</a></li>
                    <li><a href="painel.php?pagina=admin_parcelas" class="hover:underline">Gerenciar Parcelas</a></li>
                    <li><a href="painel.php?pagina=relatorios" class="hover:underline">Relatórios</a></li>
                    <li><a href="logout.php" class="hover:underline">Sair</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Conteúdo Principal -->
    <main class="max-w-5xl mx-auto p-6">
        <?php
        // Carrega o conteúdo dinâmico com base no parâmetro "pagina"
        if (isset($_GET['pagina'])) {
            $pagina = $_GET['pagina'];
            if (file_exists($pagina . '.php')) {
                include $pagina . '.php';
            } else {
                echo '<p class="text-red-500">Página não encontrada.</p>';
            }
        } else {
            include '../backend/dash_status.php'; // Página padrão
        }
        ?>
    </main>

    <!-- Rodapé Fixo -->
    <footer class="bg-gray-800 text-white text-center p-4">
        <p>&copy; 2023 Painel Administrativo</p>
    </footer>
</body>
</html>
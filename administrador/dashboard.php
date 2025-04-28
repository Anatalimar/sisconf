<?php
// Verifica se é uma requisição AJAX
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    // Se for AJAX, retorna apenas o conteúdo
    
    // Sua lógica PHP aqui
    require_once '../backend/db.php';
    $totalColaboradores = $conn->query("SELECT COUNT(*) FROM colaboradores")->fetchColumn();
    // ... resto da lógica
    
    // HTML que será injetado
    ?>
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Dashboard</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="stat-card">
                        <div class="stat-icon bg-primary">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stat-info">
                            <h3><?= $totalColaboradores ?></h3>
                            <p>Colaboradores</p>
                        </div>
                    </div>
                </div>
                <!-- Restante do conteúdo -->
            </div>
        </div>
    </div>
    <?php
    exit();
}

// Se não for AJAX, redireciona
header("Location: index.php");
exit();
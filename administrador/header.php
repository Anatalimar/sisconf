<?php
// Verifica se a sessão está ativa
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<header class="header">
    <div class="logo">
        <img src="imagens/logo.png" alt="SISCONF Logo">
        <!-- Título opcional para mobile -->
    </div>
    
    <div class="user-info">
        <div class="user-dropdown" id="userDropdown">
            <div class="user-profile">
                <img src="<?= isset($_SESSION['usuario_avatar']) ? htmlspecialchars($_SESSION['usuario_avatar']) : 'imagens/user-avatar.jpg' ?>" 
                     alt="Avatar do Usuário"
                     class="user-avatar">
                <span class="user-name"><?= isset($_SESSION['usuario_nome']) ? htmlspecialchars($_SESSION['usuario_nome']) : 'Usuário' ?></span>
                <i class="fas fa-chevron-down dropdown-icon"></i>
            </div>
            <div class="dropdown-menu">
                <a href="perfil.php" class="dropdown-item" data-page="perfil">
                    <i class="fas fa-user"></i> Meu Perfil
                </a>
                <a href="#" class="dropdown-item" onclick="fazerLogout(); return false;">
                    <i class="fas fa-sign-out-alt"></i> Sair
                </a>
            </div>
        </div>
    </div>
</header>

<script>
// Adiciona interação ao dropdown do usuário
document.addEventListener('DOMContentLoaded', function() {
    const dropdown = document.getElementById('userDropdown');
    
    dropdown.addEventListener('click', function(e) {
        e.stopPropagation();
        this.querySelector('.dropdown-menu').classList.toggle('show');
    });

    // Fecha o dropdown ao clicar fora
    document.addEventListener('click', function() {
        const openMenu = document.querySelector('.dropdown-menu.show');
        if (openMenu) {
            openMenu.classList.remove('show');
        }
    });
});
</script>
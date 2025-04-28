<header class="header">
    <div class="logo">
        <img src="imagens/logo.png" alt="SISCONF Logo">
            <h1>SIGCONF - Sistema de Gestão de Confraternização</h1>
    </div>
    
    <div class="user-info">
        <div class="user-dropdown">
            <div style="display: flex; align-items: center;">
                <img src="imagens/user-avatar.jpg" alt="User Avatar">
                <span><?php echo $_SESSION['usuario']['nome']; ?></span>
                <i class="fas fa-chevron-down" style="margin-left: 10px;"></i>
            </div>
            <div class="dropdown-menu">
                <a href="#" onclick="fazerLogout()"><i class="fas fa-sign-out-alt"></i> Sair</a>
            </div>
        </div>
    </div>
</header>
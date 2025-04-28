<header class="header">
    <div class="header-left">
        <img src="imagens/logo.png" alt="Logo SISCONF" class="logo">
    </div>
    <div class="header-right">
        <div class="user-info">
            <span class="user-name"><?php echo $_SESSION['usuario']['nome']; ?></span>
            <img src="imagens/user-avatar.jpg" alt="Avatar" class="user-avatar">
            <div class="user-dropdown">
                <a href="#" id="logout">Sair</a>
            </div>
        </div>
    </div>
</header>
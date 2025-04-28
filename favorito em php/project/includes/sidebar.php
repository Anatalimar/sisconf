<aside class="sidebar">
    <div class="sidebar-header">
        <div class="sidebar-logo">
            <div class="sidebar-logo-icon">
                <i data-lucide="database"></i>
            </div>
            <div>
                <h1 class="sidebar-title">SISCONF</h1>
                <p class="sidebar-subtitle">Sistema de Controle e Gerenciamento</p>
            </div>
        </div>
    </div>
    
    <nav class="sidebar-nav">
        <div class="nav-item">
            <a href="?page=dashboard" class="nav-link <?php echo $page === 'dashboard' ? 'active' : ''; ?>">
                <i data-lucide="layout-dashboard"></i>
                <span>Dashboard</span>
            </a>
        </div>
        
        <div class="nav-item">
            <button class="nav-link menu-toggle w-full">
                <i data-lucide="users"></i>
                <span>Cadastros</span>
                <i data-lucide="chevron-right" class="menu-icon ml-auto"></i>
            </button>
            <div class="pl-8" style="display: none;">
                <a href="?page=usuarios" class="nav-link <?php echo $page === 'usuarios' ? 'active' : ''; ?>">
                    <span>Usuários</span>
                </a>
                <a href="?page=colaboradores" class="nav-link <?php echo $page === 'colaboradores' ? 'active' : ''; ?>">
                    <span>Colaboradores</span>
                </a>
            </div>
        </div>
        
        <div class="nav-item">
            <button class="nav-link menu-toggle w-full">
                <i data-lucide="credit-card"></i>
                <span>Financeiro</span>
                <i data-lucide="chevron-right" class="menu-icon ml-auto"></i>
            </button>
            <div class="pl-8" style="display: none;">
                <a href="?page=pagamentos" class="nav-link <?php echo $page === 'pagamentos' ? 'active' : ''; ?>">
                    <span>Pagamentos</span>
                </a>
            </div>
        </div>
        
        <div class="nav-item">
            <button class="nav-link menu-toggle w-full">
                <i data-lucide="file-text"></i>
                <span>Relatórios</span>
                <i data-lucide="chevron-right" class="menu-icon ml-auto"></i>
            </button>
            <div class="pl-8" style="display: none;">
                <a href="?page=relatorios-usuarios" class="nav-link <?php echo $page === 'relatorios-usuarios' ? 'active' : ''; ?>">
                    <span>Relatório de Usuários</span>
                </a>
                <a href="?page=relatorios-colaboradores" class="nav-link <?php echo $page === 'relatorios-colaboradores' ? 'active' : ''; ?>">
                    <span>Relatório de Colaboradores</span>
                </a>
                <a href="?page=relatorios-pagamentos" class="nav-link <?php echo $page === 'relatorios-pagamentos' ? 'active' : ''; ?>">
                    <span>Relatório de Pagamentos</span>
                </a>
            </div>
        </div>
    </nav>
    
    <div class="sidebar-footer">
        <p class="text-sm text-gray-500">SISCONF v1.0</p>
        <p class="text-sm text-gray-500">&copy; 2025 Todos os direitos reservados</p>
    </div>
</aside>
<?php
$dateStart = date('Y-m-d', strtotime('-30 days'));
$dateEnd = date('Y-m-d');

$stats = [
    'total' => 184,
    'active' => 156,
    'new' => 28,
    'growth' => 12
];

$distribution = [
    ['role' => 'Administradores', 'count' => 15, 'percentage' => 8],
    ['role' => 'Gerentes', 'count' => 42, 'percentage' => 23],
    ['role' => 'Usuários', 'count' => 127, 'percentage' => 69]
];

$status = [
    ['label' => 'Ativos', 'count' => 156, 'percentage' => 85],
    ['label' => 'Inativos', 'count' => 28, 'percentage' => 15]
];
?>

<div class="page-header">
    <div class="flex justify-between items-start">
        <div>
            <h1 class="page-title">Relatório de Usuários</h1>
            <p class="page-subtitle">Visualize e exporte dados sobre os usuários do sistema</p>
        </div>
        <button class="btn btn-primary">
            <i data-lucide="file-down"></i>
            <span>Exportar PDF</span>
        </button>
    </div>
</div>

<div class="card mb-6">
    <h2 class="text-lg font-medium mb-4 flex items-center gap-2">
        <i data-lucide="filter"></i>
        <span>Filtros</span>
    </h2>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="form-group">
            <label class="form-label" for="status">Status</label>
            <select id="status" class="form-control">
                <option value="">Todos</option>
                <option value="active">Ativos</option>
                <option value="inactive">Inativos</option>
            </select>
        </div>
        
        <div class="form-group">
            <label class="form-label" for="role">Perfil</label>
            <select id="role" class="form-control">
                <option value="">Todos</option>
                <option value="admin">Administrador</option>
                <option value="manager">Gerente</option>
                <option value="user">Usuário</option>
            </select>
        </div>
        
        <div class="form-group">
            <label class="form-label" for="dateStart">
                <div class="flex items-center gap-1">
                    <i data-lucide="calendar"></i>
                    <span>Data Inicial</span>
                </div>
            </label>
            <input type="date" id="dateStart" class="form-control" value="<?php echo $dateStart; ?>">
        </div>
        
        <div class="form-group">
            <label class="form-label" for="dateEnd">
                <div class="flex items-center gap-1">
                    <i data-lucide="calendar">
                    <span>Data Final</span>
                </div>
            </label>
            <input type="date" id="dateEnd" class="form-control" value="<?php echo $dateEnd; ?>">
        </div>
    </div>
    
    <div class="flex justify-end mt-4">
        <button class="btn btn-primary">Aplicar Filtros</button>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
    <div class="card">
        <p class="text-sm font-medium text-gray-500">Total de Usuários</p>
        <h2 class="text-3xl font-bold mt-2"><?php echo $stats['total']; ?></h2>
        <div class="flex items-center text-success text-sm mt-2">
            <span>+<?php echo $stats['growth']; ?>% desde o último mês</span>
        </div>
    </div>
    
    <div class="card">
        <p class="text-sm font-medium text-gray-500">Usuários Ativos</p>
        <h2 class="text-3xl font-bold mt-2"><?php echo $stats['active']; ?></h2>
        <div class="flex items-center text-success text-sm mt-2">
            <span><?php echo round(($stats['active'] / $stats['total']) * 100); ?>% do total</span>
        </div>
    </div>
    
    <div class="card">
        <p class="text-sm font-medium text-gray-500">Novos Usuários</p>
        <h2 class="text-3xl font-bold mt-2"><?php echo $stats['new']; ?></h2>
        <div class="flex items-center text-success text-sm mt-2">
            <span>No último mês</span>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
    <div class="card">
        <h2 class="text-lg font-medium mb-4">Distribuição por Perfil</h2>
        
        <div class="h-60 bg-gray-50 flex items-center justify-center rounded-lg border border-gray-100 mb-4">
            <p class="text-gray-500">Gráfico de distribuição por perfil</p>
        </div>
        
        <div class="space-y-2">
            <?php foreach ($distribution as $item): ?>
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <div class="w-3 h-3 rounded-full bg-primary mr-2"></div>
                    <span class="text-sm text-gray-600"><?php echo $item['role']; ?></span>
                </div>
                <span class="text-sm font-medium"><?php echo $item['count']; ?> (<?php echo $item['percentage']; ?>%)</span>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    
    <div class="card">
        <h2 class="text-lg font-medium mb-4">Status dos Usuários</h2>
        
        <div class="h-60 bg-gray-50 flex items-center justify-center rounded-lg border border-gray-100 mb-4">
            <p class="text-gray-500">Gráfico de status dos usuários</p>
        </div>
        
        <div class="space-y-2">
            <?php foreach ($status as $item): ?>
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <div class="w-3 h-3 rounded-full <?php echo $item['label'] === 'Ativos' ? 'bg-success' : 'bg-danger'; ?> mr-2"></div>
                    <span class="text-sm text-gray-600"><?php echo $item['label']; ?></span>
                </div>
                <span class="text-sm font-medium"><?php echo $item['count']; ?> (<?php echo $item['percentage']; ?>%)</span>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<div class="card">
    <h2 class="text-lg font-medium mb-4">Exportar Relatório</h2>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <button class="btn btn-primary flex items-center justify-center gap-2">
            <i data-lucide="file-down"></i>
            <span>Exportar como PDF</span>
        </button>
        
        <button class="btn btn-secondary flex items-center justify-center gap-2">
            <i data-lucide="file-down"></i>
            <span>Exportar como Excel</span>
        </button>
        
        <button class="btn flex items-center justify-center gap-2 bg-white border border-gray-300 text-gray-700 hover:bg-gray-50">
            <i data-lucide="file-down"></i>
            <span>Exportar como CSV</span>
        </button>
    </div>
</div>
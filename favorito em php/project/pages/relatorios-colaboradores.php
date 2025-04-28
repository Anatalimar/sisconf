<?php
$dateStart = date('Y-m-d', strtotime('-30 days'));
$dateEnd = date('Y-m-d');

$stats = [
    'total' => 32,
    'active' => 29,
    'new' => 5,
    'growth' => 5
];

$departments = [
    ['name' => 'TI', 'count' => 12, 'percentage' => 38],
    ['name' => 'RH', 'count' => 5, 'percentage' => 16],
    ['name' => 'Marketing', 'count' => 6, 'percentage' => 19],
    ['name' => 'Comercial', 'count' => 7, 'percentage' => 22],
    ['name' => 'Financeiro', 'count' => 2, 'percentage' => 6]
];

$tenure = [
    ['range' => 'Menos de 1 ano', 'count' => 8, 'percentage' => 25],
    ['range' => '1-2 anos', 'count' => 12, 'percentage' => 38],
    ['range' => '3-5 anos', 'count' => 9, 'percentage' => 28],
    ['range' => 'Mais de 5 anos', 'count' => 3, 'percentage' => 9]
];

$departmentSummary = [
    ['department' => 'TI', 'total' => 12, 'active' => 11, 'inactive' => 1, 'avgAge' => 32],
    ['department' => 'RH', 'total' => 5, 'active' => 5, 'inactive' => 0, 'avgAge' => 36],
    ['department' => 'Marketing', 'total' => 6, 'active' => 5, 'inactive' => 1, 'avgAge' => 29],
    ['department' => 'Comercial', 'total' => 7, 'active' => 6, 'inactive' => 1, 'avgAge' => 33],
    ['department' => 'Financeiro', 'total' => 2, 'active' => 2, 'inactive' => 0, 'avgAge' => 38]
];
?>

<div class="page-header">
    <div class="flex justify-between items-start">
        <div>
            <h1 class="page-title">Relatório de Colaboradores</h1>
            <p class="page-subtitle">Visualize e exporte dados sobre os colaboradores da empresa</p>
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
            <label class="form-label" for="department">Departamento</label>
            <select id="department" class="form-control">
                <option value="">Todos</option>
                <option value="ti">TI</option>
                <option value="rh">RH</option>
                <option value="marketing">Marketing</option>
                <option value="comercial">Comercial</option>
                <option value="financeiro">Financeiro</option>
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
                    <i data-lucide="calendar"></i>
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
        <p class="text-sm font-medium text-gray-500">Total de Colaboradores</p>
        <h2 class="text-3xl font-bold mt-2"><?php echo $stats['total']; ?></h2>
        <div class="flex items-center text-success text-sm mt-2">
            <span>+<?php echo $stats['growth']; ?>% desde o último mês</span>
        </div>
    </div>
    
    <div class="card">
        <p class="text-sm font-medium text-gray-500">Colaboradores Ativos</p>
        <h2 class="text-3xl font-bold mt-2"><?php echo $stats['active']; ?></h2>
        <div class="flex items-center text-success text-sm mt-2">
            <span><?php echo round(($stats['active'] / $stats['total']) * 100); ?>% do total</span>
        </div>
    </div>
    
    <div class="card">
        <p class="text-sm font-medium text-gray-500">Novos Colaboradores</p>
        <h2 class="text-3xl font-bold mt-2"><?php echo $stats['new']; ?></h2>
        <div class="flex items-center text-success text-sm mt-2">
            <span>No último mês</span>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
    <div class="card">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-medium">Distribuição por Departamento</h2>
            <i data-lucide="pie-chart" class="text-primary"></i>
        </div>
        
        <div class="h-60 bg-gray-50 flex items-center justify-center rounded-lg border border-gray-100 mb-4">
            <p class="text-gray-500">Gráfico de distribuição por departamento</p>
        </div>
        
        <div class="space-y-2">
            <?php foreach ($departments as $dept): ?>
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <div class="w-3 h-3 rounded-full bg-primary mr-2"></div>
                    <span class="text-sm text-gray-600"><?php echo $dept['name']; ?></span>
                </div>
                <span class="text-sm font-medium"><?php echo $dept['count']; ?> (<?php echo $dept['percentage']; ?>%)</span>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    
    <div class="card">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-medium">Tempo de Empresa</h2>
            <i data-lucide="bar-chart-3" class="text-primary"></i>
        </div>
        
        <div class="h-60 bg-gray-50 flex items-center justify-center rounded-lg border border-gray-100 mb-4">
            <p class="text-gray-500">Gráfico de tempo de empresa</p>
        </div>
        
        <div class="space-y-2">
            <?php foreach ($tenure as $item): ?>
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <div class="w-3 h-3 rounded-full bg-primary mr-2"></div>
                    <span class="text-sm text-gray-600"><?php echo $item['range']; ?></span>
                </div>
                <span class="text-sm font-medium"><?php echo $item['count']; ?> (<?php echo $item['percentage']; ?>%)</span>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<div class="card mb-6">
    <h2 class="text-lg font-medium mb-4">Resumo por Departamento</h2>
    
    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th>Departamento</th>
                    <th>Total de Colaboradores</th>
                    <th>Ativos</th>
                    <th>Inativos</th>
                    <th>Idade Média</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($departmentSummary as $dept): ?>
                <tr>
                    <td class="font-medium"><?php echo $dept['department']; ?></td>
                    <td><?php echo $dept['total']; ?></td>
                    <td><?php echo $dept['active']; ?></td>
                    <td><?php echo $dept['inactive']; ?></td>
                    <td><?php echo $dept['avgAge']; ?> anos</td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
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
<?php
$dateStart = date('Y-m-d', strtotime('-30 days'));
$dateEnd = date('Y-m-d');

$stats = [
    'total' => 17150.00,
    'received' => 14850.00,
    'pending' => 800.00,
    'growth' => 18
];

$clients = [
    ['name' => 'Empresa ABC', 'paid' => 2500.00, 'count' => 1, 'percentage' => 15],
    ['name' => 'Cliente Particular', 'paid' => 12000.00, 'count' => 1, 'percentage' => 70],
    ['name' => 'Cliente GHI', 'paid' => 350.00, 'count' => 1, 'percentage' => 2],
    ['name' => 'Loja XYZ', 'paid' => 0.00, 'count' => 1, 'percentage' => 0]
];

$status = [
    ['label' => 'Pagos', 'count' => 3, 'percentage' => 60],
    ['label' => 'Pendentes', 'count' => 1, 'percentage' => 20],
    ['label' => 'Cancelados', 'count' => 1, 'percentage' => 20]
];

function formatCurrency($value) {
    return 'R$ ' . number_format($value, 2, ',', '.');
}
?>

<div class="page-header">
    <div class="flex justify-between items-start">
        <div>
            <h1 class="page-title">Relatório de Pagamentos</h1>
            <p class="page-subtitle">Visualize e exporte dados sobre os pagamentos do sistema</p>
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
                <option value="paid">Pagos</option>
                <option value="pending">Pendentes</option>
                <option value="canceled">Cancelados</option>
            </select>
        </div>
        
        <div class="form-group">
            <label class="form-label" for="client">Cliente</label>
            <select id="client" class="form-control">
                <option value="">Todos</option>
                <option value="company-a">Empresa ABC</option>
                <option value="company-b">Loja XYZ</option>
                <option value="company-c">Cliente Particular</option>
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
        <p class="text-sm font-medium text-gray-500">Total de Pagamentos</p>
        <h2 class="text-3xl font-bold mt-2"><?php echo formatCurrency($stats['total']); ?></h2>
        <div class="flex items-center text-success text-sm mt-2">
            <span>+<?php echo $stats['growth']; ?>% desde o último mês</span>
        </div>
    </div>
    
    <div class="card">
        <p class="text-sm font-medium text-gray-500">Pagamentos Recebidos</p>
        <h2 class="text-3xl font-bold mt-2"><?php echo formatCurrency($stats['received']); ?></h2>
        <div class="flex items-center text-success text-sm mt-2">
            <span><?php echo round(($stats['received'] / $stats['total']) * 100); ?>% do total</span>
        </div>
    </div>
    
    <div class="card">
        <p class="text-sm font-medium text-gray-500">Pagamentos Pendentes</p>
        <h2 class="text-3xl font-bold mt-2"><?php echo formatCurrency($stats['pending']); ?></h2>
        <div class="flex items-center text-warning text-sm mt-2">
            <span><?php echo round(($stats['pending'] / $stats['total']) * 100); ?>% do total</span>
        </div>
    </div>
</div>

<div class="card mb-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-lg font-medium flex items-center gap-2">
            <i data-lucide="line-chart"></i>
            <span>Pagamentos por Mês</span>
        </h2>
        <select class="form-control text-sm w-auto">
            <option value="12months">Últimos 12 meses</option>
            <option value="6months">Últimos 6 meses</option>
            <option value="3months">Últimos 3 meses</option>
        </select>
    </div>
    
    <div class="h-80 bg-gray-50 flex items-center justify-center rounded-lg border border-gray-100">
        <p class="text-gray-500">Gráfico de pagamentos mensais</p>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
    <div class="card">
        <h2 class="text-lg font-medium mb-4 flex items-center gap-2">
            <i data-lucide="dollar-sign"></i>
            <span>Distribuição por Cliente</span>
        </h2>
        
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>Total Pago</th>
                        <th>Quantidade</th>
                        <th>% do Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($clients as $client): ?>
                    <tr>
                        <td class="font-medium"><?php echo $client['name']; ?></td>
                        <td><?php echo formatCurrency($client['paid']); ?></td>
                        <td><?php echo $client['count']; ?><?php echo $client['paid'] === 0 ? ' (Pendente)' : ''; ?></td>
                        <td><?php echo $client['percentage']; ?>%</td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <div class="card">
        <h2 class="text-lg font-medium mb-4">Status dos Pagamentos</h2>
        
        <div class="h-60 bg-gray-50 flex items-center justify-center rounded-lg border border-gray-100 mb-4">
            <p class="text-gray-500">Gráfico de status dos pagamentos</p>
        </div>
        
        <div class="space-y-2">
            <?php foreach ($status as $item): ?>
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <div class="w-3 h-3 rounded-full <?php 
                        echo $item['label'] === 'Pagos' ? 'bg-success' : 
                            ($item['label'] === 'Pendentes' ? 'bg-warning' : 'bg-danger'); 
                    ?> mr-2"></div>
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
<?php
$stats = [
    'usuarios' => [
        'total' => 184,
        'change' => 12,
        'positive' => true
    ],
    'colaboradores' => [
        'total' => 32,
        'change' => 5,
        'positive' => true
    ],
    'pagamentos' => [
        'total' => 24980,
        'change' => 18,
        'positive' => true
    ],
    'registros' => [
        'total' => 28,
        'change' => 3,
        'positive' => false
    ]
];

$activities = [
    ['type' => 'novo_colaborador', 'time' => '1 hora atrás'],
    ['type' => 'novo_colaborador', 'time' => '2 horas atrás'],
    ['type' => 'novo_colaborador', 'time' => '3 horas atrás'],
    ['type' => 'novo_colaborador', 'time' => '4 horas atrás'],
    ['type' => 'novo_colaborador', 'time' => '5 horas atrás']
];
?>

<div class="page-header">
    <h1 class="page-title">Dashboard</h1>
    <p class="page-subtitle">Bem-vindo ao SISCONF. Aqui está um resumo do sistema.</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="card">
        <div class="flex justify-between items-start">
            <div>
                <h3 class="text-gray-500 text-sm font-medium">Usuários Ativos</h3>
                <p class="text-2xl font-bold mt-1"><?php echo $stats['usuarios']['total']; ?></p>
                <div class="flex items-center mt-2 text-sm <?php echo $stats['usuarios']['positive'] ? 'text-success' : 'text-danger'; ?>">
                    <span><?php echo ($stats['usuarios']['positive'] ? '+' : '') . $stats['usuarios']['change']; ?>% desde o último mês</span>
                </div>
            </div>
            <div class="p-3 rounded-full bg-primary-50 text-primary">
                <i data-lucide="users"></i>
            </div>
        </div>
    </div>
    
    <!-- Similar cards for other stats -->
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2">
        <div class="card">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold">Atividade Recente</h2>
                <button class="text-primary font-medium flex items-center">
                    Ver todos
                    <i data-lucide="arrow-up-right" class="ml-1"></i>
                </button>
            </div>
            
            <div class="space-y-4">
                <?php foreach ($activities as $activity): ?>
                <div class="flex items-center p-3 hover:bg-gray-50 rounded-md">
                    <div class="w-10 h-10 rounded-full bg-primary-50 flex items-center justify-center text-primary mr-4">
                        <i data-lucide="user-cog"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium">Novo colaborador registrado</p>
                        <p class="text-xs text-gray-500"><?php echo $activity['time']; ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    
    <div class="card">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-semibold">Relatório Rápido</h2>
            <i data-lucide="bar-chart-3" class="text-primary"></i>
        </div>
        
        <div class="space-y-6">
            <!-- Progress bars for various metrics -->
            <div>
                <div class="flex justify-between items-center mb-2">
                    <p class="text-sm font-medium text-gray-600">Usuários</p>
                    <p class="text-sm font-bold">184/200</p>
                </div>
                <div class="w-full h-2 bg-gray-100 rounded-full">
                    <div class="h-full bg-primary rounded-full" style="width: 92%"></div>
                </div>
            </div>
            
            <!-- Similar sections for other metrics -->
        </div>
    </div>
</div>
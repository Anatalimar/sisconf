<?php
$payments = [
    ['id' => 1, 'description' => 'Pagamento serviço de TI', 'client' => 'Empresa ABC', 'value' => 2500.00, 'date' => '2025-04-10', 'status' => 'Pago'],
    ['id' => 2, 'description' => 'Manutenção site', 'client' => 'Loja XYZ', 'value' => 800.00, 'date' => '2025-04-08', 'status' => 'Pendente'],
    ['id' => 3, 'description' => 'Desenvolvimento de aplicativo', 'client' => 'Cliente Particular', 'value' => 12000.00, 'date' => '2025-04-05', 'status' => 'Pago'],
    ['id' => 4, 'description' => 'Consultoria', 'client' => 'Empresa DEF', 'value' => 1500.00, 'date' => '2025-04-03', 'status' => 'Cancelado'],
    ['id' => 5, 'description' => 'Renovação de licença', 'client' => 'Cliente GHI', 'value' => 350.00, 'date' => '2025-04-01', 'status' => 'Pago']
];

function formatCurrency($value) {
    return 'R$ ' . number_format($value, 2, ',', '.');
}

function formatDate($date) {
    return date('d/m/Y', strtotime($date));
}

$totalPaid = array_reduce($payments, function($carry, $item) {
    return $carry + ($item['status'] === 'Pago' ? $item['value'] : 0);
}, 0);

$totalPending = array_reduce($payments, function($carry, $item) {
    return $carry + ($item['status'] === 'Pendente' ? $item['value'] : 0);
}, 0);
?>

<div class="page-header">
    <div class="flex justify-between items-start">
        <div>
            <h1 class="page-title">Pagamentos</h1>
            <p class="page-subtitle">Controle todos os pagamentos do sistema</p>
        </div>
        <button class="btn btn-primary" onclick="document.getElementById('newPaymentModal').style.display='block'">
            <i data-lucide="plus"></i>
            <span>Novo Pagamento</span>
        </button>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
    <div class="card">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm font-medium text-gray-500">Total Recebido</p>
                <h3 class="text-2xl font-bold mt-1"><?php echo formatCurrency($totalPaid); ?></h3>
            </div>
            <div class="p-3 bg-success-100 text-success rounded-full">
                <i data-lucide="credit-card"></i>
            </div>
        </div>
    </div>
    
    <div class="card">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm font-medium text-gray-500">Pendente</p>
                <h3 class="text-2xl font-bold mt-1"><?php echo formatCurrency($totalPending); ?></h3>
            </div>
            <div class="p-3 bg-warning-100 text-warning rounded-full">
                <i data-lucide="credit-card"></i>
            </div>
        </div>
    </div>
    
    <div class="card">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm font-medium text-gray-500">Total de Pagamentos</p>
                <h3 class="text-2xl font-bold mt-1"><?php echo count($payments); ?></h3>
            </div>
            <div class="p-3 bg-primary-50 text-primary rounded-full">
                <i data-lucide="credit-card"></i>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="mb-6 flex flex-col md:flex-row gap-4">
        <div class="relative flex-1">
            <input type="text" class="form-control pl-10 table-search" placeholder="Buscar pagamentos...">
            <i data-lucide="search" class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
        </div>
        
        <div class="flex gap-2">
            <select class="form-control">
                <option value="">Todos os status</option>
                <option value="paid">Pago</option>
                <option value="pending">Pendente</option>
                <option value="canceled">Cancelado</option>
            </select>
            
            <button class="btn btn-secondary">
                <i data-lucide="download"></i>
                <span>Exportar</span>
            </button>
        </div>
    </div>
    
    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th>Descrição</th>
                    <th>Cliente</th>
                    <th>Valor</th>
                    <th>Data</th>
                    <th>Status</th>
                    <th class="text-right">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($payments as $payment): ?>
                <tr>
                    <td class="font-medium"><?php echo $payment['description']; ?></td>
                    <td><?php echo $payment['client']; ?></td>
                    <td><?php echo formatCurrency($payment['value']); ?></td>
                    <td><?php echo formatDate($payment['date']); ?></td>
                    <td>
                        <span class="badge <?php 
                            echo $payment['status'] === 'Pago' ? 'badge-success' : 
                                ($payment['status'] === 'Pendente' ? 'badge-warning' : 'badge-danger'); 
                        ?>">
                            <?php echo $payment['status']; ?>
                        </span>
                    </td>
                    <td class="text-right">
                        <div class="relative inline-block">
                            <button class="text-gray-500 hover:text-gray-700" onclick="toggleDropdown(<?php echo $payment['id']; ?>)">
                                <i data-lucide="more-horizontal"></i>
                            </button>
                            <div id="dropdown-<?php echo $payment['id']; ?>" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-10">
                                <a href="#" class="dropdown-item">
                                    <i data-lucide="eye"></i>
                                    <span>Visualizar</span>
                                </a>
                                <a href="#" class="dropdown-item">
                                    <i data-lucide="pencil"></i>
                                    <span>Editar</span>
                                </a>
                                <a href="#" class="dropdown-item text-danger">
                                    <i data-lucide="trash-2"></i>
                                    <span>Excluir</span>
                                </a>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    
    <div class="flex items-center justify-between mt-4">
        <p class="text-sm text-gray-500">
            Mostrando <span class="font-medium">5</span> de <span class="font-medium">5</span> pagamentos
        </p>
        <div class="flex gap-2">
            <button class="btn" disabled>Anterior</button>
            <button class="btn" disabled>Próximo</button>
        </div>
    </div>
</div>

<!-- Modal Novo Pagamento -->
<div id="newPaymentModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4">
        <div class="p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-medium">Novo Pagamento</h3>
                <button onclick="document.getElementById('newPaymentModal').style.display='none'" class="text-gray-400 hover:text-gray-500">
                    <i data-lucide="x"></i>
                </button>
            </div>
            
            <form>
                <div class="form-group">
                    <label class="form-label" for="description">Descrição</label>
                    <input type="text" id="description" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="client">Cliente</label>
                    <input type="text" id="client" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="value">Valor</label>
                    <input type="number" id="value" class="form-control" step="0.01" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="date">Data</label>
                    <input type="date" id="date" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="status">Status</label>
                    <select id="status" class="form-control" required>
                        <option value="">Selecione um status</option>
                        <option value="paid">Pago</option>
                        <option value="pending">Pendente</option>
                        <option value="canceled">Cancelado</option>
                    </select>
                </div>
                
                <div class="flex justify-end gap-2 mt-6">
                    <button type="button" class="btn" onclick="document.getElementById('newPaymentModal').style.display='none'">
                        Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Salvar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
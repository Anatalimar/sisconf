<div class="page-header">
    <h1>Gerenciar Pagamentos</h1>
    <p>Registro e controle de pagamentos</p>
</div>

<div class="page-actions">
    <button class="btn btn-primary" id="novo-pagamento">
        <i class="fas fa-plus"></i> Novo Pagamento
    </button>
</div>

<div class="filters">
    <div class="filter-group">
        <label for="mes">Mês:</label>
        <select id="mes" class="form-control">
            <option value="">Todos</option>
            <option value="1">Janeiro</option>
            <option value="2">Fevereiro</option>
            <!-- outros meses -->
        </select>
    </div>
    <div class="filter-group">
        <label for="ano">Ano:</label>
        <select id="ano" class="form-control">
            <option value="">Todos</option>
            <option value="2023">2023</option>
            <option value="2024">2024</option>
        </select>
    </div>
    <button class="btn btn-secondary">Filtrar</button>
</div>

<div class="table-responsive">
    <table class="data-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Colaborador</th>
                <th>Valor</th>
                <th>Data</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>João Silva</td>
                <td>R$ 5.000,00</td>
                <td>05/01/2024</td>
                <td><span class="status-badge paid">Pago</span></td>
                <td>
                    <button class="btn-action btn-view"><i class="fas fa-eye"></i></button>
                    <button class="btn-action btn-edit"><i class="fas fa-edit"></i></button>
                </td>
            </tr>
            <tr>
                <td>2</td>
                <td>Maria Souza</td>
                <td>R$ 3.200,00</td>
                <td>05/01/2024</td>
                <td><span class="status-badge pending">Pendente</span></td>
                <td>
                    <button class="btn-action btn-view"><i class="fas fa-eye"></i></button>
                    <button class="btn-action btn-edit"><i class="fas fa-edit"></i></button>
                </td>
            </tr>
        </tbody>
    </table>
</div>
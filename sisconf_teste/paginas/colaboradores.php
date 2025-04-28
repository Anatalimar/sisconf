<div class="page-header">
    <h1>Gerenciar Colaboradores</h1>
    <p>Cadastro e edição de colaboradores</p>
</div>

<div class="page-actions">
    <button class="btn btn-primary" id="novo-colaborador">
        <i class="fas fa-plus"></i> Novo Colaborador
    </button>
</div>

<div class="table-responsive">
    <table class="data-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>CPF</th>
                <th>Cargo</th>
                <th>Salário</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>João Silva</td>
                <td>123.456.789-00</td>
                <td>Gerente</td>
                <td>R$ 5.000,00</td>
                <td><span class="status-badge active">Ativo</span></td>
                <td>
                    <button class="btn-action btn-edit"><i class="fas fa-edit"></i></button>
                    <button class="btn-action btn-delete"><i class="fas fa-trash"></i></button>
                </td>
            </tr>
            <tr>
                <td>2</td>
                <td>Maria Souza</td>
                <td>987.654.321-00</td>
                <td>Analista</td>
                <td>R$ 3.200,00</td>
                <td><span class="status-badge active">Ativo</span></td>
                <td>
                    <button class="btn-action btn-edit"><i class="fas fa-edit"></i></button>
                    <button class="btn-action btn-delete"><i class="fas fa-trash"></i></button>
                </td>
            </tr>
        </tbody>
    </table>
</div>
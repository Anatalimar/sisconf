<div class="page-header">
    <h1>Gerenciar Usuários</h1>
    <p>Cadastro e edição de usuários do sistema</p>
</div>

<div class="page-actions">
    <button class="btn btn-primary" id="novo-usuario">
        <i class="fas fa-plus"></i> Novo Usuário
    </button>
</div>

<div class="table-responsive">
    <table class="data-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Perfil</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Administrador</td>
                <td>admin@sisconf.com</td>
                <td>Administrador</td>
                <td><span class="status-badge active">Ativo</span></td>
                <td>
                    <button class="btn-action btn-edit"><i class="fas fa-edit"></i></button>
                    <button class="btn-action btn-delete"><i class="fas fa-trash"></i></button>
                </td>
            </tr>
            <tr>
                <td>2</td>
                <td>Usuário Teste</td>
                <td>teste@sisconf.com</td>
                <td>Operador</td>
                <td><span class="status-badge inactive">Inativo</span></td>
                <td>
                    <button class="btn-action btn-edit"><i class="fas fa-edit"></i></button>
                    <button class="btn-action btn-delete"><i class="fas fa-trash"></i></button>
                </td>
            </tr>
        </tbody>
    </table>
</div>
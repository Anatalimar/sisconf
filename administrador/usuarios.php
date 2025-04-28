<div class="card">
    <div class="card-header">
        <h2 class="card-title">Gerenciamento de Usuários</h2>
        <button class="btn btn-primary" onclick="abrirModalUsuario()">
            <i class="fas fa-plus"></i> Novo Usuário
        </button>
    </div>
    <div class="card-body">
        <table class="table">
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
                    <td>Admin Master</td>
                    <td>admin@sisconf.com</td>
                    <td>Administrador</td>
                    <td><span class="badge bg-success">Ativo</span></td>
                    <td>
                        <button class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></button>
                        <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>João Silva</td>
                    <td>joao@empresa.com</td>
                    <td>Usuário</td>
                    <td><span class="badge bg-success">Ativo</span></td>
                    <td>
                        <button class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></button>
                        <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Maria Souza</td>
                    <td>maria@empresa.com</td>
                    <td>Gerente</td>
                    <td><span class="badge bg-warning">Inativo</span></td>
                    <td>
                        <button class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></button>
                        <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal para adicionar/editar usuário -->
<div id="modalUsuario" class="modal">
    <div class="modal-content">
        <span class="close" onclick="fecharModalUsuario()">&times;</span>
        <h2>Adicionar Novo Usuário</h2>
        <form>
            <div class="form-group">
                <label for="nome">Nome Completo</label>
                <input type="text" id="nome" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="perfil">Perfil</label>
                <select id="perfil" class="form-control" required>
                    <option value="">Selecione...</option>
                    <option value="admin">Administrador</option>
                    <option value="gerente">Gerente</option>
                    <option value="usuario">Usuário</option>
                </select>
            </div>
            <div class="form-group">
                <label for="senha">Senha</label>
                <input type="password" id="senha" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="confirmarSenha">Confirmar Senha</label>
                <input type="password" id="confirmarSenha" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
    </div>
</div>

<script>
function abrirModalUsuario() {
    document.getElementById('modalUsuario').style.display = 'block';
}

function fecharModalUsuario() {
    document.getElementById('modalUsuario').style.display = 'none';
}
</script>
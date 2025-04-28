<?php
$users = [
    ['id' => 1, 'name' => 'Ana Silva', 'email' => 'ana.silva@example.com', 'role' => 'Administrador', 'status' => 'Ativo'],
    ['id' => 2, 'name' => 'Carlos Oliveira', 'email' => 'carlos.oliveira@example.com', 'role' => 'Gerente', 'status' => 'Ativo'],
    ['id' => 3, 'name' => 'Mariana Santos', 'email' => 'mariana.santos@example.com', 'role' => 'Usuário', 'status' => 'Inativo'],
    ['id' => 4, 'name' => 'Ricardo Ferreira', 'email' => 'ricardo.ferreira@example.com', 'role' => 'Usuário', 'status' => 'Ativo'],
    ['id' => 5, 'name' => 'Juliana Costa', 'email' => 'juliana.costa@example.com', 'role' => 'Gerente', 'status' => 'Ativo']
];
?>

<div class="page-header">
    <div class="flex justify-between items-start">
        <div>
            <h1 class="page-title">Usuários</h1>
            <p class="page-subtitle">Gerencie os usuários do sistema</p>
        </div>
        <button class="btn btn-primary" onclick="document.getElementById('newUserModal').style.display='block'">
            <i data-lucide="plus"></i>
            <span>Novo Usuário</span>
        </button>
    </div>
</div>

<div class="card">
    <div class="mb-6 flex flex-col md:flex-row gap-4">
        <div class="relative flex-1">
            <input type="text" class="form-control pl-10 table-search" placeholder="Buscar usuários...">
            <i data-lucide="search" class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
        </div>
        
        <div class="flex gap-2">
            <select class="form-control">
                <option value="">Todos os perfis</option>
                <option value="admin">Administrador</option>
                <option value="manager">Gerente</option>
                <option value="user">Usuário</option>
            </select>
            
            <select class="form-control">
                <option value="">Todos os status</option>
                <option value="active">Ativo</option>
                <option value="inactive">Inativo</option>
            </select>
        </div>
    </div>
    
    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Perfil</th>
                    <th>Status</th>
                    <th class="text-right">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                <tr>
                    <td>
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-primary-50 rounded-full flex items-center justify-center text-primary mr-3">
                                <i data-lucide="user"></i>
                            </div>
                            <span class="font-medium"><?php echo $user['name']; ?></span>
                        </div>
                    </td>
                    <td><?php echo $user['email']; ?></td>
                    <td><?php echo $user['role']; ?></td>
                    <td>
                        <span class="badge <?php echo $user['status'] === 'Ativo' ? 'badge-success' : 'badge-danger'; ?>">
                            <?php echo $user['status']; ?>
                        </span>
                    </td>
                    <td class="text-right">
                        <div class="relative inline-block">
                            <button class="text-gray-500 hover:text-gray-700" onclick="toggleDropdown(<?php echo $user['id']; ?>)">
                                <i data-lucide="more-horizontal"></i>
                            </button>
                            <div id="dropdown-<?php echo $user['id']; ?>" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-10">
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
            Mostrando <span class="font-medium">5</span> de <span class="font-medium">5</span> usuários
        </p>
        <div class="flex gap-2">
            <button class="btn" disabled>Anterior</button>
            <button class="btn" disabled>Próximo</button>
        </div>
    </div>
</div>

<!-- Modal Novo Usuário -->
<div id="newUserModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4">
        <div class="p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-medium">Novo Usuário</h3>
                <button onclick="document.getElementById('newUserModal').style.display='none'" class="text-gray-400 hover:text-gray-500">
                    <i data-lucide="x"></i>
                </button>
            </div>
            
            <form>
                <div class="form-group">
                    <label class="form-label" for="name">Nome</label>
                    <input type="text" id="name" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="email">Email</label>
                    <input type="email" id="email" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="role">Perfil</label>
                    <select id="role" class="form-control" required>
                        <option value="">Selecione um perfil</option>
                        <option value="admin">Administrador</option>
                        <option value="manager">Gerente</option>
                        <option value="user">Usuário</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="password">Senha</label>
                    <input type="password" id="password" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="confirmPassword">Confirmar Senha</label>
                    <input type="password" id="confirmPassword" class="form-control" required>
                </div>
                
                <div class="flex justify-end gap-2 mt-6">
                    <button type="button" class="btn" onclick="document.getElementById('newUserModal').style.display='none'">
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
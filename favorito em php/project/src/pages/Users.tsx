import { useState } from 'react';
import { Plus, Search, MoreHorizontal, Pencil, Trash2, User } from 'lucide-react';
import PageHeader from '../components/common/PageHeader';

// Mock data for users
const mockUsers = [
  { id: 1, name: 'Ana Silva', email: 'ana.silva@example.com', role: 'Administrador', status: 'Ativo' },
  { id: 2, name: 'Carlos Oliveira', email: 'carlos.oliveira@example.com', role: 'Gerente', status: 'Ativo' },
  { id: 3, name: 'Mariana Santos', email: 'mariana.santos@example.com', role: 'Usuário', status: 'Inativo' },
  { id: 4, name: 'Ricardo Ferreira', email: 'ricardo.ferreira@example.com', role: 'Usuário', status: 'Ativo' },
  { id: 5, name: 'Juliana Costa', email: 'juliana.costa@example.com', role: 'Gerente', status: 'Ativo' },
  { id: 6, name: 'Paulo Mendes', email: 'paulo.mendes@example.com', role: 'Usuário', status: 'Ativo' },
  { id: 7, name: 'Fernanda Lima', email: 'fernanda.lima@example.com', role: 'Usuário', status: 'Inativo' },
];

const Users = () => {
  const [searchTerm, setSearchTerm] = useState('');
  const [actionMenuVisible, setActionMenuVisible] = useState<number | null>(null);
  const [showModal, setShowModal] = useState(false);
  
  const filteredUsers = mockUsers.filter(user => 
    user.name.toLowerCase().includes(searchTerm.toLowerCase()) || 
    user.email.toLowerCase().includes(searchTerm.toLowerCase())
  );
  
  const toggleActionMenu = (userId: number) => {
    setActionMenuVisible(actionMenuVisible === userId ? null : userId);
  };
  
  return (
    <div>
      <PageHeader 
        title="Usuários" 
        subtitle="Gerencie os usuários do sistema" 
        action={
          <button 
            className="btn btn-primary flex items-center gap-2"
            onClick={() => setShowModal(true)}
          >
            <Plus size={16} />
            <span>Novo Usuário</span>
          </button>
        }
      />
      
      {/* Search and Filter */}
      <div className="mb-6 flex flex-col md:flex-row gap-4">
        <div className="relative flex-1">
          <input
            type="text"
            placeholder="Buscar usuários..."
            className="form-input pl-10"
            value={searchTerm}
            onChange={(e) => setSearchTerm(e.target.value)}
          />
          <div className="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
            <Search size={18} className="text-gray-400" />
          </div>
        </div>
        
        <div className="flex gap-2">
          <select className="form-input">
            <option value="">Todos os perfis</option>
            <option value="admin">Administrador</option>
            <option value="manager">Gerente</option>
            <option value="user">Usuário</option>
          </select>
          
          <select className="form-input">
            <option value="">Todos os status</option>
            <option value="active">Ativo</option>
            <option value="inactive">Inativo</option>
          </select>
        </div>
      </div>
      
      {/* User Table */}
      <div className="bg-white shadow-sm rounded-lg overflow-hidden">
        <div className="overflow-x-auto">
          <table className="min-w-full divide-y divide-gray-200">
            <thead className="bg-gray-50">
              <tr>
                <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Nome
                </th>
                <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Email
                </th>
                <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Perfil
                </th>
                <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Status
                </th>
                <th className="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Ações
                </th>
              </tr>
            </thead>
            <tbody className="bg-white divide-y divide-gray-200">
              {filteredUsers.map((user) => (
                <tr key={user.id} className="hover:bg-gray-50 transition-colors">
                  <td className="px-6 py-4 whitespace-nowrap">
                    <div className="flex items-center">
                      <div className="flex-shrink-0 h-10 w-10 bg-primary-50 rounded-full flex items-center justify-center">
                        <User className="h-5 w-5 text-primary" />
                      </div>
                      <div className="ml-4">
                        <div className="text-sm font-medium text-gray-900">{user.name}</div>
                      </div>
                    </div>
                  </td>
                  <td className="px-6 py-4 whitespace-nowrap">
                    <div className="text-sm text-gray-500">{user.email}</div>
                  </td>
                  <td className="px-6 py-4 whitespace-nowrap">
                    <div className="text-sm text-gray-900">{user.role}</div>
                  </td>
                  <td className="px-6 py-4 whitespace-nowrap">
                    <span className={`px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${
                      user.status === 'Ativo' 
                        ? 'bg-success-100 text-success' 
                        : 'bg-gray-100 text-gray-500'
                    }`}>
                      {user.status}
                    </span>
                  </td>
                  <td className="px-6 py-4 whitespace-nowrap text-right text-sm font-medium relative">
                    <button 
                      onClick={() => toggleActionMenu(user.id)}
                      className="text-gray-500 hover:text-gray-700"
                    >
                      <MoreHorizontal size={18} />
                    </button>
                    
                    {actionMenuVisible === user.id && (
                      <div className="absolute right-6 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-10 border border-gray-200">
                        <a href="#" className="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                          <Pencil className="h-4 w-4" />
                          <span>Editar</span>
                        </a>
                        <a href="#" className="flex items-center gap-2 px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                          <Trash2 className="h-4 w-4" />
                          <span>Excluir</span>
                        </a>
                      </div>
                    )}
                  </td>
                </tr>
              ))}
            </tbody>
          </table>
        </div>
        
        <div className="px-6 py-4 border-t border-gray-200 flex items-center justify-between">
          <div className="text-sm text-gray-500">
            Mostrando <span className="font-medium">{filteredUsers.length}</span> de <span className="font-medium">{mockUsers.length}</span> usuários
          </div>
          
          <div className="flex gap-2">
            <button className="px-3 py-1 border border-gray-300 rounded-md text-sm text-gray-700 hover:bg-gray-50">
              Anterior
            </button>
            <button className="px-3 py-1 border border-gray-300 rounded-md text-sm text-gray-700 hover:bg-gray-50">
              Próximo
            </button>
          </div>
        </div>
      </div>
      
      {/* Modal for adding new user (hidden by default) */}
      {showModal && (
        <div className="fixed inset-0 z-50 overflow-y-auto">
          <div className="flex items-center justify-center min-h-screen px-4">
            <div className="fixed inset-0 bg-black bg-opacity-50 transition-opacity" onClick={() => setShowModal(false)}></div>
            
            <div className="bg-white rounded-lg shadow-xl max-w-md w-full z-10 p-6">
              <div className="flex justify-between items-center mb-4">
                <h3 className="text-lg font-medium text-gray-900">Adicionar Novo Usuário</h3>
                <button 
                  onClick={() => setShowModal(false)}
                  className="text-gray-400 hover:text-gray-500"
                >
                  &times;
                </button>
              </div>
              
              <form>
                <div className="mb-4">
                  <label className="form-label" htmlFor="name">Nome</label>
                  <input type="text" id="name" className="form-input" />
                </div>
                
                <div className="mb-4">
                  <label className="form-label" htmlFor="email">Email</label>
                  <input type="email" id="email" className="form-input" />
                </div>
                
                <div className="mb-4">
                  <label className="form-label" htmlFor="role">Perfil</label>
                  <select id="role" className="form-input">
                    <option value="">Selecione um perfil</option>
                    <option value="admin">Administrador</option>
                    <option value="manager">Gerente</option>
                    <option value="user">Usuário</option>
                  </select>
                </div>
                
                <div className="mb-4">
                  <label className="form-label" htmlFor="password">Senha</label>
                  <input type="password" id="password" className="form-input" />
                </div>
                
                <div className="mb-4">
                  <label className="form-label" htmlFor="confirmPassword">Confirmar Senha</label>
                  <input type="password" id="confirmPassword" className="form-input" />
                </div>
                
                <div className="flex justify-end gap-2 mt-6">
                  <button 
                    type="button" 
                    className="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50"
                    onClick={() => setShowModal(false)}
                  >
                    Cancelar
                  </button>
                  <button 
                    type="submit" 
                    className="btn btn-primary"
                  >
                    Salvar
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      )}
    </div>
  );
};

export default Users;
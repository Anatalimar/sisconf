import { useState } from 'react';
import { Plus, Search, MoreHorizontal, Pencil, Trash2, UserCog } from 'lucide-react';
import PageHeader from '../components/common/PageHeader';

// Mock data for collaborators
const mockCollaborators = [
  { id: 1, name: 'Miguel Almeida', email: 'miguel.almeida@example.com', department: 'TI', position: 'Desenvolvedor', status: 'Ativo' },
  { id: 2, name: 'Beatriz Nunes', email: 'beatriz.nunes@example.com', department: 'RH', position: 'Recrutadora', status: 'Ativo' },
  { id: 3, name: 'João Pereira', email: 'joao.pereira@example.com', department: 'Marketing', position: 'Designer', status: 'Inativo' },
  { id: 4, name: 'Sofia Gomes', email: 'sofia.gomes@example.com', department: 'Comercial', position: 'Vendedora', status: 'Ativo' },
  { id: 5, name: 'Lucas Martins', email: 'lucas.martins@example.com', department: 'Financeiro', position: 'Contador', status: 'Ativo' },
];

const Collaborators = () => {
  const [searchTerm, setSearchTerm] = useState('');
  const [actionMenuVisible, setActionMenuVisible] = useState<number | null>(null);
  
  const filteredCollaborators = mockCollaborators.filter(collaborator => 
    collaborator.name.toLowerCase().includes(searchTerm.toLowerCase()) || 
    collaborator.email.toLowerCase().includes(searchTerm.toLowerCase()) ||
    collaborator.department.toLowerCase().includes(searchTerm.toLowerCase())
  );
  
  const toggleActionMenu = (id: number) => {
    setActionMenuVisible(actionMenuVisible === id ? null : id);
  };
  
  return (
    <div>
      <PageHeader 
        title="Colaboradores" 
        subtitle="Gerencie os colaboradores da empresa" 
        action={
          <button className="btn btn-primary flex items-center gap-2">
            <Plus size={16} />
            <span>Novo Colaborador</span>
          </button>
        }
      />
      
      {/* Search and Filter */}
      <div className="mb-6 flex flex-col md:flex-row gap-4">
        <div className="relative flex-1">
          <input
            type="text"
            placeholder="Buscar colaboradores..."
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
            <option value="">Todos os departamentos</option>
            <option value="TI">TI</option>
            <option value="RH">RH</option>
            <option value="Marketing">Marketing</option>
            <option value="Comercial">Comercial</option>
            <option value="Financeiro">Financeiro</option>
          </select>
          
          <select className="form-input">
            <option value="">Todos os status</option>
            <option value="active">Ativo</option>
            <option value="inactive">Inativo</option>
          </select>
        </div>
      </div>
      
      {/* Collaborator Table */}
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
                  Departamento
                </th>
                <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Cargo
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
              {filteredCollaborators.map((collaborator) => (
                <tr key={collaborator.id} className="hover:bg-gray-50 transition-colors">
                  <td className="px-6 py-4 whitespace-nowrap">
                    <div className="flex items-center">
                      <div className="flex-shrink-0 h-10 w-10 bg-primary-50 rounded-full flex items-center justify-center">
                        <UserCog className="h-5 w-5 text-primary" />
                      </div>
                      <div className="ml-4">
                        <div className="text-sm font-medium text-gray-900">{collaborator.name}</div>
                      </div>
                    </div>
                  </td>
                  <td className="px-6 py-4 whitespace-nowrap">
                    <div className="text-sm text-gray-500">{collaborator.email}</div>
                  </td>
                  <td className="px-6 py-4 whitespace-nowrap">
                    <div className="text-sm text-gray-900">{collaborator.department}</div>
                  </td>
                  <td className="px-6 py-4 whitespace-nowrap">
                    <div className="text-sm text-gray-900">{collaborator.position}</div>
                  </td>
                  <td className="px-6 py-4 whitespace-nowrap">
                    <span className={`px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${
                      collaborator.status === 'Ativo' 
                        ? 'bg-success-100 text-success' 
                        : 'bg-gray-100 text-gray-500'
                    }`}>
                      {collaborator.status}
                    </span>
                  </td>
                  <td className="px-6 py-4 whitespace-nowrap text-right text-sm font-medium relative">
                    <button 
                      onClick={() => toggleActionMenu(collaborator.id)}
                      className="text-gray-500 hover:text-gray-700"
                    >
                      <MoreHorizontal size={18} />
                    </button>
                    
                    {actionMenuVisible === collaborator.id && (
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
            Mostrando <span className="font-medium">{filteredCollaborators.length}</span> de <span className="font-medium">{mockCollaborators.length}</span> colaboradores
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
    </div>
  );
};

export default Collaborators;
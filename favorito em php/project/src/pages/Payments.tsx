import { useState } from 'react';
import { Plus, Search, MoreHorizontal, Eye, Pencil, Trash2, CreditCard, Download } from 'lucide-react';
import PageHeader from '../components/common/PageHeader';

// Mock data for payments
const mockPayments = [
  { id: 1, description: 'Pagamento serviço de TI', client: 'Empresa ABC', value: 2500.00, date: '2025-04-10', status: 'Pago' },
  { id: 2, description: 'Manutenção site', client: 'Loja XYZ', value: 800.00, date: '2025-04-08', status: 'Pendente' },
  { id: 3, description: 'Desenvolvimento de aplicativo', client: 'Cliente Particular', value: 12000.00, date: '2025-04-05', status: 'Pago' },
  { id: 4, description: 'Consultoria', client: 'Empresa DEF', value: 1500.00, date: '2025-04-03', status: 'Cancelado' },
  { id: 5, description: 'Renovação de licença', client: 'Cliente GHI', value: 350.00, date: '2025-04-01', status: 'Pago' },
];

const Payments = () => {
  const [searchTerm, setSearchTerm] = useState('');
  const [actionMenuVisible, setActionMenuVisible] = useState<number | null>(null);
  
  const filteredPayments = mockPayments.filter(payment => 
    payment.description.toLowerCase().includes(searchTerm.toLowerCase()) || 
    payment.client.toLowerCase().includes(searchTerm.toLowerCase())
  );
  
  const toggleActionMenu = (id: number) => {
    setActionMenuVisible(actionMenuVisible === id ? null : id);
  };
  
  const formatValue = (value: number) => {
    return value.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
  };
  
  const formatDate = (dateString: string) => {
    const date = new Date(dateString);
    return date.toLocaleDateString('pt-BR');
  };
  
  const getStatusColor = (status: string) => {
    switch (status) {
      case 'Pago':
        return 'bg-success-100 text-success';
      case 'Pendente':
        return 'bg-warning-100 text-warning';
      case 'Cancelado':
        return 'bg-danger-100 text-danger';
      default:
        return 'bg-gray-100 text-gray-500';
    }
  };
  
  return (
    <div>
      <PageHeader 
        title="Pagamentos" 
        subtitle="Controle todos os pagamentos do sistema" 
        action={
          <button className="btn btn-primary flex items-center gap-2">
            <Plus size={16} />
            <span>Novo Pagamento</span>
          </button>
        }
      />
      
      {/* Summary Cards */}
      <div className="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div className="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
          <div className="flex justify-between items-start">
            <div>
              <p className="text-sm font-medium text-gray-500">Total Recebido</p>
              <h3 className="text-2xl font-bold text-gray-800 mt-1">{formatValue(14850.00)}</h3>
            </div>
            <div className="p-3 bg-success-100 rounded-full text-success">
              <CreditCard size={20} />
            </div>
          </div>
        </div>
        
        <div className="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
          <div className="flex justify-between items-start">
            <div>
              <p className="text-sm font-medium text-gray-500">Pendente</p>
              <h3 className="text-2xl font-bold text-gray-800 mt-1">{formatValue(800.00)}</h3>
            </div>
            <div className="p-3 bg-warning-100 rounded-full text-warning">
              <CreditCard size={20} />
            </div>
          </div>
        </div>
        
        <div className="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
          <div className="flex justify-between items-start">
            <div>
              <p className="text-sm font-medium text-gray-500">Total de Pagamentos</p>
              <h3 className="text-2xl font-bold text-gray-800 mt-1">5</h3>
            </div>
            <div className="p-3 bg-primary-50 rounded-full text-primary">
              <CreditCard size={20} />
            </div>
          </div>
        </div>
      </div>
      
      {/* Search and Filter */}
      <div className="mb-6 flex flex-col md:flex-row gap-4">
        <div className="relative flex-1">
          <input
            type="text"
            placeholder="Buscar pagamentos..."
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
            <option value="">Todos os status</option>
            <option value="paid">Pago</option>
            <option value="pending">Pendente</option>
            <option value="canceled">Cancelado</option>
          </select>
          
          <button className="btn btn-secondary flex items-center gap-2">
            <Download size={16} />
            <span>Exportar</span>
          </button>
        </div>
      </div>
      
      {/* Payments Table */}
      <div className="bg-white shadow-sm rounded-lg overflow-hidden">
        <div className="overflow-x-auto">
          <table className="min-w-full divide-y divide-gray-200">
            <thead className="bg-gray-50">
              <tr>
                <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Descrição
                </th>
                <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Cliente
                </th>
                <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Valor
                </th>
                <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Data
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
              {filteredPayments.map((payment) => (
                <tr key={payment.id} className="hover:bg-gray-50 transition-colors">
                  <td className="px-6 py-4 whitespace-nowrap">
                    <div className="text-sm font-medium text-gray-900">{payment.description}</div>
                  </td>
                  <td className="px-6 py-4 whitespace-nowrap">
                    <div className="text-sm text-gray-500">{payment.client}</div>
                  </td>
                  <td className="px-6 py-4 whitespace-nowrap">
                    <div className="text-sm font-medium text-gray-900">{formatValue(payment.value)}</div>
                  </td>
                  <td className="px-6 py-4 whitespace-nowrap">
                    <div className="text-sm text-gray-500">{formatDate(payment.date)}</div>
                  </td>
                  <td className="px-6 py-4 whitespace-nowrap">
                    <span className={`px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${getStatusColor(payment.status)}`}>
                      {payment.status}
                    </span>
                  </td>
                  <td className="px-6 py-4 whitespace-nowrap text-right text-sm font-medium relative">
                    <button 
                      onClick={() => toggleActionMenu(payment.id)}
                      className="text-gray-500 hover:text-gray-700"
                    >
                      <MoreHorizontal size={18} />
                    </button>
                    
                    {actionMenuVisible === payment.id && (
                      <div className="absolute right-6 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-10 border border-gray-200">
                        <a href="#" className="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                          <Eye className="h-4 w-4" />
                          <span>Visualizar</span>
                        </a>
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
            Mostrando <span className="font-medium">{filteredPayments.length}</span> de <span className="font-medium">{mockPayments.length}</span> pagamentos
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

export default Payments;
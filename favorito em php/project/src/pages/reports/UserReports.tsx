import { useState } from 'react';
import { FileDown, Filter, Calendar, Download } from 'lucide-react';
import PageHeader from '../../components/common/PageHeader';

const UserReports = () => {
  const [dateRange, setDateRange] = useState({
    startDate: '',
    endDate: '',
  });
  
  return (
    <div>
      <PageHeader 
        title="Relatório de Usuários" 
        subtitle="Visualize e exporte dados sobre os usuários do sistema" 
        action={
          <button className="btn btn-primary flex items-center gap-2">
            <FileDown size={16} />
            <span>Exportar PDF</span>
          </button>
        }
      />
      
      {/* Filters */}
      <div className="bg-white p-6 rounded-lg shadow-sm border border-gray-100 mb-6">
        <h2 className="text-lg font-medium text-gray-800 mb-4 flex items-center gap-2">
          <Filter size={18} />
          <span>Filtros</span>
        </h2>
        
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
          <div>
            <label className="form-label" htmlFor="status">Status</label>
            <select id="status" className="form-input">
              <option value="">Todos</option>
              <option value="active">Ativos</option>
              <option value="inactive">Inativos</option>
            </select>
          </div>
          
          <div>
            <label className="form-label" htmlFor="role">Perfil</label>
            <select id="role" className="form-input">
              <option value="">Todos</option>
              <option value="admin">Administrador</option>
              <option value="manager">Gerente</option>
              <option value="user">Usuário</option>
            </select>
          </div>
          
          <div>
            <label className="form-label" htmlFor="startDate">
              <div className="flex items-center gap-1">
                <Calendar size={14} />
                <span>Data Inicial</span>
              </div>
            </label>
            <input 
              type="date" 
              id="startDate" 
              className="form-input"
              value={dateRange.startDate}
              onChange={(e) => setDateRange({...dateRange, startDate: e.target.value})}
            />
          </div>
          
          <div>
            <label className="form-label" htmlFor="endDate">
              <div className="flex items-center gap-1">
                <Calendar size={14} />
                <span>Data Final</span>
              </div>
            </label>
            <input 
              type="date" 
              id="endDate" 
              className="form-input"
              value={dateRange.endDate}
              onChange={(e) => setDateRange({...dateRange, endDate: e.target.value})}
            />
          </div>
        </div>
        
        <div className="mt-4 flex justify-end">
          <button className="btn btn-primary">
            Aplicar Filtros
          </button>
        </div>
      </div>
      
      {/* Stats */}
      <div className="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div className="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
          <p className="text-sm font-medium text-gray-500">Total de Usuários</p>
          <h2 className="text-3xl font-bold text-gray-800 mt-2">184</h2>
          <div className="flex items-center text-success text-sm mt-2">
            <span>+12% desde o último mês</span>
          </div>
        </div>
        
        <div className="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
          <p className="text-sm font-medium text-gray-500">Usuários Ativos</p>
          <h2 className="text-3xl font-bold text-gray-800 mt-2">156</h2>
          <div className="flex items-center text-success text-sm mt-2">
            <span>85% do total</span>
          </div>
        </div>
        
        <div className="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
          <p className="text-sm font-medium text-gray-500">Novos Usuários</p>
          <h2 className="text-3xl font-bold text-gray-800 mt-2">28</h2>
          <div className="flex items-center text-success text-sm mt-2">
            <span>No último mês</span>
          </div>
        </div>
      </div>
      
      {/* Chart Section */}
      <div className="bg-white p-6 rounded-lg shadow-sm border border-gray-100 mb-6">
        <div className="flex justify-between items-center mb-6">
          <h2 className="text-lg font-medium text-gray-800">Crescimento de Usuários</h2>
          <div>
            <select className="form-input text-sm">
              <option value="12months">Últimos 12 meses</option>
              <option value="6months">Últimos 6 meses</option>
              <option value="3months">Últimos 3 meses</option>
            </select>
          </div>
        </div>
        
        {/* Chart Placeholder */}
        <div className="h-80 bg-gray-50 flex items-center justify-center rounded-lg border border-gray-100">
          <p className="text-gray-500">Gráfico de crescimento de usuários</p>
        </div>
      </div>
      
      {/* Distribution Section */}
      <div className="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div className="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
          <h2 className="text-lg font-medium text-gray-800 mb-4">Distribuição por Perfil</h2>
          
          {/* Chart Placeholder */}
          <div className="h-60 bg-gray-50 flex items-center justify-center rounded-lg border border-gray-100">
            <p className="text-gray-500">Gráfico de distribuição por perfil</p>
          </div>
          
          <div className="mt-4 space-y-2">
            <div className="flex justify-between items-center">
              <div className="flex items-center">
                <div className="w-3 h-3 rounded-full bg-primary mr-2"></div>
                <span className="text-sm text-gray-600">Administradores</span>
              </div>
              <span className="text-sm font-medium">15 (8%)</span>
            </div>
            
            <div className="flex justify-between items-center">
              <div className="flex items-center">
                <div className="w-3 h-3 rounded-full bg-secondary mr-2"></div>
                <span className="text-sm text-gray-600">Gerentes</span>
              </div>
              <span className="text-sm font-medium">42 (23%)</span>
            </div>
            
            <div className="flex justify-between items-center">
              <div className="flex items-center">
                <div className="w-3 h-3 rounded-full bg-success mr-2"></div>
                <span className="text-sm text-gray-600">Usuários</span>
              </div>
              <span className="text-sm font-medium">127 (69%)</span>
            </div>
          </div>
        </div>
        
        <div className="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
          <h2 className="text-lg font-medium text-gray-800 mb-4">Status dos Usuários</h2>
          
          {/* Chart Placeholder */}
          <div className="h-60 bg-gray-50 flex items-center justify-center rounded-lg border border-gray-100">
            <p className="text-gray-500">Gráfico de status dos usuários</p>
          </div>
          
          <div className="mt-4 space-y-2">
            <div className="flex justify-between items-center">
              <div className="flex items-center">
                <div className="w-3 h-3 rounded-full bg-success mr-2"></div>
                <span className="text-sm text-gray-600">Ativos</span>
              </div>
              <span className="text-sm font-medium">156 (85%)</span>
            </div>
            
            <div className="flex justify-between items-center">
              <div className="flex items-center">
                <div className="w-3 h-3 rounded-full bg-danger mr-2"></div>
                <span className="text-sm text-gray-600">Inativos</span>
              </div>
              <span className="text-sm font-medium">28 (15%)</span>
            </div>
          </div>
        </div>
      </div>
      
      {/* Export Options */}
      <div className="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
        <h2 className="text-lg font-medium text-gray-800 mb-4 flex items-center gap-2">
          <Download size={18} />
          <span>Exportar Relatório</span>
        </h2>
        
        <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
          <button className="btn btn-primary flex items-center justify-center gap-2">
            <FileDown size={16} />
            <span>Exportar como PDF</span>
          </button>
          
          <button className="btn btn-secondary flex items-center justify-center gap-2">
            <FileDown size={16} />
            <span>Exportar como Excel</span>
          </button>
          
          <button className="btn flex items-center justify-center gap-2 bg-white border border-gray-300 text-gray-700 hover:bg-gray-50">
            <FileDown size={16} />
            <span>Exportar como CSV</span>
          </button>
        </div>
      </div>
    </div>
  );
};

export default UserReports;
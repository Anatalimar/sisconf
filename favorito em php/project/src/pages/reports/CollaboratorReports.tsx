import { useState } from 'react';
import { FileDown, Filter, Calendar, PieChart, BarChart3 } from 'lucide-react';
import PageHeader from '../../components/common/PageHeader';

const CollaboratorReports = () => {
  const [dateRange, setDateRange] = useState({
    startDate: '',
    endDate: '',
  });
  
  return (
    <div>
      <PageHeader 
        title="Relatório de Colaboradores" 
        subtitle="Visualize e exporte dados sobre os colaboradores da empresa" 
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
            <label className="form-label" htmlFor="department">Departamento</label>
            <select id="department" className="form-input">
              <option value="">Todos</option>
              <option value="ti">TI</option>
              <option value="rh">RH</option>
              <option value="marketing">Marketing</option>
              <option value="comercial">Comercial</option>
              <option value="financeiro">Financeiro</option>
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
          <p className="text-sm font-medium text-gray-500">Total de Colaboradores</p>
          <h2 className="text-3xl font-bold text-gray-800 mt-2">32</h2>
          <div className="flex items-center text-success text-sm mt-2">
            <span>+5% desde o último mês</span>
          </div>
        </div>
        
        <div className="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
          <p className="text-sm font-medium text-gray-500">Colaboradores Ativos</p>
          <h2 className="text-3xl font-bold text-gray-800 mt-2">29</h2>
          <div className="flex items-center text-success text-sm mt-2">
            <span>91% do total</span>
          </div>
        </div>
        
        <div className="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
          <p className="text-sm font-medium text-gray-500">Novos Colaboradores</p>
          <h2 className="text-3xl font-bold text-gray-800 mt-2">5</h2>
          <div className="flex items-center text-success text-sm mt-2">
            <span>No último mês</span>
          </div>
        </div>
      </div>
      
      {/* Distribution Section */}
      <div className="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div className="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
          <div className="flex items-center justify-between mb-4">
            <h2 className="text-lg font-medium text-gray-800">Distribuição por Departamento</h2>
            <PieChart size={20} className="text-primary" />
          </div>
          
          {/* Chart Placeholder */}
          <div className="h-60 bg-gray-50 flex items-center justify-center rounded-lg border border-gray-100">
            <p className="text-gray-500">Gráfico de distribuição por departamento</p>
          </div>
          
          <div className="mt-4 space-y-2">
            <div className="flex justify-between items-center">
              <div className="flex items-center">
                <div className="w-3 h-3 rounded-full bg-primary mr-2"></div>
                <span className="text-sm text-gray-600">TI</span>
              </div>
              <span className="text-sm font-medium">12 (38%)</span>
            </div>
            
            <div className="flex justify-between items-center">
              <div className="flex items-center">
                <div className="w-3 h-3 rounded-full bg-secondary mr-2"></div>
                <span className="text-sm text-gray-600">RH</span>
              </div>
              <span className="text-sm font-medium">5 (16%)</span>
            </div>
            
            <div className="flex justify-between items-center">
              <div className="flex items-center">
                <div className="w-3 h-3 rounded-full bg-success mr-2"></div>
                <span className="text-sm text-gray-600">Marketing</span>
              </div>
              <span className="text-sm font-medium">6 (19%)</span>
            </div>
            
            <div className="flex justify-between items-center">
              <div className="flex items-center">
                <div className="w-3 h-3 rounded-full bg-warning mr-2"></div>
                <span className="text-sm text-gray-600">Comercial</span>
              </div>
              <span className="text-sm font-medium">7 (22%)</span>
            </div>
            
            <div className="flex justify-between items-center">
              <div className="flex items-center">
                <div className="w-3 h-3 rounded-full bg-danger mr-2"></div>
                <span className="text-sm text-gray-600">Financeiro</span>
              </div>
              <span className="text-sm font-medium">2 (6%)</span>
            </div>
          </div>
        </div>
        
        <div className="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
          <div className="flex items-center justify-between mb-4">
            <h2 className="text-lg font-medium text-gray-800">Tempo de Empresa</h2>
            <BarChart3 size={20} className="text-primary" />
          </div>
          
          {/* Chart Placeholder */}
          <div className="h-60 bg-gray-50 flex items-center justify-center rounded-lg border border-gray-100">
            <p className="text-gray-500">Gráfico de tempo de empresa</p>
          </div>
          
          <div className="mt-4 space-y-2">
            <div className="flex justify-between items-center">
              <div className="flex items-center">
                <div className="w-3 h-3 rounded-full bg-primary mr-2"></div>
                <span className="text-sm text-gray-600">Menos de 1 ano</span>
              </div>
              <span className="text-sm font-medium">8 (25%)</span>
            </div>
            
            <div className="flex justify-between items-center">
              <div className="flex items-center">
                <div className="w-3 h-3 rounded-full bg-secondary mr-2"></div>
                <span className="text-sm text-gray-600">1-2 anos</span>
              </div>
              <span className="text-sm font-medium">12 (38%)</span>
            </div>
            
            <div className="flex justify-between items-center">
              <div className="flex items-center">
                <div className="w-3 h-3 rounded-full bg-success mr-2"></div>
                <span className="text-sm text-gray-600">3-5 anos</span>
              </div>
              <span className="text-sm font-medium">9 (28%)</span>
            </div>
            
            <div className="flex justify-between items-center">
              <div className="flex items-center">
                <div className="w-3 h-3 rounded-full bg-warning mr-2"></div>
                <span className="text-sm text-gray-600">Mais de 5 anos</span>
              </div>
              <span className="text-sm font-medium">3 (9%)</span>
            </div>
          </div>
        </div>
      </div>
      
      {/* Table */}
      <div className="bg-white p-6 rounded-lg shadow-sm border border-gray-100 mb-6">
        <h2 className="text-lg font-medium text-gray-800 mb-4">Resumo por Departamento</h2>
        
        <div className="overflow-x-auto">
          <table className="min-w-full divide-y divide-gray-200">
            <thead className="bg-gray-50">
              <tr>
                <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Departamento
                </th>
                <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Total de Colaboradores
                </th>
                <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Ativos
                </th>
                <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Inativos
                </th>
                <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Idade Média
                </th>
              </tr>
            </thead>
            <tbody className="bg-white divide-y divide-gray-200">
              <tr>
                <td className="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">TI</td>
                <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">12</td>
                <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">11</td>
                <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">1</td>
                <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">32 anos</td>
              </tr>
              <tr>
                <td className="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">RH</td>
                <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">5</td>
                <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">5</td>
                <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">0</td>
                <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">36 anos</td>
              </tr>
              <tr>
                <td className="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Marketing</td>
                <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">6</td>
                <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">5</td>
                <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">1</td>
                <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">29 anos</td>
              </tr>
              <tr>
                <td className="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Comercial</td>
                <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">7</td>
                <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">6</td>
                <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">1</td>
                <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">33 anos</td>
              </tr>
              <tr>
                <td className="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Financeiro</td>
                <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2</td>
                <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2</td>
                <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">0</td>
                <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">38 anos</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      
      {/* Export Options */}
      <div className="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
        <h2 className="text-lg font-medium text-gray-800 mb-4">Exportar Relatório</h2>
        
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

export default CollaboratorReports;
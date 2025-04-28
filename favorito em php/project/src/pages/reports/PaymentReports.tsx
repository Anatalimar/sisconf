import { useState } from 'react';
import { FileDown, Filter, Calendar, LineChart, DollarSign } from 'lucide-react';
import PageHeader from '../../components/common/PageHeader';

const PaymentReports = () => {
  const [dateRange, setDateRange] = useState({
    startDate: '',
    endDate: '',
  });
  
  return (
    <div>
      <PageHeader 
        title="Relatório de Pagamentos" 
        subtitle="Visualize e exporte dados sobre os pagamentos do sistema" 
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
              <option value="paid">Pagos</option>
              <option value="pending">Pendentes</option>
              <option value="canceled">Cancelados</option>
            </select>
          </div>
          
          <div>
            <label className="form-label" htmlFor="client">Cliente</label>
            <select id="client" className="form-input">
              <option value="">Todos</option>
              <option value="company-a">Empresa ABC</option>
              <option value="company-b">Loja XYZ</option>
              <option value="company-c">Cliente Particular</option>
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
          <p className="text-sm font-medium text-gray-500">Total de Pagamentos</p>
          <h2 className="text-3xl font-bold text-gray-800 mt-2">R$ 17.150,00</h2>
          <div className="flex items-center text-success text-sm mt-2">
            <span>+18% desde o último mês</span>
          </div>
        </div>
        
        <div className="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
          <p className="text-sm font-medium text-gray-500">Pagamentos Recebidos</p>
          <h2 className="text-3xl font-bold text-gray-800 mt-2">R$ 14.850,00</h2>
          <div className="flex items-center text-success text-sm mt-2">
            <span>87% do total</span>
          </div>
        </div>
        
        <div className="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
          <p className="text-sm font-medium text-gray-500">Pagamentos Pendentes</p>
          <h2 className="text-3xl font-bold text-gray-800 mt-2">R$ 800,00</h2>
          <div className="flex items-center text-warning text-sm mt-2">
            <span>5% do total</span>
          </div>
        </div>
      </div>
      
      {/* Chart Section */}
      <div className="bg-white p-6 rounded-lg shadow-sm border border-gray-100 mb-6">
        <div className="flex justify-between items-center mb-6">
          <h2 className="text-lg font-medium text-gray-800 flex items-center gap-2">
            <LineChart size={18} />
            <span>Pagamentos por Mês</span>
          </h2>
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
          <p className="text-gray-500">Gráfico de pagamentos mensais</p>
        </div>
      </div>
      
      {/* Summary Section */}
      <div className="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div className="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
          <h2 className="text-lg font-medium text-gray-800 mb-4 flex items-center gap-2">
            <DollarSign size={18} />
            <span>Distribuição por Cliente</span>
          </h2>
          
          <div className="overflow-x-auto">
            <table className="min-w-full divide-y divide-gray-200">
              <thead className="bg-gray-50">
                <tr>
                  <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Cliente
                  </th>
                  <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Total Pago
                  </th>
                  <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Quantidade
                  </th>
                  <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    % do Total
                  </th>
                </tr>
              </thead>
              <tbody className="bg-white divide-y divide-gray-200">
                <tr>
                  <td className="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Empresa ABC</td>
                  <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">R$ 2.500,00</td>
                  <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">1</td>
                  <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">15%</td>
                </tr>
                <tr>
                  <td className="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Cliente Particular</td>
                  <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">R$ 12.000,00</td>
                  <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">1</td>
                  <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">70%</td>
                </tr>
                <tr>
                  <td className="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Cliente GHI</td>
                  <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">R$ 350,00</td>
                  <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">1</td>
                  <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2%</td>
                </tr>
                <tr>
                  <td className="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Loja XYZ</td>
                  <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">R$ 0,00</td>
                  <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">1 (Pendente)</td>
                  <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">0%</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        
        <div className="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
          <h2 className="text-lg font-medium text-gray-800 mb-4">Status dos Pagamentos</h2>
          
          {/* Chart Placeholder */}
          <div className="h-60 bg-gray-50 flex items-center justify-center rounded-lg border border-gray-100">
            <p className="text-gray-500">Gráfico de status dos pagamentos</p>
          </div>
          
          <div className="mt-4 space-y-2">
            <div className="flex justify-between items-center">
              <div className="flex items-center">
                <div className="w-3 h-3 rounded-full bg-success mr-2"></div>
                <span className="text-sm text-gray-600">Pagos</span>
              </div>
              <span className="text-sm font-medium">3 (60%)</span>
            </div>
            
            <div className="flex justify-between items-center">
              <div className="flex items-center">
                <div className="w-3 h-3 rounded-full bg-warning mr-2"></div>
                <span className="text-sm text-gray-600">Pendentes</span>
              </div>
              <span className="text-sm font-medium">1 (20%)</span>
            </div>
            
            <div className="flex justify-between items-center">
              <div className="flex items-center">
                <div className="w-3 h-3 rounded-full bg-danger mr-2"></div>
                <span className="text-sm text-gray-600">Cancelados</span>
              </div>
              <span className="text-sm font-medium">1 (20%)</span>
            </div>
          </div>
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

export default PaymentReports;
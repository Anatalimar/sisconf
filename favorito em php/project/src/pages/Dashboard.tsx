import { 
  Users, 
  UserCog, 
  CreditCard, 
  TrendingUp, 
  ArrowUpRight,
  BarChart3 
} from 'lucide-react';
import PageHeader from '../components/common/PageHeader';
import DashboardCard from '../components/common/DashboardCard';

const Dashboard = () => {
  return (
    <div>
      <PageHeader 
        title="Dashboard" 
        subtitle="Bem-vindo ao SISCONF. Aqui está um resumo do sistema." 
      />
      
      {/* Cards */}
      <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <DashboardCard 
          title="Usuários Ativos" 
          value="184" 
          icon={Users} 
          color="primary"
          change={{ value: 12, isPositive: true }}
        />
        
        <DashboardCard 
          title="Colaboradores" 
          value="32" 
          icon={UserCog} 
          color="secondary"
          change={{ value: 5, isPositive: true }}
        />
        
        <DashboardCard 
          title="Pagamentos" 
          value="R$ 24.980" 
          icon={CreditCard} 
          color="success"
          change={{ value: 18, isPositive: true }}
        />
        
        <DashboardCard 
          title="Novos Registros" 
          value="28" 
          icon={TrendingUp} 
          color="warning"
          change={{ value: 3, isPositive: false }}
        />
      </div>
      
      {/* Overview Section */}
      <div className="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div className="lg:col-span-2">
          <div className="bg-white p-6 rounded-lg shadow-sm border border-gray-100 h-full">
            <div className="flex items-center justify-between mb-4">
              <h2 className="text-lg font-semibold text-gray-800">Atividade Recente</h2>
              <button className="text-sm text-primary font-medium flex items-center">
                Ver todos
                <ArrowUpRight className="ml-1 h-4 w-4" />
              </button>
            </div>
            
            <div className="space-y-4">
              {[1, 2, 3, 4, 5].map((item) => (
                <div key={item} className="flex items-center p-3 hover:bg-gray-50 rounded-md transition-colors">
                  <div className="w-10 h-10 rounded-full bg-primary-50 flex items-center justify-center text-primary mr-4">
                    <UserCog size={20} />
                  </div>
                  <div className="flex-1">
                    <p className="text-sm font-medium text-gray-800">Novo colaborador registrado</p>
                    <p className="text-xs text-gray-500">Há {item} hora{item !== 1 ? 's' : ''}</p>
                  </div>
                </div>
              ))}
            </div>
          </div>
        </div>
        
        <div>
          <div className="bg-white p-6 rounded-lg shadow-sm border border-gray-100 h-full">
            <div className="flex items-center justify-between mb-4">
              <h2 className="text-lg font-semibold text-gray-800">Relatório Rápido</h2>
              <BarChart3 className="h-5 w-5 text-primary" />
            </div>
            
            <div className="space-y-6">
              <div>
                <div className="flex justify-between items-center mb-2">
                  <p className="text-sm font-medium text-gray-600">Usuários</p>
                  <p className="text-sm font-bold text-gray-800">184/200</p>
                </div>
                <div className="w-full h-2 bg-gray-100 rounded-full overflow-hidden">
                  <div className="h-full bg-primary" style={{ width: '92%' }}></div>
                </div>
              </div>
              
              <div>
                <div className="flex justify-between items-center mb-2">
                  <p className="text-sm font-medium text-gray-600">Pagamentos</p>
                  <p className="text-sm font-bold text-gray-800">65%</p>
                </div>
                <div className="w-full h-2 bg-gray-100 rounded-full overflow-hidden">
                  <div className="h-full bg-success" style={{ width: '65%' }}></div>
                </div>
              </div>
              
              <div>
                <div className="flex justify-between items-center mb-2">
                  <p className="text-sm font-medium text-gray-600">Colaboradores</p>
                  <p className="text-sm font-bold text-gray-800">32/50</p>
                </div>
                <div className="w-full h-2 bg-gray-100 rounded-full overflow-hidden">
                  <div className="h-full bg-warning" style={{ width: '64%' }}></div>
                </div>
              </div>
              
              <div>
                <div className="flex justify-between items-center mb-2">
                  <p className="text-sm font-medium text-gray-600">Relatórios</p>
                  <p className="text-sm font-bold text-gray-800">12/20</p>
                </div>
                <div className="w-full h-2 bg-gray-100 rounded-full overflow-hidden">
                  <div className="h-full bg-secondary" style={{ width: '60%' }}></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default Dashboard;
import { useState } from 'react';
import { NavLink } from 'react-router-dom';
import { 
  LayoutDashboard,
  Users,
  UserCog,
  CreditCard,
  FileText,
  ChevronDown,
  ChevronRight,
  Menu,
  X
} from 'lucide-react';
import SisconfLogo from '../common/SisconfLogo';

const Sidebar = () => {
  const [isOpen, setIsOpen] = useState(true);
  const [expandedMenus, setExpandedMenus] = useState({
    cadastros: false,
    financeiro: false,
    relatorios: false
  });
  
  const [isMobileOpen, setIsMobileOpen] = useState(false);

  const toggleSidebar = () => {
    setIsOpen(!isOpen);
  };
  
  const toggleMobileSidebar = () => {
    setIsMobileOpen(!isMobileOpen);
  };

  const toggleMenu = (menu: keyof typeof expandedMenus) => {
    setExpandedMenus(prev => ({
      ...prev,
      [menu]: !prev[menu]
    }));
  };

  return (
    <>
      {/* Mobile Menu Toggle */}
      <button 
        onClick={toggleMobileSidebar}
        className="md:hidden fixed top-4 left-4 z-20 p-2 rounded-md bg-white shadow-md text-gray-800"
      >
        {isMobileOpen ? <X size={20} /> : <Menu size={20} />}
      </button>
      
      {/* Sidebar Overlay */}
      {isMobileOpen && (
        <div 
          className="md:hidden fixed inset-0 bg-black bg-opacity-50 z-10"
          onClick={toggleMobileSidebar}
        ></div>
      )}
      
      {/* Sidebar */}
      <aside 
        className={`
          fixed md:static inset-y-0 left-0 z-20
          w-64 bg-white border-r border-gray-200 shadow-sm
          transition-transform duration-300 ease-in-out
          ${isMobileOpen ? 'translate-x-0' : '-translate-x-full'}
          md:translate-x-0
        `}
      >
        <div className="h-full flex flex-col">
          {/* Logo and Title */}
          <div className="p-4 border-b border-gray-200">
            <div className="flex items-center gap-2">
              <SisconfLogo />
              <h1 className="text-xl font-bold text-primary">SISCONF</h1>
            </div>
            <p className="text-xs text-gray-500 mt-1">Sistema de Controle e Gerenciamento</p>
          </div>
          
          {/* Navigation */}
          <nav className="flex-1 overflow-y-auto py-4">
            <NavLink to="/" className={({isActive}) => `sidebar-link ${isActive ? 'active' : ''}`}>
              <LayoutDashboard size={18} />
              <span>Dashboard</span>
            </NavLink>
            
            {/* Cadastros */}
            <div>
              <button 
                onClick={() => toggleMenu('cadastros')}
                className="w-full flex items-center justify-between sidebar-link"
              >
                <div className="flex items-center gap-2">
                  <Users size={18} />
                  <span>Cadastros</span>
                </div>
                {expandedMenus.cadastros ? <ChevronDown size={16} /> : <ChevronRight size={16} />}
              </button>
              
              {expandedMenus.cadastros && (
                <div className="pl-10 pr-4 py-2 space-y-1">
                  <NavLink to="/usuarios" className={({isActive}) => `sidebar-link ${isActive ? 'active' : ''}`}>
                    <span>Usuários</span>
                  </NavLink>
                  <NavLink to="/colaboradores" className={({isActive}) => `sidebar-link ${isActive ? 'active' : ''}`}>
                    <span>Colaboradores</span>
                  </NavLink>
                </div>
              )}
            </div>
            
            {/* Financeiro */}
            <div>
              <button 
                onClick={() => toggleMenu('financeiro')}
                className="w-full flex items-center justify-between sidebar-link"
              >
                <div className="flex items-center gap-2">
                  <CreditCard size={18} />
                  <span>Financeiro</span>
                </div>
                {expandedMenus.financeiro ? <ChevronDown size={16} /> : <ChevronRight size={16} />}
              </button>
              
              {expandedMenus.financeiro && (
                <div className="pl-10 pr-4 py-2 space-y-1">
                  <NavLink to="/pagamentos" className={({isActive}) => `sidebar-link ${isActive ? 'active' : ''}`}>
                    <span>Pagamentos</span>
                  </NavLink>
                </div>
              )}
            </div>
            
            {/* Relatórios */}
            <div>
              <button 
                onClick={() => toggleMenu('relatorios')}
                className="w-full flex items-center justify-between sidebar-link"
              >
                <div className="flex items-center gap-2">
                  <FileText size={18} />
                  <span>Relatórios</span>
                </div>
                {expandedMenus.relatorios ? <ChevronDown size={16} /> : <ChevronRight size={16} />}
              </button>
              
              {expandedMenus.relatorios && (
                <div className="pl-10 pr-4 py-2 space-y-1">
                  <NavLink to="/relatorios/usuarios" className={({isActive}) => `sidebar-link ${isActive ? 'active' : ''}`}>
                    <span>Relatório de Usuários</span>
                  </NavLink>
                  <NavLink to="/relatorios/colaboradores" className={({isActive}) => `sidebar-link ${isActive ? 'active' : ''}`}>
                    <span>Relatório de Colaboradores</span>
                  </NavLink>
                  <NavLink to="/relatorios/pagamentos" className={({isActive}) => `sidebar-link ${isActive ? 'active' : ''}`}>
                    <span>Relatório de Pagamentos</span>
                  </NavLink>
                </div>
              )}
            </div>
          </nav>
          
          {/* Sidebar Footer */}
          <div className="p-4 border-t border-gray-200 text-xs text-gray-500">
            <p>SISCONF v1.0</p>
            <p>© 2025 Todos os direitos reservados</p>
          </div>
        </div>
      </aside>
    </>
  );
};

export default Sidebar;
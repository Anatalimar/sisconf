import { useState } from 'react';
import { ChevronDown, LogOut, Settings, User as UserIcon } from 'lucide-react';
import SisconfLogo from '../common/SisconfLogo';

const Header = () => {
  const [userMenuOpen, setUserMenuOpen] = useState(false);
  
  const toggleUserMenu = () => {
    setUserMenuOpen(!userMenuOpen);
  };

  return (
    <header className="bg-white border-b border-gray-200 shadow-sm z-10">
      <div className="container mx-auto px-4 py-3 flex justify-between items-center">
        <div className="flex items-center md:hidden">
          <SisconfLogo size="small" />
        </div>
        
        <div className="flex-1 md:flex justify-between items-center px-4 hidden">
          <h1 className="text-xl font-semibold text-gray-800">SISCONF</h1>
        </div>
        
        <div className="relative">
          <button 
            onClick={toggleUserMenu}
            className="flex items-center gap-2 focus:outline-none"
          >
            <div className="w-8 h-8 rounded-full bg-primary-100 flex items-center justify-center overflow-hidden">
              <UserIcon className="h-4 w-4 text-primary" />
            </div>
            <div className="hidden md:block text-sm">
              <span className="text-gray-800 font-medium">Administrador</span>
            </div>
            <ChevronDown className="h-4 w-4 text-gray-400" />
          </button>
          
          {userMenuOpen && (
            <div className="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-10 border border-gray-200">
              <a href="#" className="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                <UserIcon className="h-4 w-4" />
                <span>Perfil</span>
              </a>
              <a href="#" className="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                <Settings className="h-4 w-4" />
                <span>Configurações</span>
              </a>
              <div className="border-t border-gray-100 my-1"></div>
              <a href="#" className="flex items-center gap-2 px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                <LogOut className="h-4 w-4" />
                <span>Sair</span>
              </a>
            </div>
          )}
        </div>
      </div>
    </header>
  );
};

export default Header;
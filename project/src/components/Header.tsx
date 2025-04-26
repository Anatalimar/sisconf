import React from 'react';
import { PartyPopper, CalendarDays, MapPin } from 'lucide-react';

const Header: React.FC = () => {
  return (
    <header className="relative overflow-hidden">
      <div className="absolute inset-0 bg-gradient-to-r from-blue-900 to-purple-900 opacity-90" />
      
      <div 
        className="absolute inset-0 opacity-10"
        style={{
          backgroundImage: 'url("https://images.pexels.com/photos/1190298/pexels-photo-1190298.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2")',
          backgroundSize: 'cover',
          backgroundPosition: 'center',
        }}
      />
      
      <div className="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 py-24 text-center">
        <div className="animate-bounce inline-block mb-4">
          <PartyPopper className="h-12 w-12 text-yellow-400 inline-block" />
        </div>
        
        <h1 className="text-4xl md:text-6xl font-bold tracking-tight text-white mb-4">
          <span className="block">Festa de Fim de Ano</span>
          <span className="block text-yellow-300">Departamento de TI</span>
          <span className="block text-3xl md:text-5xl mt-2">2025</span>
        </h1>
        
        <div className="mt-8 flex flex-col md:flex-row items-center justify-center space-y-4 md:space-y-0 md:space-x-8">
          <div className="flex items-center text-white">
            <CalendarDays className="h-6 w-6 mr-2 text-yellow-300" />
            <span>27 de Dezembro (Sábado)</span>
          </div>
          
          <div className="flex items-center text-white">
            <MapPin className="h-6 w-6 mr-2 text-yellow-300" />
            <span>Vidas Buffet</span>
          </div>
        </div>
      </div>
    </header>
  );
};

export default Header;
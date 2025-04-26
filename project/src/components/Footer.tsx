import React from 'react';
import { Mail, Phone, ChevronsUp } from 'lucide-react';

const Footer: React.FC = () => {
  const scrollToTop = () => {
    window.scrollTo({
      top: 0,
      behavior: 'smooth',
    });
  };

  return (
    <footer className="bg-blue-900 text-white">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 py-12">
        <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
          <div>
            <h3 className="text-xl font-semibold mb-4">Festa de Fim de Ano 2025</h3>
            <p className="text-blue-200">
              Departamento de Tecnologia da Informação<br />
              27 de Dezembro, 2025<br />
              Vidas Buffet
            </p>
          </div>
          
          <div>
            <h3 className="text-xl font-semibold mb-4">Contato</h3>
            <ul className="space-y-2">
              <li className="flex items-center">
                <Mail className="h-5 w-5 mr-2 text-yellow-300" />
                <a href="mailto:festati@exemplo.com" className="text-blue-200 hover:text-white transition-colors duration-200">festati@exemplo.com</a>
              </li>
              <li className="flex items-center">
                <Phone className="h-5 w-5 mr-2 text-yellow-300" />
                <a href="tel:+5511999999999" className="text-blue-200 hover:text-white transition-colors duration-200">(11) 99999-9999</a>
              </li>
            </ul>
          </div>
          
          <div>
            <h3 className="text-xl font-semibold mb-4">Informações</h3>
            <p className="text-blue-200">
              Para mais informações sobre o evento ou para tirar dúvidas, entre em contato com a comissão organizadora.
            </p>
          </div>
        </div>
        
        <div className="mt-8 pt-8 border-t border-blue-800 flex flex-col md:flex-row justify-between items-center">
          <p className="text-blue-300 text-sm">
            &copy; {new Date().getFullYear()} Departamento de TI - Todos os direitos reservados
          </p>
          
          <button 
            onClick={scrollToTop}
            className="mt-4 md:mt-0 flex items-center text-yellow-300 hover:text-yellow-100 transition-colors duration-200"
          >
            <span className="mr-1">Voltar ao topo</span>
            <ChevronsUp className="h-5 w-5" />
          </button>
        </div>
      </div>
    </footer>
  );
};

export default Footer;
import { Link } from 'react-router-dom';

const Footer = () => {
  const currentYear = new Date().getFullYear();
  
  return (
    <footer className="bg-white border-t border-gray-200 py-3 px-4 md:px-6">
      <div className="container mx-auto flex flex-col md:flex-row justify-between items-center">
        <div className="text-sm text-gray-500 mb-2 md:mb-0">
          &copy; {currentYear} SISCONF. Todos os direitos reservados.
        </div>
        <div className="flex items-center space-x-4 text-sm">
          <Link to="/politica-privacidade" className="text-primary hover:text-primary-600 transition-colors">
            Política de Privacidade
          </Link>
          <Link to="/termos-uso" className="text-primary hover:text-primary-600 transition-colors">
            Termos de Uso
          </Link>
          <Link to="/suporte" className="text-primary hover:text-primary-600 transition-colors">
            Suporte
          </Link>
        </div>
      </div>
    </footer>
  );
};

export default Footer;
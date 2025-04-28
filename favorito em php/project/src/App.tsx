import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import Layout from './components/layout/Layout';
import Dashboard from './pages/Dashboard';
import Users from './pages/Users';
import Collaborators from './pages/Collaborators';
import Payments from './pages/Payments';
import UserReports from './pages/reports/UserReports';
import CollaboratorReports from './pages/reports/CollaboratorReports';
import PaymentReports from './pages/reports/PaymentReports';

function App() {
  return (
    <Router>
      <Layout>
        <Routes>
          <Route path="/" element={<Dashboard />} />
          <Route path="/usuarios" element={<Users />} />
          <Route path="/colaboradores" element={<Collaborators />} />
          <Route path="/pagamentos" element={<Payments />} />
          <Route path="/relatorios/usuarios" element={<UserReports />} />
          <Route path="/relatorios/colaboradores" element={<CollaboratorReports />} />
          <Route path="/relatorios/pagamentos" element={<PaymentReports />} />
        </Routes>
      </Layout>
    </Router>
  );
}

export default App;
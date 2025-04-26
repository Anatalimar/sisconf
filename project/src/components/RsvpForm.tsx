import React, { useState } from 'react';
import { CheckCircle, User, Mail, Building, Users } from 'lucide-react';
import { Attendee } from '../types';

interface RsvpFormProps {
  onSubmit: (attendee: Attendee) => void;
}

const RsvpForm: React.FC<RsvpFormProps> = ({ onSubmit }) => {
  const [attendee, setAttendee] = useState<Attendee>({
    name: '',
    email: '',
    department: '',
    type: 'server',
    willAttend: true
  });
  const [showChildAge, setShowChildAge] = useState(false);

  const handleChange = (e: React.ChangeEvent<HTMLInputElement | HTMLSelectElement>) => {
    const { name, value } = e.target;
    
    if (name === 'type') {
      const isChild = value === 'child';
      setShowChildAge(isChild);
      setAttendee(prev => ({
        ...prev,
        [name]: value,
        childAge: isChild ? prev.childAge || 4 : undefined
      }));
    } else {
      setAttendee(prev => ({
        ...prev,
        [name]: value
      }));
    }
  };

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    onSubmit(attendee);
  };

  return (
    <div className="bg-gray-50 py-16">
      <div className="max-w-3xl mx-auto px-4 sm:px-6">
        <div className="text-center mb-10">
          <h2 className="text-3xl font-bold text-gray-900">Confirme sua Participação</h2>
          <p className="mt-4 text-lg text-gray-600">
            Preencha o formulário abaixo para confirmar sua presença em nossa celebração.
          </p>
        </div>

        <form 
          onSubmit={handleSubmit} 
          className="bg-white shadow-xl rounded-lg p-8 transform transition-all hover:scale-[1.01] duration-300"
        >
          <div className="grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-8">
            <div className="sm:col-span-2">
              <label htmlFor="name" className="block text-sm font-medium text-gray-700 flex items-center">
                <User className="h-4 w-4 mr-1 text-blue-600" />
                Nome Completo
              </label>
              <div className="mt-1">
                <input
                  type="text"
                  name="name"
                  id="name"
                  required
                  value={attendee.name}
                  onChange={handleChange}
                  className="py-3 px-4 block w-full shadow-sm focus:ring-blue-500 focus:border-blue-500 border-gray-300 rounded-md"
                />
              </div>
            </div>

            <div className="sm:col-span-2">
              <label htmlFor="email" className="block text-sm font-medium text-gray-700 flex items-center">
                <Mail className="h-4 w-4 mr-1 text-blue-600" />
                Email
              </label>
              <div className="mt-1">
                <input
                  type="email"
                  name="email"
                  id="email"
                  required
                  value={attendee.email}
                  onChange={handleChange}
                  className="py-3 px-4 block w-full shadow-sm focus:ring-blue-500 focus:border-blue-500 border-gray-300 rounded-md"
                />
              </div>
            </div>

            <div className="sm:col-span-2">
              <label htmlFor="department" className="block text-sm font-medium text-gray-700 flex items-center">
                <Building className="h-4 w-4 mr-1 text-blue-600" />
                Departamento/Setor
              </label>
              <div className="mt-1">
                <input
                  type="text"
                  name="department"
                  id="department"
                  required
                  value={attendee.department}
                  onChange={handleChange}
                  className="py-3 px-4 block w-full shadow-sm focus:ring-blue-500 focus:border-blue-500 border-gray-300 rounded-md"
                />
              </div>
            </div>

            <div className="sm:col-span-2">
              <label htmlFor="type" className="block text-sm font-medium text-gray-700 flex items-center">
                <Users className="h-4 w-4 mr-1 text-blue-600" />
                Tipo de Participante
              </label>
              <div className="mt-1">
                <select
                  id="type"
                  name="type"
                  value={attendee.type}
                  onChange={handleChange}
                  className="py-3 px-4 block w-full shadow-sm focus:ring-blue-500 focus:border-blue-500 border-gray-300 rounded-md"
                >
                  <option value="server">Servidor</option>
                  <option value="intern">Estagiário</option>
                  <option value="companion">Acompanhante</option>
                  <option value="child">Criança (4-14 anos)</option>
                </select>
              </div>
            </div>

            {showChildAge && (
              <div className="sm:col-span-2">
                <label htmlFor="childAge" className="block text-sm font-medium text-gray-700">
                  Idade da Criança
                </label>
                <div className="mt-1">
                  <input
                    type="number"
                    name="childAge"
                    id="childAge"
                    min="4"
                    max="14"
                    required={showChildAge}
                    value={attendee.childAge || ''}
                    onChange={handleChange}
                    className="py-3 px-4 block w-full shadow-sm focus:ring-blue-500 focus:border-blue-500 border-gray-300 rounded-md"
                  />
                </div>
              </div>
            )}

            <div className="sm:col-span-2 pt-4">
              <button
                type="submit"
                className="w-full flex justify-center items-center py-3 px-6 border border-transparent rounded-md shadow-sm text-lg font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200"
              >
                <CheckCircle className="h-5 w-5 mr-2" />
                Confirmar Participação
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  );
};

export default RsvpForm;
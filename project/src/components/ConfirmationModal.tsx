import React from 'react';
import { CheckCircle, X } from 'lucide-react';
import { Attendee } from '../types';

interface ConfirmationModalProps {
  attendee: Attendee | null;
  onClose: () => void;
}

const ConfirmationModal: React.FC<ConfirmationModalProps> = ({ attendee, onClose }) => {
  if (!attendee) return null;

  // Calculate the price based on attendee type
  const getPrice = () => {
    switch (attendee.type) {
      case 'server':
      case 'companion':
        return 'R$ 200,00';
      case 'intern':
        return 'R$ 120,00';
      case 'child':
        if (attendee.childAge && attendee.childAge >= 4 && attendee.childAge <= 10) {
          return 'R$ 100,00';
        } else {
          return 'R$ 120,00';
        }
      default:
        return 'R$ 200,00';
    }
  };

  // Get attendee type in Portuguese
  const getTypeInPortuguese = () => {
    switch (attendee.type) {
      case 'server':
        return 'Servidor';
      case 'intern':
        return 'Estagiário';
      case 'companion':
        return 'Acompanhante';
      case 'child':
        return `Criança (${attendee.childAge} anos)`;
      default:
        return '';
    }
  };

  return (
    <div className="fixed inset-0 z-50 overflow-y-auto">
      <div className="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div className="fixed inset-0 transition-opacity" aria-hidden="true">
          <div className="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <span className="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <div 
          className="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6"
          role="dialog"
          aria-modal="true"
          aria-labelledby="modal-headline"
        >
          <div className="absolute top-0 right-0 pt-4 pr-4">
            <button
              type="button"
              className="bg-white rounded-md text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
              onClick={onClose}
            >
              <span className="sr-only">Fechar</span>
              <X className="h-6 w-6" />
            </button>
          </div>

          <div className="sm:flex sm:items-start">
            <div className="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10">
              <CheckCircle className="h-6 w-6 text-green-600" />
            </div>
            <div className="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
              <h3 className="text-lg leading-6 font-medium text-gray-900" id="modal-headline">
                Participação Confirmada!
              </h3>
              <div className="mt-4">
                <div className="bg-gray-50 p-4 rounded-lg">
                  <dl className="space-y-3">
                    <div className="grid grid-cols-3 gap-4">
                      <dt className="text-sm font-medium text-gray-500">Nome:</dt>
                      <dd className="text-sm text-gray-900 col-span-2">{attendee.name}</dd>
                    </div>
                    <div className="grid grid-cols-3 gap-4">
                      <dt className="text-sm font-medium text-gray-500">Email:</dt>
                      <dd className="text-sm text-gray-900 col-span-2">{attendee.email}</dd>
                    </div>
                    <div className="grid grid-cols-3 gap-4">
                      <dt className="text-sm font-medium text-gray-500">Departamento:</dt>
                      <dd className="text-sm text-gray-900 col-span-2">{attendee.department}</dd>
                    </div>
                    <div className="grid grid-cols-3 gap-4">
                      <dt className="text-sm font-medium text-gray-500">Tipo:</dt>
                      <dd className="text-sm text-gray-900 col-span-2">{getTypeInPortuguese()}</dd>
                    </div>
                    <div className="grid grid-cols-3 gap-4">
                      <dt className="text-sm font-medium text-gray-500">Valor:</dt>
                      <dd className="text-sm text-gray-900 font-bold col-span-2">{getPrice()}</dd>
                    </div>
                  </dl>
                </div>
                
                <p className="mt-4 text-sm text-gray-500">
                  Um email com os detalhes da confirmação e instruções para pagamento será enviado em breve para o seu endereço de email.
                </p>
              </div>
            </div>
          </div>
          <div className="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
            <button
              type="button"
              className="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm"
              onClick={onClose}
            >
              Fechar
            </button>
          </div>
        </div>
      </div>
    </div>
  );
};

export default ConfirmationModal;
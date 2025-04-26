import React from 'react';
import { DollarSign, Info, Clock, Calendar } from 'lucide-react';

const EventDetails: React.FC = () => {
  return (
    <section className="py-16 bg-white">
      <div className="max-w-5xl mx-auto px-4 sm:px-6">
        <div className="text-center mb-12">
          <h2 className="text-3xl font-bold text-gray-900">Informações do Evento</h2>
          <p className="mt-4 text-lg text-gray-600">
            É com grande entusiasmo que anunciamos nosso Jantar de Fim de Ano!
          </p>
        </div>

        <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
          <div className="bg-blue-50 rounded-lg p-8 shadow-md hover:shadow-lg transition-shadow duration-300">
            <div className="flex items-center mb-4">
              <DollarSign className="h-6 w-6 text-blue-700 mr-2" />
              <h3 className="text-xl font-semibold text-gray-900">Valores de Participação</h3>
            </div>
            
            <ul className="space-y-3 text-gray-700">
              <li className="flex justify-between">
                <span>Servidores:</span>
                <span className="font-semibold">R$ 200,00</span>
              </li>
              <li className="flex justify-between">
                <span>Estagiários:</span>
                <span className="font-semibold">R$ 120,00</span>
              </li>
              <li className="flex justify-between">
                <span>Acompanhantes:</span>
                <span className="font-semibold">R$ 200,00</span>
              </li>
              <li>
                <span className="font-medium">Crianças:</span>
                <ul className="pl-5 mt-2 space-y-2">
                  <li className="flex justify-between">
                    <span>De 04 a 10 anos:</span>
                    <span className="font-semibold">R$ 100,00</span>
                  </li>
                  <li className="flex justify-between">
                    <span>De 11 a 14 anos:</span>
                    <span className="font-semibold">R$ 120,00</span>
                  </li>
                </ul>
              </li>
            </ul>
          </div>

          <div className="bg-blue-50 rounded-lg p-8 shadow-md hover:shadow-lg transition-shadow duration-300">
            <div className="flex items-center mb-4">
              <Info className="h-6 w-6 text-blue-700 mr-2" />
              <h3 className="text-xl font-semibold text-gray-900">Informações Adicionais</h3>
            </div>
            
            <ul className="space-y-3 text-gray-700">
              <li className="flex items-start">
                <Clock className="h-5 w-5 text-blue-700 mr-2 mt-0.5 flex-shrink-0" />
                <span>Os valores poderão ser parcelados em até 8 vezes, com início dos pagamentos previsto para abril/maio.</span>
              </li>
              <li className="flex items-start">
                <Calendar className="h-5 w-5 text-blue-700 mr-2 mt-0.5 flex-shrink-0" />
                <span>O valor total deve estar quitado até, no máximo, novembro.</span>
              </li>
              <li className="mt-6 p-3 bg-yellow-50 border-l-4 border-yellow-400 rounded">
                <p className="font-medium text-yellow-800">Atenção:</p>
                <p className="text-yellow-700">Solicitamos que todos os servidores manifestem seu interesse em participar o quanto antes, para que possamos organizar o evento da melhor forma possível.</p>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </section>
  );
};

export default EventDetails;
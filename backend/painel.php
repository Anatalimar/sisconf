<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
  header("Location: login.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Painel Administrativo - DETIN</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">
  <div class="max-w-7xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Painel Administrativo - DETIN</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
      <!-- Cards de estatísticas -->
      <div class="bg-white rounded shadow p-4">
        <p class="text-sm text-gray-500">Total de Confirmados</p>
        <p class="text-2xl font-bold" id="totalConfirmados">0</p>
      </div>
      <div class="bg-white rounded shadow p-4">
        <p class="text-sm text-gray-500">Pagamentos Realizados</p>
        <p class="text-2xl font-bold" id="totalPagamentos">R$ 0,00</p>
      </div>
      <div class="bg-white rounded shadow p-4">
        <p class="text-sm text-gray-500">Participantes com Pendências</p>
        <p class="text-2xl font-bold" id="totalPendentes">0</p>
      </div>
    </div>

    <!-- Filtros -->
    <div class="flex flex-col md:flex-row gap-4 mb-4">
      <input type="text" id="filtroNome" placeholder="Buscar por nome..." class="px-4 py-2 border rounded w-full md:w-1/2" oninput="filtrarTabela()">
      <select id="filtroSetor" class="px-4 py-2 border rounded w-full md:w-1/2" onchange="filtrarTabela()">
        <option value="">Todos os setores</option>
      </select>
    </div>

    <!-- Exportação -->
    <button onclick="window.location.href='../backend/exportar_excel.php'" class="mb-4 px-4 py-2 bg-emerald-600 text-white rounded hover:bg-emerald-700">
      Exportar Excel
    </button>

    <!-- Tabela de Pagamentos -->
    <section class="bg-white rounded shadow p-4">
      <h2 class="text-lg font-semibold mb-4">Controle de Pagamentos</h2>
      <div class="overflow-x-auto">
        <table class="min-w-full text-sm text-left border">
          <thead class="bg-gray-100">
            <tr>
              <th class="p-2 border">Colaborador</th>
              <th class="p-2 border">Setor</th>
              <th class="p-2 border">Participa?</th>
              <th class="p-2 border">Acompanhantes</th>
              <th class="p-2 border">Total (R$)</th>
              <th class="p-2 border">Pago (R$)</th>
              <th class="p-2 border">Falta (R$)</th>
              <th class="p-2 border">Ação</th>
            </tr>
          </thead>
          <tbody id="tabelaPagamentos"></tbody>
        </table>
      </div>
    </section>
  </div>

  <!-- Modal Histórico -->
  <div id="modalHistorico" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white p-6 rounded shadow max-w-md w-full">
      <h3 id="modalTitulo" class="text-lg font-bold mb-4">Histórico de Pagamentos</h3>
      <ul id="listaPagamentos" class="space-y-2 text-sm"></ul>
      <button onclick="fecharModal()" class="mt-4 px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Fechar</button>
    </div>
  </div>

  <script>
    let dadosOriginal = [];

    function carregarTabelaPagamentos() {
      fetch('../backend/get_pagamentos.php')
        .then(res => res.json())
        .then(dados => {
          dadosOriginal = dados;
          preencherSetores(dados);
          filtrarTabela();
        });
    }

    function preencherSetores(dados) {
      const setores = [...new Set(dados.map(d => d.setor))];
      const select = document.getElementById('filtroSetor');
      setores.forEach(setor => {
        const opt = document.createElement('option');
        opt.value = setor;
        opt.textContent = setor;
        select.appendChild(opt);
      });
    }

    function filtrarTabela() {
      const nomeFiltro = document.getElementById('filtroNome').value.toLowerCase();
      const setorFiltro = document.getElementById('filtroSetor').value;

      const filtrados = dadosOriginal.filter(item =>
        item.nome.toLowerCase().includes(nomeFiltro) &&
        (setorFiltro === '' || item.setor === setorFiltro)
      );

      const tbody = document.getElementById('tabelaPagamentos');
      tbody.innerHTML = '';

      filtrados.forEach(item => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
          <td class="p-2 border">${item.nome}</td>
          <td class="p-2 border">${item.setor}</td>
          <td class="p-2 border">${item.participa}</td>
          <td class="p-2 border">${item.acompanhantes}</td>
          <td class="p-2 border">R$ ${item.total}</td>
          <td class="p-2 border">R$ ${item.pago}</td>
          <td class="p-2 border">R$ ${item.faltando}</td>
          <td class="p-2 border">
            <button onclick="registrarPagamento(${item.id})" class="bg-green-600 text-white px-2 py-1 rounded text-xs hover:bg-green-700 mr-1">Registrar</button>
            <button onclick="abrirHistorico(${item.id}, '${item.nome}')" class="bg-blue-600 text-white px-2 py-1 rounded text-xs hover:bg-blue-700">Histórico</button>
          </td>
        `;
        tbody.appendChild(tr);
      });
    }

    function registrarPagamento(id) {
      const valor = prompt('Informe o valor recebido (R$):');
      const valorFloat = parseFloat(valor.replace(',', '.'));

      if (isNaN(valorFloat) || valorFloat <= 0) {
        alert('Valor inválido!');
        return;
      }

      fetch('../backend/registrar_pagamento.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({ colaborador_id: id, valor: valorFloat })
      })
        .then(res => res.json())
        .then(() => {
          alert('Pagamento registrado!');
          carregarTabelaPagamentos();
        });
    }

    function abrirHistorico(id, nome) {
      fetch(`../backend/historico_pagamentos.php?id=${id}`)
        .then(res => res.json())
        .then(pagamentos => {
          document.getElementById('modalTitulo').textContent = `Histórico de Pagamentos - ${nome}`;
          const lista = document.getElementById('listaPagamentos');
          lista.innerHTML = pagamentos.length > 0
            ? pagamentos.map(p => `<li>R$ ${p.valor} em ${p.data}</li>`).join('')
            : '<li>Nenhum pagamento registrado.</li>';
          document.getElementById('modalHistorico').classList.remove('hidden');
        });
    }

    function fecharModal() {
      document.getElementById('modalHistorico').classList.add('hidden');
    }

    carregarTabelaPagamentos();
  </script>
</body>
</html>

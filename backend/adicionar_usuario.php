<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Painel Administrativo - SISCONF</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">

  <!-- Navbar -->
  <nav class="bg-blue-900 text-white shadow mb-6">
    <div class="max-w-7xl mx-auto px-4 py-4 flex flex-wrap justify-between items-center">
      <div class="flex gap-4 items-center">
        <h1 class="text-xl font-bold mr-4">SISCONF - DETIN</h1>
        <button onclick="carregarConteudo('inicio')" class="hover:bg-blue-800 px-3 py-2 rounded">Início</button>
        <button onclick="carregarConteudo('../public/get_participe.html')" class="hover:bg-blue-800 px-3 py-2 rounded">Confirmação</button>
        <button onclick="carregarConteudo('admin_parcelas.php')" class="hover:bg-blue-800 px-3 py-2 rounded">Gestão de Parcelas</button>
        <button onclick="carregarConteudo('usuarios.php')" class="hover:bg-blue-800 px-3 py-2 rounded">Gerenciar Usuários</button>
        <button onclick="abrirModalNovoUsuario()" class="hover:bg-green-600 px-4 py-2 rounded text-white bg-green-500">Novo Usuário</button>
      </div>
      <div>
        <a href="logout.php" class="bg-red-600 hover:bg-red-700 px-4 py-2 rounded text-sm">Sair</a>
      </div>
    </div>
  </nav>

  <!-- Conteúdo dinâmico -->
  <div id="conteudoPrincipal" class="max-w-7xl mx-auto p-6">
    <h2 class="text-2xl font-bold mb-6">Painel Administrativo - DETIN</h2>

    <!-- Modal Novo Usuário -->
    <div id="modalNovoUsuario" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
      <div class="bg-white p-6 rounded shadow max-w-md w-full">
        <h3 class="text-lg font-bold mb-4">Adicionar Novo Usuário</h3>
        <form id="formNovoUsuario">
          <div class="mb-4">
            <label for="nomeUsuario" class="block text-sm">Nome Completo</label>
            <input type="text" id="nomeUsuario" class="w-full px-4 py-2 border rounded" required />
          </div>
          <div class="mb-4">
            <label for="emailUsuario" class="block text-sm">Email</label>
            <input type="email" id="emailUsuario" class="w-full px-4 py-2 border rounded" required />
          </div>
          <div class="mb-4">
            <label for="senhaUsuario" class="block text-sm">Senha</label>
            <input type="password" id="senhaUsuario" class="w-full px-4 py-2 border rounded" required />
          </div>
          <div class="mb-4">
            <label for="setorUsuario" class="block text-sm">Setor</label>
            <select id="setorUsuario" class="w-full px-4 py-2 border rounded">
              <option value="admin">Administrador</option>
              <option value="user">Usuário</option>
            </select>
          </div>
          <div class="flex justify-between">
            <button type="button" onclick="fecharModalNovoUsuario()" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Cancelar</button>
            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Salvar</button>
          </div>
        </form>
      </div>
    </div>

    <!-- Restante do conteúdo do painel -->
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

  <script>
    // Função para abrir o modal de Novo Usuário
    function abrirModalNovoUsuario() {
      document.getElementById('modalNovoUsuario').classList.remove('hidden');
    }

    // Função para fechar o modal de Novo Usuário
    function fecharModalNovoUsuario() {
      document.getElementById('modalNovoUsuario').classList.add('hidden');
    }

    // Função para registrar o novo usuário
    document.getElementById('formNovoUsuario').addEventListener('submit', function(event) {
      event.preventDefault();

      const nome = document.getElementById('nomeUsuario').value;
      const email = document.getElementById('emailUsuario').value;
      const senha = document.getElementById('senhaUsuario').value;
      const setor = document.getElementById('setorUsuario').value;

      // Enviar os dados do novo usuário para o servidor
      fetch('../backend/adicionar_usuario.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({ nome, email, senha, setor })
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          alert('Usuário adicionado com sucesso!');
          fecharModalNovoUsuario(); // Fechar o modal
          // Recarregar ou atualizar a tabela de usuários
        } else {
          alert('Erro ao adicionar usuário!');
        }
      })
      .catch(error => {
        console.error('Erro:', error);
        alert('Erro ao processar a solicitação.');
      });
    });

    // Função para carregar a tabela de pagamentos (exemplo)
    function carregarTabelaPagamentos() {
      fetch('../backend/get_pagamentos.php')
        .then(res => res.json())
        .then(dados => {
          const tbody = document.getElementById('tabelaPagamentos');
          tbody.innerHTML = '';
          dados.forEach(item => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
              <td class="p-2 border">${item.nome}</td>
              <td class="p-2 border">${item.setor}</td>
              <td class="p-2 border">${item.participa}</td>
              <td class="p-2 border">${item.acompanhantes}</td>
              <td class="p-2 border">R$ ${item.total}</td>
              <td class="p-2 border">R$ ${item.pago}</td>
              <td class="p-2 border">R$ ${item.faltando}</td>
              <td class="p-2 border"><button class="bg-blue-600 text-white px-2 py-1 rounded">Detalhes</button></td>
            `;
            tbody.appendChild(tr);
          });
        });
    }

    carregarTabelaPagamentos(); // Chama a função ao carregar a página

  </script>
</body>
</html>

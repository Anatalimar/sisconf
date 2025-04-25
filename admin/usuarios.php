<?php
/*
session_start();
if (!isset($_SESSION['admin_id']) || $_SESSION['perfil'] !== 'admin') {
  header("Location: login.php");
  exit;
}
*/
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Gerenciar Usuários</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>
<body class="bg-gray-100 text-gray-800">
  <div class="max-w-5xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Usuários Administrativos</h1>

    <button id="btnNovoUsuario" class="mb-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
      Novo Usuário
    </button>

    <div class="bg-white rounded shadow overflow-x-auto">
      <table class="min-w-full text-sm text-left border">
        <thead class="bg-gray-100">
          <tr>
            <th class="p-2 border">Nome</th>
            <th class="p-2 border">E-mail</th>
            <th class="p-2 border">Perfil</th>
            <th class="p-2 border">Criado em</th>
            <th class="p-2 border">Ação</th>
          </tr>
        </thead>
        <tbody id="listaUsuarios"></tbody>
      </table>
    </div>
  </div>

  <!-- Modal de novo usuário -->
  <div id="modalUsuario" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded shadow max-w-md w-full">
      <h3 id="modalTitulo" class="text-lg font-bold mb-4">Novo Usuário</h3>
      <form id="formUsuario">
        <input type="hidden" id="usuarioId" />

        <label class="block text-sm mb-1">Nome</label>
        <input type="text" id="nome" class="w-full mb-3 px-3 py-2 border rounded" required />

        <label class="block text-sm mb-1">E-mail</label>
        <input type="email" id="email" class="w-full mb-3 px-3 py-2 border rounded" required />

        <label class="block text-sm mb-1">Perfil</label>
        <select id="perfil" class="w-full mb-3 px-3 py-2 border rounded" required>
          <option value="financeiro">Financeiro</option>
          <option value="admin">Administrador</option>
        </select>

        <label class="block text-sm mb-1">Senha</label>
        <input type="password" id="senha" class="w-full mb-3 px-3 py-2 border rounded" placeholder="Deixe em branco para não alterar" />

        <div class="flex justify-between mt-4">
          <button type="button" id="btnCancelar" class="px-4 py-2 bg-gray-400 text-white rounded hover:bg-gray-500">Cancelar</button>
          <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Salvar</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    const lista = document.getElementById('listaUsuarios');
    const modal = document.getElementById('modalUsuario');
    const form = document.getElementById('formUsuario');

    function carregarUsuarios() {
      fetch('../backend/get_usuarios.php')
        .then(res => res.json())
        .then(usuarios => {
          lista.innerHTML = '';
          usuarios.forEach(u => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
              <td class="p-2 border">${u.nome}</td>
              <td class="p-2 border">${u.email}</td>
              <td class="p-2 border">${u.perfil}</td>
              <td class="p-2 border">${u.criado_em}</td>
              <td class="p-2 border">
                <button onclick="editarUsuario(${u.id})" class="bg-blue-600 text-white px-2 py-1 rounded text-xs hover:bg-blue-700 mr-1">Editar</button>
                <button onclick="excluirUsuario(${u.id})" class="bg-red-600 text-white px-2 py-1 rounded text-xs hover:bg-red-700">Excluir</button>
              </td>
            `;
            lista.appendChild(tr);
          });
        });
    }

    function abrirModalNovo() {
      document.getElementById('usuarioId').value = '';
      document.getElementById('nome').value = '';
      document.getElementById('email').value = '';
      document.getElementById('perfil').value = 'financeiro';
      document.getElementById('senha').value = '';
      document.getElementById('modalTitulo').textContent = 'Novo Usuário';
      modal.classList.remove('hidden');
    }

    function fecharModal() {
      modal.classList.add('hidden');
    }

    function editarUsuario(id) {
      console.log(`Editando usuário com ID: ${id}`);
      fetch(`../backend/get_usuario.php?id=${id}`)
        .then(res => {
          if (!res.ok) throw new Error('Erro ao buscar usuário');
          return res.json();
        })
        .then(u => {
          console.log('Dados do usuário recebidos:', u);
          document.getElementById('usuarioId').value = u.id;
          document.getElementById('nome').value = u.nome;
          document.getElementById('email').value = u.email;
          document.getElementById('perfil').value = u.perfil;
          document.getElementById('senha').value = '';
          document.getElementById('modalTitulo').textContent = 'Editar Usuário';
          modal.classList.remove('hidden');
        })
        .catch(err => console.error('Erro ao editar usuário:', err));
    }

    function excluirUsuario(id) {
      Swal.fire({
        title: 'Tem certeza?',
        text: "Você não poderá reverter isso!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Sim, excluir!',
        cancelButtonText: 'Cancelar'
      }).then((result) => {
        if (result.isConfirmed) {
          fetch(`../backend/excluir_usuario.php?id=${id}`)
            .then(res => res.json())
            .then(() => {
              carregarUsuarios();
              Swal.fire(
                'Excluído!',
                'O usuário foi excluído com sucesso.',
                'success'
              );
            })
            .catch(err => {
              console.error('Erro ao excluir usuário:', err);
              Swal.fire(
                'Erro!',
                'Houve um problema ao excluir o usuário.',
                'error'
              );
            });
        }
      });
    }

    form.onsubmit = e => {
      e.preventDefault();

      Swal.fire({
        title: 'Salvar alterações?',
        text: "Deseja salvar as alterações feitas?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#22c55e',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Sim, salvar!',
        cancelButtonText: 'Cancelar'
      }).then((result) => {
        if (result.isConfirmed) {
          const dados = {
            id: document.getElementById('usuarioId').value,
            nome: document.getElementById('nome').value,
            email: document.getElementById('email').value,
            perfil: document.getElementById('perfil').value,
            senha: document.getElementById('senha').value
          };

          fetch('../backend/salvar_usuario.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(dados)
          })
            .then(res => res.json())
            .then(() => {
              fecharModal();
              carregarUsuarios();
              Swal.fire(
                'Salvo!',
                'As alterações foram salvas com sucesso.',
                'success'
              );
            })
            .catch(err => {
              console.error('Erro ao salvar usuário:', err);
              Swal.fire(
                'Erro!',
                'Houve um problema ao salvar as alterações.',
                'error'
              );
            });
        }
      });
    };

    document.getElementById('btnNovoUsuario').addEventListener('click', abrirModalNovo);

    document.getElementById('btnCancelar').addEventListener('click', () => {
      Swal.fire({
        title: 'Cancelar edição?',
        text: "As alterações não salvas serão perdidas.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Sim, cancelar!',
        cancelButtonText: 'Continuar editando'
      }).then((result) => {
        if (result.isConfirmed) {
          fecharModal();
        }
      });
    });

    carregarUsuarios();
  </script>
</body>
</html>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gerenciar Parcelas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="max-w-5xl mx-auto p-6">
        <h1 class="text-2xl font-bold mb-6">Gerenciar Parcelas</h1>

        <button id="btnNovaParcela" class="mb-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            Nova Parcela
        </button>

        <div id="modalParcela" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
            <div class="bg-white p-6 rounded shadow max-w-md w-full">
                <h3 id="modalTitulo" class="text-lg font-bold mb-4">Nova Parcela</h3>
                <form id="formParcela">
                    <input type="hidden" id="parcelaId" />

                    <label class="block text-sm mb-1">Colaborador</label>
                    <input list="listaColaboradores" id="colaboradorInput" class="w-full mb-3 px-3 py-2 border rounded" placeholder="Digite para buscar..." required />
                    <datalist id="listaColaboradores"></datalist>

                    <label class="block text-sm mb-1">Valor da Parcela</label>
                    <div class="flex items-center">
                        <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 rounded-l-md">R$</span>
                        <input type="number" id="valor" step="0.01" class="w-full mb-3 px-3 py-2 border rounded" required>
                    </div>

                    <label class="block text-sm mb-1">Data de Vencimento</label>
                    <input type="date" id="data_vencimento" class="w-full mb-3 px-3 py-2 border rounded" required>

                    <div class="flex justify-between mt-4">
                        <button type="button" id="btnCancelar" class="px-4 py-2 bg-gray-400 text-white rounded hover:bg-gray-500">Cancelar</button>
                        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Salvar</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="bg-white rounded shadow overflow-x-auto">
            <table class="min-w-full text-sm text-left border">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-2 border">Colaborador</th>
                        <th class="p-2 border">Valor</th>
                        <th class="p-2 border">Data de Vencimento</th>
                        <th class="p-2 border">Status</th>
                        <th class="p-2 border">Ações</th>
                    </tr>
                </thead>
                <tbody id="tabelaParcelas"></tbody>
            </table>
        </div>
    </div>

    <script>
        const lista = document.getElementById('tabelaParcelas');
        const modal = document.getElementById('modalParcela');
        const form = document.getElementById('formParcela');
        const datalist = document.getElementById('listaColaboradores');
        const colaboradorInput = document.getElementById('colaboradorInput');

        let colaboradores = [];

        function carregarColaboradores() {
            fetch('../backend/get_colaboradores.php')
                .then(res => res.json())
                .then(data => {
                    colaboradores = data;
                    datalist.innerHTML = '';
                    data.forEach(c => {
                        const option = document.createElement('option');
                        option.value = c.nome;
                        option.setAttribute('data-id', c.id);
                        datalist.appendChild(option);
                    });
                });
        }

        function carregarParcelas() {
            fetch('../backend/get_parcelas.php')
                .then(res => res.json())
                .then(parcelas => {
                    lista.innerHTML = '';
                    parcelas.forEach(p => {
                        const tr = document.createElement('tr');
                        tr.innerHTML = `
                            <td class="p-2 border">${p.nome}</td>
                            <td class="p-2 border">R$ ${p.valor}</td>
                            <td class="p-2 border">${p.data_vencimento}</td>
                            <td class="p-2 border">
                                <span class="inline-block px-2 py-1 rounded text-xs font-semibold leading-tight"
                                    style="background-color: ${p.status === 'pago' ? '#198754' : '#ffc107'}; color: white;">
                                    ${p.status}
                                </span>
                            </td>
                            <td class="p-2 border">
                                <button onclick="editarParcela(${p.id})" class="bg-blue-600 text-white px-2 py-1 rounded text-xs hover:bg-blue-700 mr-1">Editar</button>
                                <button onclick="excluirParcela(${p.id})" class="bg-red-600 text-white px-2 py-1 rounded text-xs hover:bg-red-700">Excluir</button>
                            </td>
                        `;
                        lista.appendChild(tr);
                    });
                });
        }

        function abrirModalNovaParcela() {
            document.getElementById('parcelaId').value = '';
            colaboradorInput.value = '';
            document.getElementById('valor').value = '';
            document.getElementById('data_vencimento').value = '';
            document.getElementById('modalTitulo').textContent = 'Nova Parcela';
            modal.classList.remove('hidden');
        }

        function fecharModal() {
            modal.classList.add('hidden');
        }

        function editarParcela(id) {
            fetch(`../backend/get_parcela.php?id=${id}`)
                .then(res => res.json())
                .then(p => {
                    document.getElementById('parcelaId').value = p.id;
                    colaboradorInput.value = p.nome;
                    document.getElementById('valor').value = p.valor;
                    document.getElementById('data_vencimento').value = p.data_vencimento;
                    document.getElementById('modalTitulo').textContent = 'Editar Parcela';
                    modal.classList.remove('hidden');
                });
        }

        function excluirParcela(id) {
            Swal.fire({
                title: 'Tem certeza?',
                text: "Você não poderá reverter isso!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Sim, excluir!'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`../backend/excluir_parcela.php?id=${id}`)
                        .then(() => {
                            carregarParcelas();
                            Swal.fire('Excluído!', 'A parcela foi excluída com sucesso.', 'success');
                        });
                }
            });
        }

        form.onsubmit = e => {
            e.preventDefault();
            const nome = colaboradorInput.value;
            const colaborador = colaboradores.find(c => c.nome === nome);
            if (!colaborador) {
                Swal.fire('Erro', 'Colaborador não encontrado.', 'error');
                return;
            }

            const dados = {
                id: document.getElementById('parcelaId').value,
                colaborador_id: colaborador.id,
                valor: document.getElementById('valor').value,
                data_vencimento: document.getElementById('data_vencimento').value
            };

            fetch('../backend/salvar_parcela.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(dados)
            })
                .then(() => {
                    fecharModal();
                    carregarParcelas();
                    Swal.fire('Salvo!', 'As alterações foram salvas com sucesso.', 'success');
                })
                .catch(() => {
                    Swal.fire('Erro!', 'Houve um problema ao salvar as alterações.', 'error');
                });
        };

        document.getElementById('btnNovaParcela').addEventListener('click', abrirModalNovaParcela);

        document.getElementById('btnCancelar').addEventListener('click', () => fecharModal());

        carregarColaboradores();
        carregarParcelas();
    </script>
</body>
</html>
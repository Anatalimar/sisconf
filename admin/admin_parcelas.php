<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administração - Parcelas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h2>Gerenciar Parcelas</h2>
        <form id="form-parcela">
            <div class="mb-3">
                <label for="colaborador_id" class="form-label">Colaborador</label>
                <select class="form-control" id="colaborador_id">
                    <!-- Os colaboradores serão preenchidos dinamicamente -->
                </select>
            </div>
            <div class="mb-3">
                <label for="valor" class="form-label">Valor da Parcela</label>
                <input type="number" class="form-control" id="valor" required>
            </div>
            <div class="mb-3">
                <label for="data_vencimento" class="form-label">Data de Vencimento</label>
                <input type="date" class="form-control" id="data_vencimento" required>
            </div>
            <input type="hidden" id="parcela_id"> <!-- Para edição -->
            <button type="submit" class="btn btn-primary">Salvar Parcela</button>
        </form>

        <hr>

        <h3>Parcelas Cadastradas</h3>
        <table class="table table-bordered" id="tabela-parcelas">
            <thead>
                <tr>
                    <th>Colaborador</th>
                    <th>Valor</th>
                    <th>Data de Vencimento</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <!-- Parcelas serão preenchidas dinamicamente -->
            </tbody>
        </table>
    </div>

    <script>
        $(document).ready(function() {
            // Carregar os colaboradores para o select
            $.get('get_colaboradores.php', function(data) {
                let colaboradores = JSON.parse(data);
                colaboradores.forEach(colaborador => {
                    $('#colaborador_id').append(`<option value="${colaborador.id}">${colaborador.nome}</option>`);
                });
            });

            // Carregar as parcelas cadastradas
            function carregarParcelas() {
                $.get('get_parcelas.php', function(data) {
                    let parcelas = JSON.parse(data);
                    $('#tabela-parcelas tbody').empty();
                    parcelas.forEach(parcela => {
                        $('#tabela-parcelas tbody').append(`
                            <tr>
                                <td>${parcela.nome}</td>
                                <td>${parcela.valor}</td>
                                <td>${parcela.data_vencimento}</td>
                                <td>${parcela.status}</td>
                                <td>
                                    <button class="btn btn-warning btn-editar" data-id="${parcela.id}">Editar</button>
                                    <button class="btn btn-danger btn-excluir" data-id="${parcela.id}">Excluir</button>
                                </td>
                            </tr>
                        `);
                    });
                });
            }

            // Função para salvar ou editar a parcela
            $('#form-parcela').submit(function(e) {
                e.preventDefault();

                let id = $('#parcela_id').val();
                let colaborador_id = $('#colaborador_id').val();
                let valor = $('#valor').val();
                let data_vencimento = $('#data_vencimento').val();

                if (id) {
                    // Editar parcela
                    $.post('salvar_parcela.php', {
                        id: id,
                        colaborador_id: colaborador_id,
                        valor: valor,
                        data_vencimento: data_vencimento
                    }, function(response) {
                        alert(response.message);
                        carregarParcelas();
                    });
                } else {
                    // Nova parcela
                    $.post('salvar_parcela.php', {
                        colaborador_id: colaborador_id,
                        valor: valor,
                        data_vencimento: data_vencimento
                    }, function(response) {
                        alert(response.message);
                        carregarParcelas();
                    });
                }

                // Limpar formulário
                $('#form-parcela')[0].reset();
                $('#parcela_id').val('');
            });

            // Editar parcela
            $(document).on('click', '.btn-editar', function() {
                let id = $(this).data('id');

                $.get('get_parcela.php?id=' + id, function(data) {
                    let parcela = JSON.parse(data);
                    $('#colaborador_id').val(parcela.colaborador_id);
                    $('#valor').val(parcela.valor);
                    $('#data_vencimento').val(parcela.data_vencimento);
                    $('#parcela_id').val(parcela.id);
                });
            });

            // Excluir parcela
            $(document).on('click', '.btn-excluir', function() {
                let id = $(this).data('id');

                if (confirm('Tem certeza que deseja excluir esta parcela?')) {
                    $.post('excluir_parcela.php', { id: id }, function(response) {
                        alert(response.message);
                        carregarParcelas();
                    });
                }
            });

            // Carregar parcelas ao iniciar a página
            carregarParcelas();
        });
    </script>
</body>
</html>

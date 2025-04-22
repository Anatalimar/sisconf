<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administração - Pagamentos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h2>Gerenciar Pagamentos</h2>
        <form id="form-pagamento">
            <div class="mb-3">
                <label for="parcela_id" class="form-label">Parcela</label>
                <select class="form-control" id="parcela_id">
                    <!-- As parcelas serão carregadas dinamicamente -->
                </select>
            </div>
            <div class="mb-3">
                <label for="valor_pago" class="form-label">Valor Pago</label>
                <input type="number" class="form-control" id="valor_pago" required>
            </div>
            <div class="mb-3">
                <label for="data_pagamento" class="form-label">Data do Pagamento</label>
                <input type="date" class="form-control" id="data_pagamento" required>
            </div>
            <button type="submit" class="btn btn-success">Registrar Pagamento</button>
        </form>

        <hr>

        <h3>Pagamentos Realizados</h3>
        <table class="table table-bordered" id="tabela-pagamentos">
            <thead>
                <tr>
                    <th>Colaborador</th>
                    <th>Valor Pago</th>
                    <th>Data de Pagamento</th>
                </tr>
            </thead>
            <tbody>
                <!-- Pagamentos serão carregados dinamicamente -->
            </tbody>
        </table>
    </div>

    <script>
        $(document).ready(function() {
            // Carregar as parcelas para selecionar no pagamento
            $.get('get_parcelas.php', function(data) {
                let parcelas = JSON.parse(data);
                parcelas.forEach(parcela => {
                    $('#parcela_id').append(`<option value="${parcela.id}">${parcela.valor} - ${parcela.data_vencimento}</option>`);
                });
            });

            // Salvar pagamento
            $('#form-pagamento').submit(function(e) {
                e.preventDefault();

                let parcela_id = $('#parcela_id').val();
                let valor_pago = $('#valor_pago').val();
                let data_pagamento = $('#data_pagamento').val();

                $.post('salvar_pagamento.php', {
                    parcela_id: parcela_id,
                    valor_pago: valor_pago,
                    data_pagamento: data_pagamento
                }, function(response) {
                    alert(response.message);
                    carregarPagamentos();
                });

                // Limpar formulário
                $('#form-pagamento')[0].reset();
            });

            // Carregar pagamentos
            function carregarPagamentos() {
                $.get('get_pagamentos.php', function(data) {
                    let pagamentos = JSON.parse(data);
                    $('#tabela-pagamentos tbody').empty();
                    pagamentos.forEach(pagamento => {
                        $('#tabela-pagamentos tbody').append(`
                            <tr>
                                <td>${pagamento.colaborador_nome}</td>
                                <td>${pagamento.valor_pago}</td>
                                <td>${pagamento.data_pagamento}</td>
                            </tr>
                        `);
                    });
                });
            }

            // Carregar pagamentos ao iniciar a página
            carregarPagamentos();
        });
    </script>
</body>
</html>

<div class="card">
    <div class="card-header">
        <h2 class="card-title">Gerenciamento de Pagamentos</h2>
        <button class="btn btn-primary">
            <i class="fas fa-plus"></i> Novo Pagamento
        </button>
    </div>
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="mes">Mês</label>
                    <select id="mes" class="form-control">
                        <option value="">Todos</option>
                        <option value="1">Janeiro</option>
                        <option value="2">Fevereiro</option>
                        <!-- outros meses -->
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="ano">Ano</label>
                    <select id="ano" class="form-control">
                        <option value="2023">2023</option>
                        <option value="2022">2022</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="status">Status</label>
                    <select id="status" class="form-control">
                        <option value="">Todos</option>
                        <option value="pago">Pago</option>
                        <option value="pendente">Pendente</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <button class="btn btn-primary" style="margin-top: 25px;">
                    <i class="fas fa-filter"></i> Filtrar
                </button>
            </div>
        </div>
        
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Colaborador</th>
                    <th>Valor</th>
                    <th>Data</th>
                    <th>Método</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>#1001</td>
                    <td>Carlos Oliveira</td>
                    <td>R$ 5,000.00</td>
                    <td>05/05/2023</td>
                    <td>Transferência</td>
                    <td><span class="badge bg-success">Pago</span></td>
                    <td>
                        <button class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></button>
                        <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
                <tr>
                    <td>#1002</td>
                    <td>Ana Paula</td>
                    <td>R$ 3,500.00</td>
                    <td>05/05/2023</td>
                    <td>Transferência</td>
                    <td><span class="badge bg-success">Pago</span></td>
                    <td>
                        <button class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></button>
                        <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
                <tr>
                    <td>#1003</td>
                    <td>Roberto Santos</td>
                    <td>R$ 4,200.00</td>
                    <td>05/05/2023</td>
                    <td>Transferência</td>
                    <td><span class="badge bg-warning">Pendente</span></td>
                    <td>
                        <button class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></button>
                        <button class="btn btn-sm btn-success"><i class="fas fa-check"></i> Pagar</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
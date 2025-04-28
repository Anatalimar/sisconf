<div class="card">
    <div class="card-header">
        <h2 class="card-title">Relatório de Usuários</h2>
        <div>
            <button class="btn btn-primary">
                <i class="fas fa-download"></i> Exportar PDF
            </button>
            <button class="btn btn-success">
                <i class="fas fa-file-excel"></i> Exportar Excel
            </button>
        </div>
    </div>
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="dataInicio">Data Início</label>
                    <input type="date" id="dataInicio" class="form-control">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="dataFim">Data Fim</label>
                    <input type="date" id="dataFim" class="form-control">
                </div>
            </div>
            <div class="col-md-4">
                <button class="btn btn-primary" style="margin-top: 25px;">
                    <i class="fas fa-filter"></i> Gerar Relatório
                </button>
            </div>
        </div>
        
        <div class="chart-container">
            <canvas id="usuariosChart"></canvas>
        </div>
        
        <table class="table mt-4">
            <thead>
                <tr>
                    <th>Perfil</th>
                    <th>Quantidade</th>
                    <th>Percentual</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Administrador</td>
                    <td>5</td>
                    <td>10%</td>
                </tr>
                <tr>
                    <td>Gerente</td>
                    <td>15</td>
                    <td>30%</td>
                </tr>
                <tr>
                    <td>Usuário</td>
                    <td>30</td>
                    <td>60%</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('usuariosChart').getContext('2d');
    const usuariosChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Administrador', 'Gerente', 'Usuário'],
            datasets: [{
                data: [5, 15, 30],
                backgroundColor: [
                    '#007bff',
                    '#28a745',
                    '#6c757d'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Distribuição de Usuários por Perfil'
                }
            }
        }
    });
});
</script>
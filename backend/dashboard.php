<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Dashboard - Confraternização DETIN</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <style>
    .card { box-shadow: 0 0 10px rgba(0,0,0,0.1); margin-bottom: 1rem; }
    canvas { max-height: 300px; }
  </style>
</head>
<body class="bg-light">
  <div class="container py-4">
    <h2 class="mb-4 text-center">Painel de Estatísticas - Confraternização DETIN</h2>

    <div class="row text-center">
      <div class="col-md-3">
        <div class="card p-3">
          <h6>Total de Colaboradores</h6>
          <h3 id="total_colaboradores">0</h3>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card p-3">
          <h6>Confirmados</h6>
          <h3 id="confirmados">0</h3>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card p-3">
          <h6>Acompanhantes</h6>
          <h3 id="acompanhantes">0</h3>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card p-3">
          <h6>Total Geral</h6>
          <h3 id="total_geral">0</h3>
        </div>
      </div>
    </div>

    <div class="row text-center">
      <div class="col-md-6">
        <div class="card p-3">
          <h6>Total Arrecadado</h6>
          <h3 id="valor_total">R$ 0,00</h3>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card p-3">
          <h6>Participantes por Setor</h6>
          <canvas id="graficoSetores"></canvas>
        </div>
      </div>
    </div>
  </div>

  <script>
    fetch('dashboard_dados.php')
      .then(res => res.json())
      .then(dados => {
        document.getElementById('total_colaboradores').textContent = dados.total_colaboradores;
        document.getElementById('confirmados').textContent = dados.confirmados;
        document.getElementById('acompanhantes').textContent = dados.acompanhantes;
        document.getElementById('total_geral').textContent = dados.total_geral;
        document.getElementById('valor_total').textContent = 'R$ ' + dados.valor_total;

        const setores = dados.setores.map(s => s.setor);
        const totais = dados.setores.map(s => s.total);

        new Chart(document.getElementById('graficoSetores'), {
          type: 'bar',
          data: {
            labels: setores,
            datasets: [{
              label: 'Confirmados por Setor',
              data: totais,
              backgroundColor: 'rgba(54, 162, 235, 0.7)'
            }]
          },
          options: {
            responsive: true,
            plugins: {
              legend: { display: false },
              tooltip: { mode: 'index', intersect: false }
            },
            scales: {
              y: { beginAtZero: true }
            }
          }
        });
      });
  </script>
</body>
</html>

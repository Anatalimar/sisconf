<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>SISCONF - Sistema de Confraternização DETIN</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f5f5f5;
    }
    .nav-link {
      font-weight: 500;
    }
    .card-hover:hover {
      transform: scale(1.02);
      transition: all 0.3s ease;
      cursor: pointer;
    }
  </style>
</head>
<body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
      <a class="navbar-brand" href="#">SISCONF - DETIN</a>
    </div>
  </nav>

  <div class="container mt-5">
    <h2 class="text-center mb-4">Bem-vindo ao Sistema de Confraternização do DETIN</h2>

    <div class="row justify-content-center mb-4">
      <div class="col-md-6">
        <div class="card card-hover h-100" onclick="location.href='public/get_participe.html'">
          <div class="card-body text-center">
            <h5 class="card-title">Confirmação de Participação</h5>
            <p class="card-text">Informe se irá participar da confraternização e adicione acompanhantes.</p>
          </div>
        </div>
      </div>
    </div>

    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card card-hover h-100" onclick="location.href='admin/login.php'">
          <div class="card-body text-center">
            <h5 class="card-title">Painel Administrativo</h5>
            <p class="card-text">Área exclusiva para administração, controle de pagamentos e usuários.</p>
          </div>
        </div>
      </div>
    </div>

  </div>

  <footer class="text-center mt-5 mb-3 text-muted">
    &copy; <?= date('Y') ?> DETIN - SEDUC-AM
  </footer>

</body>
</html>

<?php require '../backend/protect.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Painel Administrativo</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800 p-6">
  <div class="max-w-6xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">Painel Administrativo - Confraternização DETIN</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
      <div class="bg-white p-4 rounded shadow">
        <h2 class="font-semibold text-lg mb-2">Participantes</h2>
        <!-- Total de participantes confirmados -->
        <p><strong>Total confirmados:</strong> <span id="totalParticipantes">...</span></p>
        <p><strong>Total acompanhantes:</strong> <span id="totalAcompanhantes">...</span></p>
      </div>

      <div class="bg-white p-4 rounded shadow">
        <h2 class="font-semibold text-lg mb-2">Pagamentos</h2>
        <p><strong>Total arrecadado:</strong> R$ <span id="totalPago">...</span></p>
        <p><strong>Faltando pagar:</strong> R$ <span id="totalFaltando">...</span></p>
      </div>
    </div>

    <a href="../backend/logout.php" class="text-blue-600 underline">Sair</a>
  </div>

  <script>
    // Aqui podemos buscar estatísticas no futuro com PHP
  </script>
</body>
</html>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Login - Administração</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
  <div class="bg-white p-6 rounded-xl shadow-md w-full max-w-md">
    <h2 class="text-2xl font-bold text-center mb-6">Acesso Administrativo</h2>
    <form id="loginForm" class="space-y-4">
      <div>
        <label>Email</label>
        <input type="email" id="email" required class="w-full px-4 py-2 border rounded">
      </div>
      <div>
        <label>Senha</label>
        <input type="password" id="senha" required class="w-full px-4 py-2 border rounded">
      </div>
      <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
        Entrar
      </button>
    </form>
    <p id="erro" class="text-red-600 text-sm mt-4 text-center hidden">Credenciais inválidas</p>
  </div>

  <script>
    document.getElementById('loginForm').addEventListener('submit', function (e) {
      e.preventDefault();

      const email = document.getElementById('email').value;
      const senha = document.getElementById('senha').value;

      fetch('../backend/admin_login.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({ email, senha })
      })
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          window.location.href = 'painel.php';
        } else {
          document.getElementById('erro').classList.remove('hidden');
        }
      });
    });
  </script>
</body>
</html>

<?php
session_start();

// Verifica se o usuário já está logado
if (isset($_SESSION['usuario_logado'])) {
    header('Location: index.php');
    exit();
}

// Simulação de autenticação (em um sistema real, isso seria conectado a um banco de dados)
$usuarios = [
    'admin' => [
        'senha' => 'admin123', // Em produção, use senhas criptografadas
        'nome' => 'Administrador',
        'email' => 'admin@sisconf.com',
        'perfil' => 'administrador'
    ],
    'usuario' => [
        'senha' => 'user123',
        'nome' => 'Usuário Padrão',
        'email' => 'usuario@empresa.com',
        'perfil' => 'usuario'
    ]
];

// Processa o formulário de login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    // Validação básica
    if (empty($username) || empty($password)) {
        $erro = 'Por favor, preencha todos os campos';
    } elseif (!isset($usuarios[$username]) || $usuarios[$username]['senha'] !== $password) {
        $erro = 'Usuário ou senha incorretos';
    } else {
        // Login bem-sucedido
        $_SESSION['usuario_logado'] = true;
        $_SESSION['usuario_nome'] = $usuarios[$username]['nome'];
        $_SESSION['usuario_email'] = $usuarios[$username]['email'];
        $_SESSION['usuario_perfil'] = $usuarios[$username]['perfil'];
        
        header('Location: index.php');
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISCONF - Login</title>
    <link rel="stylesheet" href="assistentes/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        /* Estilos específicos para a página de login */
        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f5f7fa;
            background-image: linear-gradient(135deg, #007bff 0%, #00b4d8 100%);
        }
        
        .login-box {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            padding: 40px;
            text-align: center;
            animation: fadeIn 0.5s ease-out;
        }
        
        .login-logo {
            margin-bottom: 30px;

        }
        
        .login-logo img {
            max-width: 100%;
            height: auto;
        }
        
        .login-title {
            font-size: 1.5rem;
            color: #007bff;
            margin-bottom: 30px;
            font-weight: 600;
        }
        
        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #495057;
        }
        
        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
            outline: none;
        }
        
        .btn-login {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
        }
        
        .btn-login:hover {
            background-color: #0069d9;
        }
        
        .login-footer {
            margin-top: 20px;
            font-size: 0.9rem;
            color: #6c757d;
        }
        
        .login-footer a {
            color: #007bff;
            text-decoration: none;
        }
        
        .login-footer a:hover {
            text-decoration: underline;
        }
        
        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            padding: 12px;
            border-radius: 4px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .alert-error i {
            margin-right: 10px;
        }
        
        .password-container {
            position: relative;
        }
        
        .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #6c757d;
        }
        
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <div class="login-logo">
                <img src="imagens/logo.png" alt="SISCONF Logo">
            </div>
            
            <h1 class="login-title">Acessar o Sistema</h1>
            
            <?php if (isset($erro)): ?>
                <div class="alert-error">
                    <i class="fas fa-exclamation-circle"></i>
                    <?php echo htmlspecialchars($erro); ?>
                </div>
            <?php endif; ?>
            
            <form method="POST" action="login.php">
                <div class="form-group">
                    <label for="username">Usuário</label>
                    <input type="text" id="username" name="username" class="form-control" required autofocus>
                </div>
                
                <div class="form-group">
                    <label for="password">Senha</label>
                    <div class="password-container">
                        <input type="password" id="password" name="password" class="form-control" required>
                        <i class="fas fa-eye toggle-password" onclick="togglePassword()"></i>
                    </div>
                </div>
                
                <button type="submit" class="btn-login">
                    <i class="fas fa-sign-in-alt"></i> Entrar
                </button>
            </form>
            
            <div class="login-footer">
                <p>Problemas para acessar? <a href="#">Contate o administrador</a></p>
            </div>
        </div>
    </div>

    <script>
        // Alternar visibilidade da senha
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const icon = document.querySelector('.toggle-password');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
        
        // Adicionar efeito de foco nos inputs
        document.querySelectorAll('.form-control').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentNode.querySelector('label').style.color = '#007bff';
            });
            
            input.addEventListener('blur', function() {
                this.parentNode.querySelector('label').style.color = '#495057';
            });
        });
    </script>
</body>
</html>
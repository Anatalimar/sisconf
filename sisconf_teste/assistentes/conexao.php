<?php
/**
 * Arquivo de conexão com o banco de dados
 * 
 * Configurações para conexão com MySQL/MariaDB
 */

$host = 'localhost';
$dbname = 'sisconf';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erro na conexão com o banco de dados: " . $e->getMessage());
}

// Dados de sessão simulados para demonstração
session_start();
if (!isset($_SESSION['usuario'])) {
    $_SESSION['usuario'] = [
        'id' => 1,
        'nome' => 'Administrador',
        'email' => 'admin@sisconf.com',
        'perfil' => 'Administrador'
    ];
}
?>
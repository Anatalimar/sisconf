<?php
$host = "localhost";
$db = "sisconf";
$user = "root";
$pass = "";

// Conectar ao banco
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Verificar se o arquivo foi enviado
if (isset($_FILES['arquivo']['tmp_name'])) {
    $arquivo = fopen($_FILES['arquivo']['tmp_name'], 'r');

    // Ignorar cabeçalho
    fgetcsv($arquivo);

    while (($linha = fgetcsv($arquivo, 1000, ";")) !== FALSE) {
        $nome = $conn->real_escape_string($linha[0]);
        $setor = $conn->real_escape_string($linha[1]);
        $contra = $conn->real_escape_string($linha[2]);

        $sql = "INSERT INTO colaboradores (nome, setor, contratacao) VALUES ('$nome', '$setor', '$contra' )";
        $conn->query($sql);
    }

    fclose($arquivo);
    echo "Importação concluída com sucesso!";
} else {
    echo "Nenhum arquivo enviado.";
}
?>

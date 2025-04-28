<?php
require 'db.php';

// Carrega o PHPMailer manualmente
require '../src/PHPMailer.php';
require '../src/SMTP.php';
require '../src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

header('Content-Type: application/json');

try {
    // Verificar método HTTP
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception("Método não permitido. Use POST.", 405);
    }

    // Campos obrigatórios
    $requiredFields = ['col_id', 'type', 'email'];
    foreach ($requiredFields as $field) {
        if (empty($_POST[$field])) {
            throw new Exception("Campo obrigatório faltando: $field", 400);
        }
    }

    // Sanitização dos dados
    $colaborador_id = (int)$_POST['col_id'];
    $vai_participar = $_POST['type'] === 'sim' ? 1 : 0;
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new Exception("E-mail inválido", 400);
    }
    
    // Valores padrão para acompanhantes
    $acompanhante18 = isset($_POST['acompAdulto']) ? (int)$_POST['acompAdulto'] : 0;
    $acompanhante17a11 = isset($_POST['acomp11a17']) ? (int)$_POST['acomp11a17'] : 0;
    $acompanhante10a04 = isset($_POST['acomp04a10']) ? (int)$_POST['acomp04a10'] : 0;

    // Cálculo do valor
    $valor_pagar = 0.00;
    
    if ($vai_participar) {
        // Obter tipo de contratação do colaborador
        $stmt = $conn->prepare("SELECT contratacao FROM colaboradores WHERE id = ?");
        $stmt->execute([$colaborador_id]);
        $colaborador = $stmt->fetch();
        
        if (!$colaborador) {
            throw new Exception("Colaborador não encontrado", 404);
        }

        $contratacao = $colaborador['contratacao'];
        
        // Calcular valor base
        $price = 200.00; // padrão
        if ($contratacao === 'estagiario') {
            $price = 120.00;
        } elseif ($contratacao === 'terceirizado') {
            $price = 200.00;
        }
        
        $valor_pagar = $price + 
                     ($acompanhante18 * 200.00) + 
                     ($acompanhante17a11 * 120.00) + 
                     ($acompanhante10a04 * 100.00);
    }

    // Transação para garantir integridade
    $conn->beginTransaction();

    try {
        // Verificar se já existe uma confirmação
        $stmtCheck = $conn->prepare("SELECT id FROM confirmacoes WHERE colaborador_id = ?");
        $stmtCheck->execute([$colaborador_id]);
        $existeConfirmacao = $stmtCheck->fetch();

        if ($existeConfirmacao) {
            // Atualizar confirmação existente
            $stmt = $conn->prepare("UPDATE confirmacoes SET
                vai_participar = ?,
                acompanhante18 = ?,
                acompanhante17a11 = ?,
                acompanhante10a04 = ?,
                valor_pagar = ?,
                data_confirmacao = NOW()
                WHERE colaborador_id = ?");
            
            $stmt->execute([ 
                $vai_participar,
                $acompanhante18,
                $acompanhante17a11,
                $acompanhante10a04,
                $valor_pagar,
                $colaborador_id
            ]);
        } else {
            // Inserir nova confirmação
            $stmt = $conn->prepare("INSERT INTO confirmacoes (
                colaborador_id,
                vai_participar,
                acompanhante18,
                acompanhante17a11,
                acompanhante10a04,
                valor_pagar,
                data_confirmacao
            ) VALUES (?, ?, ?, ?, ?, ?, NOW())");
            
            $stmt->execute([ 
                $colaborador_id,
                $vai_participar,
                $acompanhante18,
                $acompanhante17a11,
                $acompanhante10a04,
                $valor_pagar
            ]);
        }
        
        $conn->commit();
        
        // Preparar conteúdo HTML do e-mail
        $assunto = "Confirmação de Participação no Evento";
        $mensagem = "
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; color: #333; }
                h2 { color: #5c8ca0; }
                .detalhes { background-color: #f9f9f9; padding: 10px; border: 1px solid #ddd; }
                .detalhes p { margin: 5px 0; }
                .valor { font-weight: bold; color: #007bff; }
            </style>
        </head>
        <body>
            <h2>Olá!</h2>
            <p>Confirmamos que sua participação no evento foi registrada com sucesso.</p>
            <div class='detalhes'>
                <h3>Detalhes da Confirmação:</h3>
                <p><strong>Vai participar:</strong> " . ($vai_participar ? "Sim" : "Não") . "</p>
                <p><strong>Acompanhantes maiores de 18 anos:</strong> $acompanhante18</p>
                <p><strong>Acompanhantes de 11 a 17 anos:</strong> $acompanhante17a11</p>
                <p><strong>Acompanhantes de 4 a 10 anos:</strong> $acompanhante10a04</p>
                <p><strong>Valor a pagar:</strong> <span class='valor'>R$ " . number_format($valor_pagar, 2, ',', '.') . "</span></p>
            </div>
            <p>Qualquer dúvida, entre em contato.</p>
            <p>Atenciosamente,</p>
            <p><strong>Comissão Organizadora</strong></p>
        </body>
        </html>";

        $mail = new PHPMailer(true);

        try {
            $mail->CharSet = 'Utf-8';
            $mail->Encoding = 'base64';
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // seu servidor SMTP
            $mail->SMTPAuth = true;
            $mail->Username = 'confra2025@educacao.am.gov.br'; // seu e-mail
            $mail->Password = 'chic ibed rkvn azf'; // sua senha ou app password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;

            $mail->setFrom('confra2025@educacao.am.gov.br', 'Confra 2025 - Detin');
            $mail->addAddress($email);
            //$mail->addReplyTo('seu_emai', 'seu nome');

            $mail->isHTML(true); // Definir o corpo como HTML
            $mail->Subject = $assunto;
            $mail->Body    = $mensagem;

            $mail->send();

        } catch (Exception $e) {
            throw new Exception("Erro ao enviar e-mail: {$mail->ErrorInfo}", 500);
        }
        
        // Resposta de sucesso
        echo json_encode([
            'success' => true,
            'message' => 'Confirmação registrada com sucesso',
            'valor_pagar' => $valor_pagar,
            'colaborador_id' => $colaborador_id
        ]);
        
    } catch (PDOException $e) {
        $conn->rollBack();
        throw new Exception("Erro no banco de dados: " . $e->getMessage(), 500);
    }

} catch (Exception $e) {
    http_response_code($e->getCode() ?: 500);
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage(),
        'code' => $e->getCode() ?: 500
    ]);
}
?>

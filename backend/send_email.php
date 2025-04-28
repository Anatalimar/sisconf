<?php
// Incluir o PHPMailer manualmente
require 'libs/PHPMailer/PHPMailer.php';
require 'libs/PHPMailer/SMTP.php';
require 'libs/PHPMailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Dados do formulário
    $attendee = $_POST['attendee'];
    $price = $_POST['price'];

    // Configurações do PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Configurações do servidor de e-mail
        $mail->isSMTP();                                         // Defina o envio via SMTP
        $mail->Host = 'smtp.seudominio.com';                     // Defina o servidor SMTP
        $mail->SMTPAuth = true;                                  // Ativar autenticação SMTP
        $mail->Username = 'seuemail@dominio.com';                // Seu e-mail
        $mail->Password = 'sua_senha';                           // Sua senha de e-mail
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;       // Ativar criptografia TLS
        $mail->Port = 587;                                       // Definir a porta do SMTP

        // Remetente e destinatário
        $mail->setFrom('seuemail@dominio.com', 'Festa de Fim de Ano');
        $mail->addAddress($attendee['email'], $attendee['nome']); // Endereço do participante

        // Conteúdo do e-mail
        $mail->isHTML(true);
        $mail->Subject = 'Confirmação de Participação - Festa de Fim de Ano';
        $mail->Body    = "<h2>Confirmação de Participação</h2>
                          <p>Olá, {$attendee['nome']}!</p>
                          <p>Obrigado por confirmar sua participação na nossa Festa de Fim de Ano!</p>
                          <p><strong>Detalhes:</strong></p>
                          <ul>
                            <li><strong>Setor:</strong> {$attendee['setor']}</li>
                            <li><strong>Email:</strong> {$attendee['email']}</li>
                            <li><strong>Tipo de Participante:</strong> {$attendee['contratacao']}</li>
                            <li><strong>Valor Total:</strong> R$ {$price}</li>
                          </ul>
                          <p>Em breve, enviaremos mais informações sobre o evento e o pagamento.</p>
                          <p>Atenciosamente, <br> Comissão Organizadora - Festa de Fim de Ano</p>";

        // Enviar e-mail
        $mail->send();
        echo json_encode(['success' => true, 'message' => 'E-mail enviado com sucesso!']);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => "Erro ao enviar e-mail. Erro: {$mail->ErrorInfo}"]);
    }
}
?>

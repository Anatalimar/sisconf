<?php
session_start();
require 'backend/db.php';

// Carregar setores do banco de dados
try {
    $stmt = $conn->query("SELECT DISTINCT setor FROM colaboradores WHERE setor IS NOT NULL ORDER BY setor");
    $setores = $stmt->fetchAll(PDO::FETCH_COLUMN);
} catch (PDOException $e) {
    $setores = [];
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $attendee = [
        'setor' => htmlspecialchars($_POST['setor'] ?? ''),
        'nome' => htmlspecialchars($_POST['nome'] ?? ''),
        'colaborador_id' => htmlspecialchars($_POST['col_id'] ?? ''),
        'email' => filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL),
        'contratacao' => htmlspecialchars($_POST['contratacao'] ?? ''),
        'vai_participar' => $_POST['type'] ?? '',
        'acompAdulto' => isset($_POST['acompAdulto']) ? (int)$_POST['acompAdulto'] : 0,
        'acomp11a17' => isset($_POST['acomp11a17']) ? (int)$_POST['acomp11a17'] : 0,
        'acomp04a10' => isset($_POST['acomp04a10']) ? (int)$_POST['acomp04a10'] : 0
    ];

    if (empty($attendee['setor']) || empty($attendee['nome']) || empty($attendee['email'])) {
        echo json_encode(['success' => false, 'message' => 'Campos obrigatórios não preenchidos']);
        exit;
    }

    $totalPrice = 0.00;
    if ($attendee['type'] === 'sim') {
        $price = 200.00;
        if ($attendee['contratacao'] === 'estagiario') {
            $price = 120.00;
        } elseif ($attendee['contratacao'] === 'terceirizado') {
            $price = 200.00;
        }

        $totalPrice = $price;
        $totalPrice += $attendee['acompAdulto'] * 200.00;
        $totalPrice += $attendee['acomp11a17'] * 120.00;
        $totalPrice += $attendee['acomp04a10'] * 100.00;
    }

    $_SESSION['confirmation'] = [
        'attendee' => $attendee,
        'price' => $totalPrice
    ];

    try {
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'attendee' => $attendee, 'price' => $totalPrice]);
            exit;
        }
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Erro no processamento do formulário: ' . $e->getMessage()]);
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confraternização - 2025 - DETIN</title>
    <meta name="description" content="Confraternização - 2025 - Departamento de Tecnologia da Informação. Confirme sua participação!">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="backend/styles.css" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="backend/script.js" defer></script>
</head>
<body>
    <!-- Header Section -->
    <header class="header">
        <div class="header-overlay"></div>
        <div class="header-background">
            <img src="imagem/foto_01.jpeg" alt="Imagem 1" class="background-slide active">
            <img src="imagem/foto_02.jpeg" alt="Imagem 2" class="background-slide">
            <img src="imagem/foto_03.png" alt="Imagem 3" class="background-slide">
        </div>
        <div class="header-content">
            <div class="header-icon animate-bounce">
                <i data-lucide="party-popper" class="icon-yellow"></i>
            </div>
            <h1>
                <span>Festa de Fim de Ano</span>
                <span class="text-yellow">Departamento de Tecnologia da Informação - DETIN</span>
                <span class="year">2025</span>
            </h1>
            <div class="header-details">
                <div class="detail-item">
                    <i data-lucide="calendar-days" class="icon-yellow"></i>
                    <span>27 de Dezembro (Sábado)</span>
                </div>
                <div class="detail-item">
                    <i data-lucide="map-pin" class="icon-yellow"></i>
                    <a href="https://maps.app.goo.gl/o88N5qYGkDvGh8uv7" target="_blank" style="text-decoration: none; color: inherit;">Vidas Buffet</a>
                </div>
            </div>
        </div>
    </header>

    <!-- Event Details Section -->
    <section class="event-details">
        <div class="container">
            <div class="section-header">
                <h2>Informações do Evento</h2>
                <p>É com grande entusiasmo que anunciamos nosso Jantar Dançante de Fim de Ano!</p>
            </div>

            <div class="info-grid">
                <div class="info-card">
                    <div class="card-header">
                        <i data-lucide="dollar-sign" class="icon-blue"></i>
                        <h3>Valores de Participação</h3>
                    </div>
                    <ul class="price-list">
                        <li><span>Servidores:</span><span>R$ 200,00</span></li>
                        <li><span>Tercerizado:</span><span>R$ 200,00</span></li>
                        <li><span>Estagiários:</span><span>R$ 120,00</span></li>
                        <li><span>Acompanhante Adulto:</span><span>R$ 200,00</span></li>
                        <li class="children-prices">
                            <span>Crianças:</span>
                            <ul>
                                <li><span>De 04 a 10 anos:</span><span>R$ 100,00</span></li>
                                <li><span>De 11 a 17 anos:</span><span>R$ 120,00</span></li>
                            </ul>
                        </li>
                    </ul>
                </div>

                <div class="info-card">
                    <div class="card-header">
                        <i data-lucide="info" class="icon-blue"></i>
                        <h3>Informações Adicionais</h3>
                    </div>
                    <ul class="info-list">
                        <li>
                            <i data-lucide="clock" class="icon-blue"></i>
                            <span>Os valores poderão ser parcelados em até 8 vezes, com início dos pagamentos previsto para abril/maio.</span>
                        </li>
                        <li>
                            <i data-lucide="calendar" class="icon-blue"></i>
                            <span>O valor total deve estar quitado até, no máximo, novembro.</span>
                        </li>
                        <li class="attention-note">
                            <p class="note-title">Atenção:</p>
                            <p>Solicitamos que todos os servidores manifestem seu interesse em participar o quanto antes, para que possamos organizar o evento da melhor forma possível.</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- RSVP Form Section -->
    <section class="rsvp-section">
        <div class="container">
            <div class="section-header">
                <h2>Confirme sua Participação</h2>
                <p>Preencha o formulário abaixo para confirmar sua presença em nossa celebração.</p>
            </div>

            <form id="rsvpForm" class="rsvp-form" method="POST">
                <div class="form-grid">
                    <div class="form-group full-width">
                        <label for="setor">
                            <i data-lucide="building" class="icon-blue"></i>
                            Setor
                        </label>
                        <select id="setor" name="setor" required>
                            <option value="">Selecione seu setor</option>
                            <?php foreach ($setores as $setor): ?>
                                <option value="<?= htmlspecialchars($setor) ?>"><?= htmlspecialchars($setor) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group full-width">
                        <label for="nome">
                            <i data-lucide="user" class="icon-blue"></i>
                            Nome Completo
                        </label>
                        <select id="nome" name="nome" required>
                            <option value="">Selecione um colaborador</option>
                        </select>
                        <input type="hidden" id="col_id" name="col_id" readonly required>
                    </div>

                    <div class="form-group full-width">
                        <label for="email">
                            <i data-lucide="mail" class="icon-blue"></i>
                            E-mail
                        </label>
                        <input type="email" id="email" name="email" required>
                    </div>

                    <div class="form-group full-width">
                        <label for="contratacao">
                            <i data-lucide="clipboard-pen-line" class="icon-blue"></i>
                            Tipo de participante
                        </label>
                        <input type="text" id="contratacao" name="contratacao" readonly required>
                    </div>

                    <div class="form-group full-width">
                        <label for="type">
                            <i data-lucide="users" class="icon-blue"></i>
                            Você irá participar?
                        </label>
                        <select id="type" name="type" required>
                            <option value="nao">Não</option>
                            <option value="sim">Sim</option>
                        </select>
                    </div>

                    <div class="form-group full-width hidden" id="companionCountGroup">
                        <label for="acompAdulto">
                            <i data-lucide="users" class="icon-blue"></i>
                            Acompanhantes Adultos</label>
                        <input type="number" id="acompAdulto" name="acompAdulto" value="0" min="0" max="10">
                    </div>

                    <div class="form-group full-width hidden" id="acomp11a17Group">
                        <label for="acomp11a17">
                        <i data-lucide="scan-face" class="icon-blue"></i>
                            Criança de 11 a 17 anos</label>
                        <input type="number" id="acomp11a17" name="acomp11a17" value="0" min="0" max="5">
                    </div>

                    <div class="form-group full-width hidden" id="acomp04a10Group">
                        <label for="acomp04a10">
                        <i data-lucide="baby" class="icon-blue"></i>
                            Criança de 04 a 10 anos</label>
                        <input type="number" id="acomp04a10" name="acomp04a10" value="0" min="0" max="5">
                    </div>

                    <div class="form-group full-width">
                        <button type="submit" class="submit-button">
                            <i data-lucide="check-circle"></i>
                            Confirmar Participação
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <!-- Footer Section -->
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-section">
                    <h3>Festa de Fim de Ano 2025</h3>
                    <p>
                        Departamento de Tecnologia da Informação<br>
                        27 de Dezembro, 2025
                    </p>
                </div>
                
                <div class="footer-section">
                    <h3>Contato</h3>
                    <ul>
                        <li>
                            <i data-lucide="mail" class="icon-yellow"></i>
                            <a href="mailto:confra2025@educacao.am.gov.br">confra2025@educacao.am.gov.br</a>
                        </li>
                        <li>
                            <i data-lucide="phone" class="icon-yellow"></i>
                            <a href="tel:+5592999999999">(92) 99999-9999</a>
                        </li>
                    </ul>
                </div>
                
                <div class="footer-section">
                    <h3>Informações</h3>
                    <p>
                        Para mais informações sobre o evento ou para tirar dúvidas, 
                        entre em contato com a comissão organizadora.
                    </p>
                </div>
            </div>
            <div><p><center><br>
            <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3984.1965206165055!2d-59.98548985415925!3d-3.041933832163163!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x926c1a32c658f74b%3A0x44c881c10ea00d6c!2sVidas%20Buffet%20Festas!5e0!3m2!1spt-BR!2sbr!4v1745721194383!5m2!1spt-BR!2sbr" 
                    style="border:0; width: 100%; max-width: 800px; height: 360px;" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </p>
            <div>
            <div class="footer-bottom">
                <p>&copy; <?php echo date('Y'); ?> DETIN - Todos os direitos reservados</p>
                <button id="scrollToTop" class="scroll-top">
                    <span>Voltar ao topo</span>
                    <i data-lucide="chevrons-up"></i>
                </button>
            </div>
        </div>
    </footer>

    <!-- Confirmation Modal -->
    <div id="confirmationModal" class="modal" style="display: none;">
        <div class="modal-overlay"></div>
        <div class="modal-content">
            <button class="modal-close" id="modalCloseButton">
                <i data-lucide="x"></i>
            </button>
            
            <div class="modal-header">
                <div class="success-icon">
                    <i data-lucide="check-circle"></i>
                </div>
                <h3>Participação Confirmada!</h3>
            </div>
            
            <div class="modal-body">
                <div class="confirmation-details">
                    <dl>
                        <div class="detail-row">
                            <dt>Nome:</dt>
                            <dd id="confirmName"></dd>
                        </div>
                        <div class="detail-row">
                            <dt>Email:</dt>
                            <dd id="confirmEmail"></dd>
                        </div>
                        <div class="detail-row">
                            <dt>Setor:</dt>
                            <dd id="confirmDepartment"></dd>
                        </div>
                        <div class="detail-row">
                            <dt>Tipo:</dt>
                            <dd id="confirmType"></dd>
                        </div>
                        <div class="detail-row">
                            <dt>Valor:</dt>
                            <dd id="confirmPrice"></dd>
                        </div>
                    </dl>
                </div>
                
                <p class="confirmation-message">
                    Um email com os detalhes da confirmação e instruções para pagamento 
                    será enviado em breve para o seu endereço de email.
                </p>
            </div>
            
            <div class="modal-footer">
                <button class="close-button" id="closeModalButton">Fechar</button>
            </div>
        </div>
    </div>
    <script src="backend/script.js"></script>
</body>
</html>
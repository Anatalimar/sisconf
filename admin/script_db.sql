-- Tabela de colaboradores
CREATE TABLE colaboradores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    setor VARCHAR(100) NOT NULL,
    funcao VARCHAR(100) NOT NULL,
    contratacao ENUM('efetivo', 'terceirizado', 'estagiario', 'outro') NOT NULL
);

-- Confirmação de participação
CREATE TABLE confirmacoes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    colaborador_id INT NOT NULL,
    vai_participar BOOLEAN NOT NULL,
    acompanhantes INT DEFAULT 0,
    data_confirmacao DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (colaborador_id) REFERENCES colaboradores(id) ON DELETE CASCADE
);

-- Parcelas de pagamento
CREATE TABLE parcelas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    colaborador_id INT NOT NULL, -- Relacionamento com a tabela de colaboradores
    valor DECIMAL(10, 2) NOT NULL, -- Valor da parcela
    data_vencimento DATE NOT NULL, -- Data de vencimento
    data_pagamento DATE NULL, -- Data do pagamento (se já pago)
    status ENUM('pendente', 'pago') DEFAULT 'pendente', -- Status da parcela
    FOREIGN KEY (colaborador_id) REFERENCES colaboradores(id) ON DELETE CASCADE
);

-- Pagamentos das parcelas
CREATE TABLE pagamentos_parcelas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    parcela_id INT NOT NULL, -- Relacionamento com a tabela de parcelas
    valor_pago DECIMAL(10, 2) NOT NULL, -- Valor pago na parcela
    data_pagamento DATE NOT NULL, -- Data do pagamento
    FOREIGN KEY (parcela_id) REFERENCES parcelas(id) ON DELETE CASCADE
);

-- Tabela de usuários administradores (login)
CREATE TABLE usuarios_admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha_hash VARCHAR(255) NOT NULL,
    perfil ENUM('admin', 'financeiro') NOT NULL DEFAULT 'financeiro',
    criado_em DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Configurações do evento (descrição e imagens do local da festa)
CREATE TABLE configuracoes_evento (
    id INT AUTO_INCREMENT PRIMARY KEY,
    descricao VARCHAR(300),
    imagem1 VARCHAR(255),
    imagem2 VARCHAR(255),
    imagem3 VARCHAR(255)
);

-- Log de ações (para registrar atividades dos administradores)
CREATE TABLE logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL, -- Relacionamento com a tabela de usuários administradores
    acao VARCHAR(255) NOT NULL,
    data DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios_admin(id) ON DELETE CASCADE
);

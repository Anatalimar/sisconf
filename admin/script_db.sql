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
CREATE TABLE pagamentos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    colaborador_id INT NOT NULL,
    parcela_num INT NOT NULL,
    valor DECIMAL(10,2) NOT NULL,
    data_pagamento DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (colaborador_id) REFERENCES colaboradores(id) ON DELETE CASCADE
);

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

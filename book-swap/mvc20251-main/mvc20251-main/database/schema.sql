-- Criação da tabela de Usuários
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    endereco TEXT,
    telefone VARCHAR(20),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Criação da tabela de Livros
CREATE TABLE livros (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(200) NOT NULL,
    autor VARCHAR(100) NOT NULL,
    editora VARCHAR(100),
    ano INT,
    condicao VARCHAR(50),
    descricao TEXT,
    usuario_id INT NOT NULL,
    disponivel BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

-- Criação da tabela de Trocas
CREATE TABLE trocas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    livro_id INT NOT NULL,
    usuario_proponente_id INT NOT NULL,
    usuario_receptor_id INT NOT NULL,
    status ENUM('pendente', 'aceita', 'recusada', 'concluida') DEFAULT 'pendente',
    data_proposta TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    data_conclusao TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (livro_id) REFERENCES livros(id),
    FOREIGN KEY (usuario_proponente_id) REFERENCES usuarios(id),
    FOREIGN KEY (usuario_receptor_id) REFERENCES usuarios(id)
); 
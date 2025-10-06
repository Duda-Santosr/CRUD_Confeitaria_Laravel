CREATE DATABASE confeitaria_db;
USE confeitaria_db;
CREATE TABLE usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100) NOT NULL,
  senha VARCHAR(255) NOT NULL
);
CREATE TABLE sobremesas (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100) NOT NULL,
  ingredientes TEXT NOT NULL,
  preco DECIMAL(8,2) NOT NULL,
  tamanho ENUM('Pequena', 'Media', 'Grande') NOT NULL,
  categoria VARCHAR(50) NOT NULL,
  estoque_minimo INT DEFAULT 5,
  ativo BOOLEAN DEFAULT TRUE
);
CREATE TABLE movimentacoes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  sobremesa_id INT NOT NULL,
  usuario_id INT NOT NULL,
  data_hora DATETIME NOT NULL,
  tipo ENUM('entrada','saida') NOT NULL,
  quantidade INT NOT NULL,
  observacoes TEXT,
  FOREIGN KEY (sobremesa_id) REFERENCES sobremesas(id),
  FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);
INSERT INTO usuarios (nome, senha) VALUES
('Admin', 'admin123'),
('Gerente', 'gerente123'),
('Atendente', 'atendente123');
INSERT INTO sobremesas (nome, ingredientes, preco, tamanho, categoria) VALUES
('Torta de Limão', 'Base crocante, creme de limão, merengue', 25.90, 'Media', 'Tradicional'),
('Cheesecake de Frutas Vermelhas', 'Creme de queijo, calda de frutas vermelhas', 28.90, 'Media', 'Tradicional'),
('Pavê de Chocolate', 'Camadas de biscoito, creme e chocolate', 32.90, 'Media', 'Especial'),
('Brigadeiro Gourmet', 'Chocolate belga, granulado belga', 35.90, 'Media', 'Especial'),
('Mousse de Maracujá', 'Creme de leite condensado e maracujá', 38.90, 'Media', 'Especial');
INSERT INTO movimentacoes (sobremesa_id, usuario_id, data_hora, tipo, quantidade, observacoes) VALUES
(1, 1, '2025-01-15 10:30:00', 'entrada', 5, 'Estoque inicial'),
(2, 1, '2025-01-15 10:35:00', 'entrada', 3, 'Estoque inicial'),
(3, 2, '2025-01-15 11:00:00', 'saida', 2, 'Venda para cliente'),
(4, 2, '2025-01-15 11:15:00', 'entrada', 4, 'Reposição de estoque');


CREATE TABLE questoes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pergunta TEXT NOT NULL,
    banca VARCHAR(255) NOT NULL,
    ano INT NOT NULL,
    instituicao VARCHAR(255) NOT NULL,
    materia VARCHAR(255) NOT NULL
);

CREATE TABLE opcoes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    questao_id INT NOT NULL,
    descricao TEXT NOT NULL,
    correta TINYINT NOT NULL,
    FOREIGN KEY (questao_id) REFERENCES questoes(id)
);

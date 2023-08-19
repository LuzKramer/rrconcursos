
 
CREATE DATABASE IF NOT EXISTS db_rrconcursos;
USE db_rrconcursos;

-- Tabela Disciplinas
CREATE TABLE IF NOT EXISTS disciplinas (
  id_disciplina INT AUTO_INCREMENT PRIMARY KEY,
  nome_disciplina VARCHAR(100) NOT NULL
);

-- Tabela Instituicao
CREATE TABLE IF NOT EXISTS instituicao (
  id_instituicao INT AUTO_INCREMENT PRIMARY KEY,
  nome_instituicao VARCHAR(100) NOT NULL
);


CREATE TABLE IF NOT EXISTS bancas (
  id_banca INT AUTO_INCREMENT PRIMARY KEY,
  nome_banca VARCHAR(100) NOT NULL
);

-- Tabela Questoes
CREATE TABLE IF NOT EXISTS questoes (
  id_questao INT AUTO_INCREMENT PRIMARY KEY,
  id_disciplina INT NOT NULL,
  id_instituicao INT NOT NULL,
  ano INT NOT NULL,
  enunciado TEXT NOT NULL,
  imagem VARCHAR (255),
  FOREIGN KEY (id_disciplina) REFERENCES disciplinas(id_disciplina) ON DELETE CASCADE,
  FOREIGN KEY (id_instituicao) REFERENCES instituicao(id_instituicao) ON DELETE CASCADE
);






 CREATE TABLE IF NOT EXISTS alternativas (
  id_alternativa INT AUTO_INCREMENT PRIMARY KEY,
  id_questao INT NOT NULL,
  txt_alt1 TEXT NOT NULL,
  txt_alt2 TEXT NOT NULL,
  txt_alt3 TEXT NOT NULL,
  txt_alt4 TEXT NOT NULL,
  txt_alt5 TEXT NOT NULL,
  correta INT NOT NULL,
  FOREIGN KEY (id_questao) REFERENCES questoes(id_questao) ON DELETE CASCADE
);


CREATE TABLE tb_login(
    id int AUTO_INCREMENT PRIMARY KEY,
    nome varchar(255) NOT NULL, 
    email varchar(255) NOT NULL,
    senha varchar(255)not null
);


CREATE TABLE tb_news(
  id int AUTO_INCREMENT PRIMARY KEY,
  title varchar(255) NOT NULL,
  news TEXT NOT NULL,
  date DATE NOT NULL,
  img varchar(255)
);

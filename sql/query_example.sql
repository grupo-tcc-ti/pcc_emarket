CREATE DATABASE emarket;

USE emarket;

CREATE TABLE cliente (
    id INT NOT NULL AUTO_INCREMENT,
    nome VARCHAR(60) NOT NULL,
    cpf INT(11),
    nascimento DATE,
    telefone VARCHAR(15),
    PRIMARY KEY (id)
);
/* emarket-ml: */
DROP SCHEMA emarket;
CREATE SCHEMA IF NOT EXISTS emarket;
USE emarket;

/* emarket-ml: */

CREATE TABLE Pessoa (
    codPessoa int PRIMARY KEY,
    sexo varchar(12),
    dtnasc int(8),
    telefone int(12),
    email varchar(255),
    nome varchar(100),
    endereco varchar(100),
    rg int,
    cpf int,
    cnpj int,
    ie int
);

CREATE TABLE Cliente (
    codCliente int,
    tipoCliente int,
    desconto int,
    fk_Pessoa_codPessoa int,
    PRIMARY KEY (codCliente, fk_Pessoa_codPessoa)
);

CREATE TABLE Funcionario (
    codFunc int,
    salario double,
    admissao date,
    demissao date,
    ferias date,
    fk_Pessoa_codPessoa int,
    codAdmin int,
    Funcionario_TIPO INT,
    PRIMARY KEY (codFunc, fk_Pessoa_codPessoa, codAdmin)
);

CREATE TABLE Produto (
    codProduto int PRIMARY KEY,
    nome varchar(100),
    descricao varchar(255),
    preco double,
    quantidade int(255),
    descricao_tecnica varchar(255),
    codFornecedor int,
    codCategoria int
);

CREATE TABLE Pedido (
    codPedido int PRIMARY KEY,
    dataPedido date,
    dataEntrega date,
    tipoEntrega varchar(12),
    frete double,
    nomeDestinatario varchar(100),
    enderecoDestinatario varchar(255),
    cepDestino int(12),
    dataEnvio date
);

CREATE TABLE compra (
    fk_Produto_codProduto int,
    fk_Cliente_codCliente int,
    fk_Cliente_fk_Pessoa_codPessoa int
);

CREATE TABLE inclui (
    fk_Produto_codProduto int,
    fk_Pedido_codPedido int
);
 
ALTER TABLE Cliente ADD CONSTRAINT FK_Cliente_2
    FOREIGN KEY (fk_Pessoa_codPessoa)
    REFERENCES Pessoa (codPessoa)
    ON DELETE CASCADE;
 
ALTER TABLE Funcionario ADD CONSTRAINT FK_Funcionario_2
    FOREIGN KEY (fk_Pessoa_codPessoa)
    REFERENCES Pessoa (codPessoa)
    ON DELETE CASCADE;
 
ALTER TABLE compra ADD CONSTRAINT FK_compra_1
    FOREIGN KEY (fk_Produto_codProduto)
    REFERENCES Produto (codProduto)
    ON DELETE RESTRICT;
 
ALTER TABLE compra ADD CONSTRAINT FK_compra_2
    FOREIGN KEY (fk_Cliente_codCliente, fk_Cliente_fk_Pessoa_codPessoa)
    REFERENCES Cliente (codCliente, fk_Pessoa_codPessoa)
    ON DELETE RESTRICT;
 
ALTER TABLE inclui ADD CONSTRAINT FK_inclui_1
    FOREIGN KEY (fk_Produto_codProduto)
    REFERENCES Produto (codProduto)
    ON DELETE RESTRICT;
 
ALTER TABLE inclui ADD CONSTRAINT FK_inclui_2
    FOREIGN KEY (fk_Pedido_codPedido)
    REFERENCES Pedido (codPedido)
    ON DELETE RESTRICT;
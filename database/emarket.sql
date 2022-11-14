DROP SCHEMA IF EXISTS `emarket` ;
CREATE SCHEMA IF NOT EXISTS `emarket` DEFAULT CHARACTER SET utf8 COLLATE = utf8_general_ci;
USE `emarket` ;

/* Lógico_1: */

CREATE TABLE usuarios (
    codUsuario int not null auto_increment,
    nome varchar(255) not null,
    email varchar(255) not null,
    senha varchar(50) not null,
    user_type enum('cliente', 'funcionario', 'admin') not null default 'cliente',
    codCliente int not null,
    codAdmin int not null,
    salario double,
    admissao date,
    demissao date,
    telefone bigint(12),
    cpf int(12),
    rg int(12),
    cnpj int(12),
    ie int(12),
    cep varchar(12),
    estado varchar(2),
    cidade varchar(255),
    logradouro varchar(255),
    numero int(12),
    complemento varchar(255),
    PRIMARY KEY (codUsuario, codCliente, codAdmin)
);

CREATE TABLE produtos (
    codProduto int PRIMARY KEY not null auto_increment,
    nome varchar(255) not null,
    descricao varchar(1500),
    detalhes varchar(1500),
    preco double,
    image varchar(1500)
);

CREATE TABLE pedidos (
    codPedido int PRIMARY KEY not null auto_increment,
    tipoEntrega varchar(255),
    totalProduto varchar(1500),
    totalPreco double,
    dataEnvio date,
    dataEntrega date,
    statusPagamento enum('pendente', 'pago', 'cancelado') default 'pendente',
    fk_usuarios_codUsuario int,
    fk_usuarios_codCliente int,
    CONSTRAINT FK_pedidos
    FOREIGN KEY (fk_usuarios_codUsuario, fk_usuarios_codCliente)
    REFERENCES usuarios (codUsuario, codCliente)
    ON DELETE CASCADE
);

CREATE TABLE mensagens (
    codMensagem int PRIMARY KEY not null auto_increment,
    nome varchar(255),
    email varchar(255),
    telefone varchar(12),
    mensagem varchar(500),
    fk_usuarios_codUsuario int,
    fk_usuarios_codCliente int,
    fk_usuarios_codAdmin int,
    CONSTRAINT fk_mensagens
    FOREIGN KEY (fk_usuarios_codUsuario, fk_usuarios_codCliente, fk_usuarios_codAdmin)
    REFERENCES usuarios (codUsuario, codCliente, codAdmin)
    ON DELETE RESTRICT
);

CREATE TABLE carrinho (
    codCarrinho int PRIMARY KEY not null auto_increment,
    quantidade int(12),
    fk_usuarios_codUsuario int not null,
    fk_usuarios_codCliente int not null,
    fk_produtos_codProduto int not null,
    CONSTRAINT fk_carrinho_usuarios
    FOREIGN KEY (fk_usuarios_codUsuario, fk_usuarios_codCliente)
    REFERENCES usuarios (codUsuario, codCliente)
    ON DELETE CASCADE,
    CONSTRAINT fk_carrinho_produtos
    FOREIGN KEY (fk_produtos_codProduto)
    REFERENCES produtos (codProduto)
);
-- ALTER TABLE produtos ADD CONSTRAINT FK_produtos
--     FOREIGN KEY (fk_carrinho_codCarrinho)
--     REFERENCES carrinho (codCarrinho)
--     ON DELETE CASCADE;
 
-- ALTER TABLE pedidos ADD CONSTRAINT FK_pedidos
--     FOREIGN KEY (fk_usuarios_codUsuario, fk_usuarios_codCliente, fk_usuarios_codAdmin)
--     REFERENCES usuarios (codUsuario, codCliente, codAdmin)
--     ON DELETE CASCADE;
 
-- ALTER TABLE mensagens ADD CONSTRAINT FK_mensagens
--     FOREIGN KEY (fk_usuarios_codUsuario, fk_usuarios_codCliente, fk_usuarios_codAdmin)
--     REFERENCES usuarios (codUsuario, codCliente, codAdmin)
--     ON DELETE RESTRICT;
 
-- ALTER TABLE carrinho ADD CONSTRAINT FK_carrinho
--     FOREIGN KEY (fk_usuarios_codUsuario, fk_usuarios_codCliente, fk_usuarios_codAdmin)
--     REFERENCES usuarios (codUsuario, codCliente, codAdmin)
--     ON DELETE CASCADE;
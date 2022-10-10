-- MySQL Workbench Forward Engineering

-- -----------------------------------------------------
-- Schema emarket
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `emarket` ;
CREATE SCHEMA IF NOT EXISTS `emarket` DEFAULT CHARACTER SET utf8 COLLATE = utf8_general_ci;
USE `emarket` ;

-- -----------------------------------------------------
-- Table `emarket`.`admins`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `emarket`.`admins` (
  `codAdmin` INT(100) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `senha` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`codAdmin`))
ENGINE = InnoDB
AUTO_INCREMENT = 4;


-- -----------------------------------------------------
-- Table `emarket`.`usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `emarket`.`usuarios` (
  `codUsuario` INT(100) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `senha` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`codUsuario`))
ENGINE = InnoDB
AUTO_INCREMENT = 2;


-- -----------------------------------------------------
-- Table `emarket`.`produtos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `emarket`.`produtos` (
  `codProduto` INT(100) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `descricao` VARCHAR(1500) NOT NULL,
  `preco` DOUBLE NOT NULL,
  `image` VARCHAR(1500) NOT NULL,
  PRIMARY KEY (`codProduto`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `emarket`.`carrinho`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `emarket`.`carrinho` (
  `codCarrinho` INT(100) NOT NULL,
  `nome` VARCHAR(255) NOT NULL,
  `preco` DOUBLE NOT NULL,
  `quantidade` INT(12) NOT NULL,
  `image` VARCHAR(1500) NOT NULL,
  `usuarios_codUsuario` INT(100) NOT NULL,
  `produtos_codProduto` INT(100) NOT NULL,
  PRIMARY KEY (`codCarrinho`),
  INDEX `fk_carrinho_usuarios_idx` (`usuarios_codUsuario` ASC) ,
  INDEX `fk_carrinho_produtos_idx` (`produtos_codProduto` ASC) ,
  CONSTRAINT `fk_carrinho_usuarios`
    FOREIGN KEY (`usuarios_codUsuario`)
    REFERENCES `emarket`.`usuarios` (`codUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_carrinho_produtos`
    FOREIGN KEY (`produtos_codProduto`)
    REFERENCES `emarket`.`produtos` (`codProduto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `emarket`.`clientes`
-- -----------------------------------------------------
-- CREATE TABLE IF NOT EXISTS `emarket`.`clientes` (
--   `codCliente` INT(100) NOT NULL,
--   `nome` VARCHAR(255) NOT NULL,
--   `email` VARCHAR(255) NOT NULL,
--   `senha` VARCHAR(50) NOT NULL,
--   PRIMARY KEY (`codCliente`))
-- ENGINE = InnoDB
-- ;


-- -----------------------------------------------------
-- Table `emarket`.`funcionarios`
-- -----------------------------------------------------
-- CREATE TABLE IF NOT EXISTS `emarket`.`funcionarios` (
--   `codFuncionario` INT(100) NOT NULL,
--   `nome` VARCHAR(255) NOT NULL,
--   `email` VARCHAR(255) NOT NULL,
--   `senha` VARCHAR(50) NOT NULL,
--   PRIMARY KEY (`codFuncionario`))
-- ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `emarket`.`listadedesejo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `emarket`.`listadedesejo` (
  `codItem` INT(100) NOT NULL,
  `nome` VARCHAR(255) NOT NULL,
  `preco` DOUBLE NOT NULL,
  `image` VARCHAR(1500) NOT NULL,
  `usuarios_codUsuario` INT(100) NOT NULL,
  `produtos_codProduto` INT(100) NOT NULL,
  PRIMARY KEY (`codItem`),
  INDEX `fk_listadedesejo_usuarios_idx` (`usuarios_codUsuario` ASC) ,
  INDEX `fk_listadedesejo_produtos_idx` (`produtos_codProduto` ASC) ,
  CONSTRAINT `fk_listadedesejo_usuarios`
    FOREIGN KEY (`usuarios_codUsuario`)
    REFERENCES `emarket`.`usuarios` (`codUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_listadedesejo_produtos`
    FOREIGN KEY (`produtos_codProduto`)
    REFERENCES `emarket`.`produtos` (`codProduto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `emarket`.`mensagens`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `emarket`.`mensagens` (
  `codMensagem` INT(100) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `telefone` VARCHAR(12) NOT NULL,
  `mensagem` VARCHAR(500) NOT NULL,
  `usuarios_codUsuario` INT(100) NOT NULL,
  PRIMARY KEY (`codMensagem`),
  INDEX `fk_mensagens_usuarios_idx` (`usuarios_codUsuario` ASC) ,
  CONSTRAINT `fk_mensagens_usuarios`
    FOREIGN KEY (`usuarios_codUsuario`)
    REFERENCES `emarket`.`usuarios` (`codUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `emarket`.`pedidos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `emarket`.`pedidos` (
  `codPedido` INT(100) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `telefone` VARCHAR(12) NOT NULL,
  `tipoEntrega` VARCHAR(255) NOT NULL,
  `cepDestino` INT(12) NOT NULL,
  `endereco` VARCHAR(255) NOT NULL,
  `totalProduto` VARCHAR(1500) NOT NULL,
  `totalPreco` DOUBLE NOT NULL,
  `dataEnvio` DATE NOT NULL,
  `dataEntrega` DATE NULL DEFAULT NULL,
  `statusPagamento` VARCHAR(50) NOT NULL DEFAULT 'Pendente',
  `usuarios_codUsuario` INT(100) NOT NULL,
  PRIMARY KEY (`codPedido`),
  INDEX `fk_pedidos_usuarios_idx` (`usuarios_codUsuario` ASC) ,
  CONSTRAINT `fk_pedidos_usuarios`
    FOREIGN KEY (`usuarios_codUsuario`)
    REFERENCES `emarket`.`usuarios` (`codUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

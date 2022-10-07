-- MySQL Workbench Forward Engineering

-- -----------------------------------------------------
-- Schema emarket
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `emarket` ;
CREATE SCHEMA IF NOT EXISTS `emarket` DEFAULT CHARACTER SET utf8mb4 ;
USE `emarket` ;

-- -----------------------------------------------------
-- Table `emarket`.`admins`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `emarket`.`admins` (
  `codAdmin` INT(100) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `senha` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`codAdmin`))
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `emarket`.`usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `emarket`.`usuarios` (
  `codUsuario` INT(100) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `senha` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`codUsuario`))
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `emarket`.`produtos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `emarket`.`produtos` (
  `codProduto` INT(100) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `descricao` VARCHAR(1500) NOT NULL,
  `preco` DOUBLE NOT NULL,
  `image` VARCHAR(10000) NOT NULL,
  PRIMARY KEY (`codProduto`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `emarket`.`carrinho`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `emarket`.`carrinho` (
  `codCarrinho` INT(100) NOT NULL,
  `nome` VARCHAR(100) NOT NULL,
  `preco` DOUBLE NOT NULL,
  `quantidade` INT(10) NOT NULL,
  `image` VARCHAR(100) NOT NULL,
  `usuarios_codUsuario` INT(100) NOT NULL,
  `produtos_codProduto` INT(100) NOT NULL,
  PRIMARY KEY (`codCarrinho`),
  INDEX `fk_carrinho_usuarios1_idx` (`usuarios_codUsuario` ASC) ,
  INDEX `fk_carrinho_produtos1_idx` (`produtos_codProduto` ASC) ,
  CONSTRAINT `fk_carrinho_usuarios1`
    FOREIGN KEY (`usuarios_codUsuario`)
    REFERENCES `emarket`.`usuarios` (`codUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_carrinho_produtos1`
    FOREIGN KEY (`produtos_codProduto`)
    REFERENCES `emarket`.`produtos` (`codProduto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `emarket`.`clientes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `emarket`.`clientes` (
  `codCliente` INT(100) NOT NULL,
  `nome` VARCHAR(100) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `senha` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`codCliente`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `emarket`.`funcionarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `emarket`.`funcionarios` (
  `codFuncionario` INT(100) NOT NULL,
  `nome` VARCHAR(100) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `senha` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`codFuncionario`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `emarket`.`listadedesejo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `emarket`.`listadedesejo` (
  `codItem` INT(100) NOT NULL,
  `nome` VARCHAR(100) NOT NULL,
  `preco` DOUBLE NOT NULL,
  `image` VARCHAR(100) NOT NULL,
  `usuarios_codUsuario` INT(100) NOT NULL,
  `produtos_codProduto` INT(100) NOT NULL,
  PRIMARY KEY (`codItem`),
  INDEX `fk_listadedesejo_usuarios1_idx` (`usuarios_codUsuario` ASC) ,
  INDEX `fk_listadedesejo_produtos1_idx` (`produtos_codProduto` ASC) ,
  CONSTRAINT `fk_listadedesejo_usuarios1`
    FOREIGN KEY (`usuarios_codUsuario`)
    REFERENCES `emarket`.`usuarios` (`codUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_listadedesejo_produtos1`
    FOREIGN KEY (`produtos_codProduto`)
    REFERENCES `emarket`.`produtos` (`codProduto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `emarket`.`mensagens`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `emarket`.`mensagens` (
  `codMensagem` INT(100) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `telefone` VARCHAR(12) NOT NULL,
  `mensagem` VARCHAR(500) NOT NULL,
  `usuarios_codUsuario` INT(100) NOT NULL,
  PRIMARY KEY (`codMensagem`),
  INDEX `fk_mensagens_usuarios1_idx` (`usuarios_codUsuario` ASC) ,
  CONSTRAINT `fk_mensagens_usuarios1`
    FOREIGN KEY (`usuarios_codUsuario`)
    REFERENCES `emarket`.`usuarios` (`codUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `emarket`.`pedidos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `emarket`.`pedidos` (
  `codPedido` INT(100) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `telefone` VARCHAR(12) NOT NULL,
  `tipoEntrega` VARCHAR(45) NOT NULL,
  `cepDestino` INT(12) NOT NULL,
  `endereco` VARCHAR(50) NOT NULL,
  `totalProduto` VARCHAR(1000) NOT NULL,
  `totalPreco` DOUBLE NOT NULL,
  `dataEnvio` DATE NOT NULL,
  `dataEntrega` DATE NULL DEFAULT NULL,
  `statusPagamento` VARCHAR(20) NOT NULL DEFAULT 'Pendente',
  `usuarios_codUsuario` INT(100) NOT NULL,
  PRIMARY KEY (`codPedido`),
  INDEX `fk_pedidos_usuarios1_idx` (`usuarios_codUsuario` ASC) ,
  CONSTRAINT `fk_pedidos_usuarios1`
    FOREIGN KEY (`usuarios_codUsuario`)
    REFERENCES `emarket`.`usuarios` (`codUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;

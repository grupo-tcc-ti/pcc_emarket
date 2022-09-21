-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema emarket
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema emarket
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `emarket` DEFAULT CHARACTER SET utf8mb4;
USE `emarket` ;

-- -----------------------------------------------------
-- Table `emarket`.`pessoa`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `emarket`.`pessoa` (
  `codPessoa` INT(11) NOT NULL,
  `sexo` VARCHAR(12) NULL DEFAULT NULL,
  `dtnasc` INT(8) NULL DEFAULT NULL,
  `telefone` INT(12) NULL DEFAULT NULL,
  `email` VARCHAR(255) NULL DEFAULT NULL,
  `nome` VARCHAR(100) NULL DEFAULT NULL,
  `endereco` VARCHAR(100) NULL DEFAULT NULL,
  `rg` INT(11) NULL DEFAULT NULL,
  `cpf` INT(11) NULL DEFAULT NULL,
  `cnpj` INT(11) NULL DEFAULT NULL,
  `ie` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`codPessoa`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `emarket`.`cliente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `emarket`.`cliente` (
  `codCliente` INT(11) NOT NULL,
  `tipoCliente` INT(11) NULL DEFAULT NULL,
  `desconto` INT(11) NULL DEFAULT NULL,
  `fk_Pessoa_codPessoa` INT(11) NOT NULL,
  PRIMARY KEY (`codCliente`, `fk_Pessoa_codPessoa`),
  INDEX `FK_Cliente_2` (`fk_Pessoa_codPessoa` ASC),
  CONSTRAINT `FK_Cliente_2`
    FOREIGN KEY (`fk_Pessoa_codPessoa`)
    REFERENCES `emarket`.`pessoa` (`codPessoa`)
    ON DELETE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `emarket`.`produto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `emarket`.`produto` (
  `codProduto` INT(11) NOT NULL,
  `nome` VARCHAR(100) NULL DEFAULT NULL,
  `descricao` VARCHAR(255) NULL DEFAULT NULL,
  `preco` DOUBLE NULL DEFAULT NULL,
  `quantidade` INT(255) NULL DEFAULT NULL,
  `descricao_tecnica` VARCHAR(255) NULL DEFAULT NULL,
  `codFornecedor` INT(11) NULL DEFAULT NULL,
  `codCategoria` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`codProduto`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `emarket`.`compra`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `emarket`.`compra` (
  `fk_Produto_codProduto` INT(11) NULL DEFAULT NULL,
  `fk_Cliente_codCliente` INT(11) NULL DEFAULT NULL,
  `fk_Cliente_fk_Pessoa_codPessoa` INT(11) NULL DEFAULT NULL,
  INDEX `FK_compra_1` (`fk_Produto_codProduto` ASC),
  INDEX `FK_compra_2` (`fk_Cliente_codCliente` ASC, `fk_Cliente_fk_Pessoa_codPessoa` ASC),
  CONSTRAINT `FK_compra_1`
    FOREIGN KEY (`fk_Produto_codProduto`)
    REFERENCES `emarket`.`produto` (`codProduto`),
  CONSTRAINT `FK_compra_2`
    FOREIGN KEY (`fk_Cliente_codCliente` , `fk_Cliente_fk_Pessoa_codPessoa`)
    REFERENCES `emarket`.`cliente` (`codCliente` , `fk_Pessoa_codPessoa`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `emarket`.`funcionario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `emarket`.`funcionario` (
  `codFunc` INT(11) NOT NULL,
  `salario` DOUBLE NULL DEFAULT NULL,
  `admissao` DATE NULL DEFAULT NULL,
  `demissao` DATE NULL DEFAULT NULL,
  `ferias` DATE NULL DEFAULT NULL,
  `fk_Pessoa_codPessoa` INT(11) NOT NULL,
  `codAdmin` INT(11) NOT NULL,
  `Funcionario_TIPO` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`codFunc`, `fk_Pessoa_codPessoa`, `codAdmin`),
  INDEX `FK_Funcionario_2` (`fk_Pessoa_codPessoa` ASC),
  CONSTRAINT `FK_Funcionario_2`
    FOREIGN KEY (`fk_Pessoa_codPessoa`)
    REFERENCES `emarket`.`pessoa` (`codPessoa`)
    ON DELETE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `emarket`.`pedido`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `emarket`.`pedido` (
  `codPedido` INT(11) NOT NULL,
  `dataPedido` DATE NULL DEFAULT NULL,
  `dataEntrega` DATE NULL DEFAULT NULL,
  `tipoEntrega` VARCHAR(12) NULL DEFAULT NULL,
  `frete` DOUBLE NULL DEFAULT NULL,
  `nomeDestinatario` VARCHAR(100) NULL DEFAULT NULL,
  `enderecoDestinatario` VARCHAR(255) NULL DEFAULT NULL,
  `cepDestino` INT(12) NULL DEFAULT NULL,
  `dataEnvio` DATE NULL DEFAULT NULL,
  PRIMARY KEY (`codPedido`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `emarket`.`inclui`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `emarket`.`inclui` (
  `fk_Produto_codProduto` INT(11) NULL DEFAULT NULL,
  `fk_Pedido_codPedido` INT(11) NULL DEFAULT NULL,
  INDEX `FK_inclui_1` (`fk_Produto_codProduto` ASC),
  INDEX `FK_inclui_2` (`fk_Pedido_codPedido` ASC),
  CONSTRAINT `FK_inclui_1`
    FOREIGN KEY (`fk_Produto_codProduto`)
    REFERENCES `emarket`.`produto` (`codProduto`),
  CONSTRAINT `FK_inclui_2`
    FOREIGN KEY (`fk_Pedido_codPedido`)
    REFERENCES `emarket`.`pedido` (`codPedido`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

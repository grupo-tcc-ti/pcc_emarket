-- MySQL Workbench Forward Engineering

-- SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
-- SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
-- SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema emarket
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema emarket
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `emarket` ;
CREATE SCHEMA IF NOT EXISTS `emarket` ;
USE `emarket` ;

-- -----------------------------------------------------
-- Table `emarket`.`usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `emarket`.`usuarios` (
  `codUsuarios` INT(100) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_general_ci' NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `senha` VARCHAR(50) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_general_ci' NOT NULL,
  PRIMARY KEY (`codUsuarios`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `emarket`.`admins`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `emarket`.`admins` (
  `codAdmin` INT(100) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `senha` VARCHAR(50) NOT NULL,
  `usuarios_codUsuarios` INT(100) NOT NULL,
  PRIMARY KEY (`codAdmin`, `usuarios_codUsuarios`),
  INDEX `fk_admins_usuarios1_idx` (`usuarios_codUsuarios` ASC) ,
  CONSTRAINT `fk_admins_usuarios1`
    FOREIGN KEY (`usuarios_codUsuarios`)
    REFERENCES `emarket`.`usuarios` (`codUsuarios`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `emarket`.`produtos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `emarket`.`produtos` (
  `codProdutos` INT(100) NOT NULL,
  `nome` VARCHAR(100) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_general_ci' NOT NULL,
  `descricao` VARCHAR(500) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_general_ci' NOT NULL,
  `preco` DOUBLE NOT NULL,
  `image` VARCHAR(1000) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_general_ci' NOT NULL,
  PRIMARY KEY (`codProdutos`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `emarket`.`carrinho`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `emarket`.`carrinho` (
  `codCarrinho` INT(100) NOT NULL,
  `nome` VARCHAR(100) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_general_ci' NOT NULL,
  `preco` DOUBLE NOT NULL,
  `quantidade` INT(10) NOT NULL,
  `image` VARCHAR(100) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_general_ci' NOT NULL,
  `produtos_codProdutos` INT(100) NOT NULL,
  `usuarios_codUsuarios` INT(100) NOT NULL,
  PRIMARY KEY (`codCarrinho`),
  INDEX `fk_carrinho_produtos1_idx` (`produtos_codProdutos` ASC) ,
  INDEX `fk_carrinho_usuarios1_idx` (`usuarios_codUsuarios` ASC) ,
  CONSTRAINT `fk_carrinho_produtos1`
    FOREIGN KEY (`produtos_codProdutos`)
    REFERENCES `emarket`.`produtos` (`codProdutos`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_carrinho_usuarios1`
    FOREIGN KEY (`usuarios_codUsuarios`)
    REFERENCES `emarket`.`usuarios` (`codUsuarios`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `emarket`.`mensagens`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `emarket`.`mensagens` (
  `codMensagens` INT(100) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_general_ci' NOT NULL,
  `email` VARCHAR(255) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_general_ci' NOT NULL,
  `telefone` VARCHAR(12) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_general_ci' NOT NULL,
  `mensagem` VARCHAR(500) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_general_ci' NOT NULL,
  `usuarios_codUsuarios` INT(100) NOT NULL,
  PRIMARY KEY (`codMensagens`),
  INDEX `fk_mensagens_usuarios1_idx` (`usuarios_codUsuarios` ASC) ,
  CONSTRAINT `fk_mensagens_usuarios1`
    FOREIGN KEY (`usuarios_codUsuarios`)
    REFERENCES `emarket`.`usuarios` (`codUsuarios`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `emarket`.`pedidos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `emarket`.`pedidos` (
  `codPedido` INT(100) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_general_ci' NOT NULL,
  `email` VARCHAR(255) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_general_ci' NOT NULL,
  `telefone` VARCHAR(12) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_general_ci' NOT NULL,
  `method` VARCHAR(45) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_general_ci' NOT NULL,
  `endereco` VARCHAR(50) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_general_ci' NOT NULL,
  `total_produto` VARCHAR(1000) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_general_ci' NOT NULL,
  `total_preco` DOUBLE NOT NULL,
  `placed_on` DATE NOT NULL,
  `payment_status` VARCHAR(20) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_general_ci' NOT NULL DEFAULT 'Pendente',
  `usuarios_codUsuarios` INT(100) NOT NULL,
  PRIMARY KEY (`codPedido`),
  INDEX `fk_pedidos_usuarios1_idx` (`usuarios_codUsuarios` ASC) ,
  CONSTRAINT `fk_pedidos_usuarios1`
    FOREIGN KEY (`usuarios_codUsuarios`)
    REFERENCES `emarket`.`usuarios` (`codUsuarios`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `emarket`.`funcionarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `emarket`.`funcionarios` (
  `codFuncionario` INT(100) NOT NULL,
  `nome` VARCHAR(100) NOT NULL,
  `email` VARCHAR(255) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_general_ci' NOT NULL,
  `senha` VARCHAR(50) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_general_ci' NOT NULL,
  `usuarios_codUsuarios` INT(100) NOT NULL,
  PRIMARY KEY (`codFuncionario`, `usuarios_codUsuarios`),
  INDEX `fk_funcionarios_usuarios1_idx` (`usuarios_codUsuarios` ASC) ,
  CONSTRAINT `fk_funcionarios_usuarios1`
    FOREIGN KEY (`usuarios_codUsuarios`)
    REFERENCES `emarket`.`usuarios` (`codUsuarios`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `emarket`.`listadedesejo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `emarket`.`listadedesejo` (
  `codListadedesejo` INT(100) NOT NULL,
  `nome` VARCHAR(100) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_general_ci' NOT NULL,
  `preco` DOUBLE NOT NULL,
  `image` VARCHAR(100) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_general_ci' NOT NULL,
  `usuarios_codUsuarios` INT(100) NOT NULL,
  PRIMARY KEY (`codListadedesejo`),
  INDEX `fk_listadedesejo_usuarios1_idx` (`usuarios_codUsuarios` ASC) ,
  CONSTRAINT `fk_listadedesejo_usuarios1`
    FOREIGN KEY (`usuarios_codUsuarios`)
    REFERENCES `emarket`.`usuarios` (`codUsuarios`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `emarket`.`clientes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `emarket`.`clientes` (
  `codClientes` INT(100) NOT NULL,
  `nome` VARCHAR(100) NOT NULL,
  `email` VARCHAR(255) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_general_ci' NOT NULL,
  `senha` VARCHAR(50) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_general_ci' NOT NULL,
  `usuarios_codUsuarios` INT(100) NOT NULL,
  PRIMARY KEY (`codClientes`, `usuarios_codUsuarios`),
  INDEX `fk_clientes_usuarios1_idx` (`usuarios_codUsuarios` ASC) ,
  CONSTRAINT `fk_clientes_usuarios1`
    FOREIGN KEY (`usuarios_codUsuarios`)
    REFERENCES `emarket`.`usuarios` (`codUsuarios`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- SET SQL_MODE=@OLD_SQL_MODE;
-- SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
-- SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

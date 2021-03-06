-- MySQL Script generated by MySQL Workbench
-- 06/12/17 18:35:46
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema agenda_full_local
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `agenda_full_local` ;

-- -----------------------------------------------------
-- Schema agenda_full_local
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `agenda_full_local` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `agenda_full_local` ;

-- -----------------------------------------------------
-- Table `agenda_full_local`.`usuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `agenda_full_local`.`usuario` ;

CREATE TABLE IF NOT EXISTS `agenda_full_local`.`usuario` (
  `id_usuario` INT NOT NULL AUTO_INCREMENT,
  `usuario` VARCHAR(150) NULL,
  `identificacao` VARCHAR(50) NULL,
  `email` VARCHAR(150) NULL,
  `data_cadastro` DATE NULL,
  `senha` TEXT NULL,
  `status` INT NULL,
  `nome_completo` VARCHAR(250) NULL,
  `tel` VARCHAR(45) NULL,
  `cel` VARCHAR(45) NULL,
  `logradouro` VARCHAR(250) NULL,
  `num_residencia` VARCHAR(45) NULL,
  `cidade` VARCHAR(250) NULL,
  `uf` VARCHAR(10) NULL,
  `bairro` VARCHAR(250) NULL,
  `cep` VARCHAR(10) NULL,
  `complemento` VARCHAR(250) NULL,
  `token` VARCHAR(250) NULL,
  `img_profile` VARCHAR(250) NULL,
  `outras_infos` VARCHAR(250) NULL,
  PRIMARY KEY (`id_usuario`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `agenda_full_local`.`veiculo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `agenda_full_local`.`veiculo` ;

CREATE TABLE IF NOT EXISTS `agenda_full_local`.`veiculo` (
  `id_veiculo` INT NOT NULL AUTO_INCREMENT,
  `data` DATE NULL,
  `hora` INT NULL,
  `min` INT NULL,
  `descricao` VARCHAR(250) NULL,
  `prioridade` INT NULL,
  PRIMARY KEY (`id_veiculo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `agenda_full_local`.`pet`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `agenda_full_local`.`pet` ;

CREATE TABLE IF NOT EXISTS `agenda_full_local`.`pet` (
  `id_pet` INT NOT NULL AUTO_INCREMENT,
  `data` DATE NULL,
  `hora` INT NULL,
  `min` INT NULL,
  `descricao` VARCHAR(250) NULL,
  `prioridade` INT NULL,
  PRIMARY KEY (`id_pet`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `agenda_full_local`.`saude`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `agenda_full_local`.`saude` ;

CREATE TABLE IF NOT EXISTS `agenda_full_local`.`saude` (
  `id_saude` INT NOT NULL AUTO_INCREMENT,
  `data` DATE NULL,
  `hora` INT NULL,
  `min` INT NULL,
  `descricao` VARCHAR(250) NULL,
  `prioridade` INT NULL,
  PRIMARY KEY (`id_saude`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `agenda_full_local`.`profissional`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `agenda_full_local`.`profissional` ;

CREATE TABLE IF NOT EXISTS `agenda_full_local`.`profissional` (
  `id_profissional` INT NOT NULL AUTO_INCREMENT,
  `data` DATE NULL,
  `hora` INT NULL,
  `min` INT NULL,
  `descricao` VARCHAR(250) NULL,
  `prioridade` INT NULL,
  PRIMARY KEY (`id_profissional`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

# Apaga o banco de dados fake_instagram
DROP DATABASE IF EXISTS fake_instagram;

# Criando o banco de dados
CREATE DATABASE fake_instagram;

# Dizendo que vou usar o bd fake_instagram;
USE fake_instagram;

-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema fake_instagram
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema fake_instagram
-- -----------------------------------------------------
-- CREATE SCHEMA IF NOT EXISTS `fake_instagram` DEFAULT CHARACTER SET utf8mb4 ;
-- USE `fake_instagram` ;

-- -----------------------------------------------------
-- Table `fake_instagram`.`usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `fake_instagram`.`usuarios` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `senha` VARCHAR(256) NOT NULL,
  `username` VARCHAR(45) NOT NULL,
  `foto` VARCHAR(100) NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `fake_instagram`.`posts`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `fake_instagram`.`posts` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `media` VARCHAR(100) NULL,
  `tipo` ENUM('video', 'foto') NULL,
  `descricao` VARCHAR(100) NULL,
  `usuario_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_posts_usuarios_idx` (`usuario_id` ASC),
  CONSTRAINT `fk_posts_usuarios`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `fake_instagram`.`usuarios` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `fake_instagram`.`comentarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `fake_instagram`.`comentarios` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `usuario_id` INT NOT NULL,
  `post_id` INT NOT NULL,
  `texto` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_comentarios_post_idx` (`post_id` ASC),
  INDEX `fk_comentarios_usuarios_idx` (`usuario_id` ASC),
  CONSTRAINT `fk_comentarios_post`
    FOREIGN KEY (`post_id`)
    REFERENCES `fake_instagram`.`posts` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_comentarios_usuarios`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `fake_instagram`.`usuarios` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `fake_instagram`.`curtidas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `fake_instagram`.`curtidas` (
  `id` INT NOT NULL,
  `usuario_id` INT NOT NULL,
  `post_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_curtidas_usuarios1_idx` (`usuario_id` ASC),
  INDEX `fk_curtidas_posts1_idx` (`post_id` ASC),
  CONSTRAINT `fk_curtidas_usuarios1`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `fake_instagram`.`usuarios` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_curtidas_posts1`
    FOREIGN KEY (`post_id`)
    REFERENCES `fake_instagram`.`posts` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `fake_instagram`.`seguidores`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `fake_instagram`.`seguidores` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `seguidor_id` INT NULL,
  `seguido_id` INT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_seguidor_idx` (`seguidor_id` ASC),
  INDEX `fk_seguido_idx` (`seguido_id` ASC),
  CONSTRAINT `fk_seguidor`
    FOREIGN KEY (`seguidor_id`)
    REFERENCES `fake_instagram`.`usuarios` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_seguido`
    FOREIGN KEY (`seguido_id`)
    REFERENCES `fake_instagram`.`usuarios` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

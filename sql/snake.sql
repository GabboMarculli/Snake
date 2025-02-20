-- MySQL Script generated by MySQL Workbench
-- Wed Dec  5 12:32:49 2018
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema snake
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `snake` DEFAULT CHARACTER SET utf8 ;
USE `snake` ;

-- -----------------------------------------------------
-- Table `snake`.`Utente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `snake`.`Utente` (
  `userName` VARCHAR(50) NOT NULL,
  `password` VARCHAR(50) NOT NULL,
  `record` INT NULL,
  PRIMARY KEY (`userName`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

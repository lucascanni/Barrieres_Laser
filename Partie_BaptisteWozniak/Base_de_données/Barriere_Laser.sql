-- MySQL Script generated by MySQL Workbench
-- Thu Feb  3 09:33:26 2022
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema bd_barriere_laser
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema bd_barriere_laser
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `bd_barriere_laser` DEFAULT CHARACTER SET latin1 ;
USE `bd_barriere_laser` ;

-- -----------------------------------------------------
-- Table `bd_barriere_laser`.`Utilisateur`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_barriere_laser`.`Utilisateur` (
  `idUtilisateur` INT NOT NULL,
  `login` VARCHAR(50) NULL,
  `password` VARCHAR(50) NULL,
  `email` VARCHAR(50) NULL,
  `privileges` INT NULL,
  PRIMARY KEY (`idUtilisateur`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bd_barriere_laser`.`Alertes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_barriere_laser`.`Alertes` (
  `idAlertes` INT NOT NULL,
  `instantAlerte` DATETIME NULL,
  `alerteEnCours` TINYINT NULL,
  `messageAlerte` MEDIUMTEXT NULL,
  PRIMARY KEY (`idAlertes`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bd_barriere_laser`.`Parametres`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_barriere_laser`.`Parametres` (
  `idParametres` INT NOT NULL,
  `distanceInterBarrieres` FLOAT NULL,
  `repertoireImages` VARCHAR(255) NULL,
  `ipServeur` VARCHAR(15) NULL,
  `ipCam1` VARCHAR(15) NULL,
  `ipCam2` VARCHAR(15) NULL,
  `ipModuleAcquisition` VARCHAR(15) NULL,
  `WIFI_SSID` VARCHAR(50) NULL,
  `WIFI_KEY` VARCHAR(50) NULL,
  `niveauBatterie` INT NULL,
  PRIMARY KEY (`idParametres`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bd_barriere_laser`.`Campagne`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_barriere_laser`.`Campagne` (
  `idCampagne` INT NULL,
  `Description` LONGTEXT NULL,
  `Longitude` VARCHAR(45) NULL,
  `Latitude` VARCHAR(45) NULL,
  PRIMARY KEY (`idCampagne`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bd_barriere_laser`.`Mesures`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_barriere_laser`.`Mesures` (
  `idMesures` INT NOT NULL,
  `instantMesure` DATETIME NULL,
  `intervalle_T11-T12` INT NULL,
  `intervalle_T11-T21` INT NULL,
  `Campagne` INT NOT NULL,
  PRIMARY KEY (`idMesures`, `Campagne`),
  INDEX `idCampagne_idx` (`Campagne` ASC) VISIBLE,
  CONSTRAINT `idCampagne`
    FOREIGN KEY (`Campagne`)
    REFERENCES `bd_barriere_laser`.`Campagne` (`idCampagne`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`Client`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Client` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `first_name` VARCHAR(30) NOT NULL,
  `last_name` VARCHAR(40) NOT NULL,
  `age` VARCHAR(3) NOT NULL,
  `parent` VARCHAR(71) NULL DEFAULT NULL,
  `phone_number` VARCHAR(30) NULL DEFAULT NULL,
  `email` VARCHAR(255) NULL DEFAULT NULL,
  `signed_waiver` TINYINT UNSIGNED NOT NULL,
  `notes` TEXT NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE)
ENGINE = InnoDB
AUTO_INCREMENT = 187
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`Lesson`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Lesson` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `date_of_lesson` DATE NOT NULL,
  `time_of_lesson` TIME NOT NULL,
  `ski_or_snowboard` TINYINT UNSIGNED NOT NULL,
  `client1_id` INT UNSIGNED NOT NULL,
  `client2_id` INT UNSIGNED NULL DEFAULT NULL,
  `client3_id` INT UNSIGNED NULL DEFAULT NULL,
  `level` VARCHAR(3) NULL DEFAULT NULL,
  `reservation_number` INT UNSIGNED NULL DEFAULT NULL,
  `clerk_name` VARCHAR(3) NULL DEFAULT NULL,
  `date_created` DATE NULL DEFAULT NULL,
  `length` FLOAT UNSIGNED NULL DEFAULT NULL,
  `instructor` VARCHAR(70) NULL DEFAULT NULL,
  `desk_or_request` TINYINT UNSIGNED NOT NULL,
  `paid` TINYINT UNSIGNED NOT NULL,
  `checked_in` TINYINT UNSIGNED NOT NULL,
  `finalized_in_sales` TINYINT UNSIGNED NOT NULL,
  `notes` TEXT NULL DEFAULT NULL,
  `receipt_emailed` TINYINT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE)
ENGINE = InnoDB
AUTO_INCREMENT = 82
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

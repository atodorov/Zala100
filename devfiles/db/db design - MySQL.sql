SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `100p` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ;
USE `100p` ;

-- -----------------------------------------------------
-- Table `100p`.`roles`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `100p`.`roles` ;

CREATE  TABLE IF NOT EXISTS `100p`.`roles` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `Name` VARCHAR(50) CHARACTER SET 'utf8' NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 5
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `100p`.`users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `100p`.`users` ;

CREATE  TABLE IF NOT EXISTS `100p`.`users` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `First_Name` VARCHAR(100) CHARACTER SET 'utf8' NOT NULL ,
  `Last_Name` VARCHAR(100) CHARACTER SET 'utf8' NOT NULL ,
  `Role_Id` INT(11) NOT NULL ,
  `FN` INT(11) NOT NULL ,
  `email` VARCHAR(75) CHARACTER SET 'utf8' NOT NULL ,
  `password` VARCHAR(100) CHARACTER SET 'utf8' NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `email` (`email` ASC) ,
  INDEX `FK_Users_Roles` (`Role_Id` ASC) ,
  CONSTRAINT `FK_Users_Roles`
    FOREIGN KEY (`Role_Id` )
    REFERENCES `100p`.`roles` (`id` ))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `100p`.`categories`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `100p`.`categories` ;

CREATE  TABLE IF NOT EXISTS `100p`.`categories` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `Name` VARCHAR(250) CHARACTER SET 'utf8' NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `100p`.`languages`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `100p`.`languages` ;

CREATE  TABLE IF NOT EXISTS `100p`.`languages` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `Name` VARCHAR(25) CHARACTER SET 'utf8' NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `100p`.`books`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `100p`.`books` ;

CREATE  TABLE IF NOT EXISTS `100p`.`books` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `Name` VARCHAR(250) CHARACTER SET 'utf8' NOT NULL ,
  `Author` VARCHAR(200) CHARACTER SET 'utf8' NOT NULL ,
  `Year_Of_Publish` INT(11) NOT NULL ,
  `Taken_By_User_Id` INT(11) NULL DEFAULT NULL ,
  `Category_Id` INT(11) NOT NULL ,
  `Language_Id` INT(11) NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `FK_Books_Categories` (`Category_Id` ASC) ,
  INDEX `FK_Books_Languages` (`Language_Id` ASC) ,
  INDEX `FK_Books_Users` (`Taken_By_User_Id` ASC) ,
  CONSTRAINT `FK_Books_Users`
    FOREIGN KEY (`Taken_By_User_Id` )
    REFERENCES `100p`.`users` (`id` ),
  CONSTRAINT `FK_Books_Categories`
    FOREIGN KEY (`Category_Id` )
    REFERENCES `100p`.`categories` (`id` ),
  CONSTRAINT `FK_Books_Languages`
    FOREIGN KEY (`Language_Id` )
    REFERENCES `100p`.`languages` (`id` ))
ENGINE = InnoDB
AUTO_INCREMENT = 9
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `100p`.`book_comments`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `100p`.`book_comments` ;

CREATE  TABLE IF NOT EXISTS `100p`.`book_comments` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `Book_Id` INT(11) NOT NULL ,
  `Comment_Text` MEDIUMTEXT CHARACTER SET 'utf8' NOT NULL ,
  `User_Id` INT(11) NOT NULL ,
  `Time` DATETIME NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `FK_Book_Comments_Books` (`Book_Id` ASC) ,
  INDEX `FK_Book_Comments_Users` (`User_Id` ASC) ,
  CONSTRAINT `FK_Book_Comments_Users`
    FOREIGN KEY (`User_Id` )
    REFERENCES `100p`.`users` (`id` ),
  CONSTRAINT `FK_Book_Comments_Books`
    FOREIGN KEY (`Book_Id` )
    REFERENCES `100p`.`books` (`id` ))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `100p`.`clubs`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `100p`.`clubs` ;

CREATE  TABLE IF NOT EXISTS `100p`.`clubs` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `Name` VARCHAR(100) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL ,
  `Description` MEDIUMTEXT CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `100p`.`club_members`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `100p`.`club_members` ;

CREATE  TABLE IF NOT EXISTS `100p`.`club_members` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `User_Id` INT(11) NOT NULL ,
  `Club_Id` INT(11) NOT NULL ,
  `Is_Admin` TINYINT(4) NOT NULL ,
  `Is_Active` TINYINT(4) NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `FK_Club_Members_Users_idx` (`User_Id` ASC) ,
  INDEX `FK_Club_Members_Clubs_idx` (`Club_Id` ASC) ,
  CONSTRAINT `FK_Club_Members_Users`
    FOREIGN KEY (`User_Id` )
    REFERENCES `100p`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_Club_Members_Clubs`
    FOREIGN KEY (`Club_Id` )
    REFERENCES `100p`.`clubs` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `100p`.`news`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `100p`.`news` ;

CREATE  TABLE IF NOT EXISTS `100p`.`news` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `Title` VARCHAR(100) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL ,
  `Text` MEDIUMTEXT CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL ,
  `Time` DATETIME NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `100p`.`club_news`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `100p`.`club_news` ;

CREATE  TABLE IF NOT EXISTS `100p`.`club_news` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `News_Id` INT(11) NOT NULL ,
  `Club_Id` INT(11) NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `FK_Club_News_News_idx` (`News_Id` ASC) ,
  INDEX `FK_Club_News_Clubs_idx` (`Club_Id` ASC) ,
  CONSTRAINT `FK_Club_News_News`
    FOREIGN KEY (`News_Id` )
    REFERENCES `100p`.`news` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_Club_News_Clubs`
    FOREIGN KEY (`Club_Id` )
    REFERENCES `100p`.`clubs` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `100p`.`rating`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `100p`.`rating` ;

CREATE  TABLE IF NOT EXISTS `100p`.`rating` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `User_Id` INT(11) NOT NULL ,
  `Book_Id` INT(11) NOT NULL ,
  `Rated` FLOAT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `FK_Rating_Books` (`Book_Id` ASC) ,
  INDEX `FK_Rating_Users` (`User_Id` ASC) ,
  CONSTRAINT `FK_Rating_Users`
    FOREIGN KEY (`User_Id` )
    REFERENCES `100p`.`users` (`id` ),
  CONSTRAINT `FK_Rating_Books`
    FOREIGN KEY (`Book_Id` )
    REFERENCES `100p`.`books` (`id` ))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;

USE `100p` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

INSERT INTO Roles (Name) 
	VALUES("Site Admin"),
	("Room Admin"),
	("News Admin"),
	("User")
;

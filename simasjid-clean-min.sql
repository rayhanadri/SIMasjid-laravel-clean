-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='';

-- -----------------------------------------------------
-- Schema simasjid
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema simasjid
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `simasjid` DEFAULT CHARACTER SET utf8 ;
USE `simasjid` ;

-- -----------------------------------------------------
-- Table `simasjid`.`anggota`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simasjid`.`anggota` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `id_jabatan` INT NULL,
  `id_status` INT NULL,
  `username` VARCHAR(20) NULL,
  `password` VARCHAR(255) NULL,
  `nama` VARCHAR(255) NULL,
  `alamat` TEXT NULL,
  `telp` VARCHAR(20) NULL,
  `email` VARCHAR(255) NOT NULL,
  `link_foto` VARCHAR(255) NULL DEFAULT 'public/dist/assets/img/avatar/avatar-1.png',
  `remember_token` VARCHAR(100) NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `simasjid`.`password_resets`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simasjid`.`password_resets` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(255) NULL,
  `token` VARCHAR(255) NULL,
  `created_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `simasjid`.`notifikasi`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simasjid`.`notifikasi` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `id_pembuat` INT NULL,
  `id_penerima` INT NOT NULL,
  `jenis` VARCHAR(100) NULL,
  `msg` VARCHAR(255) NULL,
  `sudah_baca` INT NULL DEFAULT 0,
  `icon` VARCHAR(100) NULL,
  `bg` VARCHAR(100) NULL,
  `link` VARCHAR(255) NULL,
  `tgl_dibuat` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_notifikasi_anggota1_idx` (`id_pembuat` ASC),
  INDEX `fk_notifikasi_anggota2_idx` (`id_penerima` ASC),
  CONSTRAINT `fk_notifikasi_anggota1`
    FOREIGN KEY (`id_pembuat`)
    REFERENCES `simasjid`.`anggota` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_notifikasi_anggota2`
    FOREIGN KEY (`id_penerima`)
    REFERENCES `simasjid`.`anggota` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

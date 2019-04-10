ALTER TABLE `systemcl_clinica`.`tratamiento` 
ADD COLUMN `img` TEXT NULL AFTER `status`,
CHANGE COLUMN `nombre` `nombre` VARCHAR(100) NULL DEFAULT NULL ,
CHANGE COLUMN `comentarios` `comentarios` TEXT NULL DEFAULT NULL ;

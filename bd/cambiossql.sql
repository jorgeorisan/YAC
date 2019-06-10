
SET SQL_SAFE_UPDATES =  0;


ALTER TABLE `xqwmrfeeug`.`venta` 
ADD COLUMN `fecha_registro` TIMESTAMP NULL DEFAULT current_timestamp AFTER `descuento`,
CHANGE COLUMN `fecha` `fecha` TIMESTAMP NULL DEFAULT NULL ;
ALTER TABLE `xqwmrfeeug`.`venta` 
ADD COLUMN `id_user_registro` INT NULL AFTER `fecha_registro`;


INSERT INTO `xqwmrfeeug`.`permiso` (`nombre`, `section`, `page`) VALUES ('Pacientes ', 'Pacientes', 'index');
INSERT INTO `xqwmrfeeug`.`permiso` (`nombre`, `section`, `page`) VALUES ('Pacientes Consulta', 'Pacientes', 'consulta');
INSERT INTO `xqwmrfeeug`.`permiso` (`nombre`, `section`, `page`) VALUES ('Pacientes Borrar', 'Pacientes', 'personadelete');
INSERT INTO `xqwmrfeeug`.`permiso` (`nombre`, `section`, `page`) VALUES ('Pacientes Ver', 'Pacientes', 'view');

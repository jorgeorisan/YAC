-- 09 abril 2019
DROP TABLE `xqwmrfeeug`.`ventascorte1`;


 -- ------------------------------------
 -- cambios nuevo skin
 ALTER TABLE `xqwmrfeeug`.`venta` 
DROP FOREIGN KEY `id_usuar_vta_dx`;
ALTER TABLE `xqwmrfeeug`.`venta` 
DROP INDEX `fk_venta_usuario1_idx` ;
;

ALTER TABLE `xqwmrfeeug`.`asistencia` 
DROP FOREIGN KEY `fk_asistencia_usuario1`;
ALTER TABLE `xqwmrfeeug`.`asistencia` 
DROP INDEX `fk_asistencia_usuario1` ;
;
DROP TABLE `xqwmrfeeug`.`datos_facturacion`;
DROP TABLE `xqwmrfeeug`.`inventariocostomensual`;

DROP TABLE `xqwmrfeeug`.`descgastos_comision`;
DROP TABLE `xqwmrfeeug`.`comisiones_vendedor`;
DROP TABLE `xqwmrfeeug`.`comisiones`;

ALTER TABLE `xqwmrfeeug`.`salida` 
DROP FOREIGN KEY `id_usua_sal_dx`;
ALTER TABLE `xqwmrfeeug`.`salida` 
DROP INDEX `id_usu_idx` ;
;

ALTER TABLE `xqwmrfeeug`.`entrada` 
DROP FOREIGN KEY `fk_entrada_usuario1`;
ALTER TABLE `xqwmrfeeug`.`entrada` 
DROP INDEX `fk_entrada_usuario1_idx` ;
;

ALTER TABLE `xqwmrfeeug`.`usuario` 
ADD COLUMN `id` INT NULL FIRST;

UPDATE `xqwmrfeeug`.`usuario` SET `id` = '1' WHERE (`id_usuario` = 'Adriana');
UPDATE `xqwmrfeeug`.`usuario` SET `id` = '2' WHERE (`id_usuario` = 'Alex');
UPDATE `xqwmrfeeug`.`usuario` SET `id` = '3' WHERE (`id_usuario` = 'Angel');
UPDATE `xqwmrfeeug`.`usuario` SET `id` = '4' WHERE (`id_usuario` = 'anny');
UPDATE `xqwmrfeeug`.`usuario` SET `id` = '5' WHERE (`id_usuario` = 'Azarel');
UPDATE `xqwmrfeeug`.`usuario` SET `id` = '6' WHERE (`id_usuario` = 'Elena');
UPDATE `xqwmrfeeug`.`usuario` SET `id` = '7' WHERE (`id_usuario` = 'Fanny Casas');
UPDATE `xqwmrfeeug`.`usuario` SET `id` = '8' WHERE (`id_usuario` = 'Ingrid');
UPDATE `xqwmrfeeug`.`usuario` SET `id` = '9' WHERE (`id_usuario` = 'jazmin');
UPDATE `xqwmrfeeug`.`usuario` SET `id` = '10' WHERE (`id_usuario` = 'jorge');
UPDATE `xqwmrfeeug`.`usuario` SET `id` = '11' WHERE (`id_usuario` = 'Lizzy');
UPDATE `xqwmrfeeug`.`usuario` SET `id` = '12' WHERE (`id_usuario` = 'luis');
UPDATE `xqwmrfeeug`.`usuario` SET `id` = '13' WHERE (`id_usuario` = 'Lulu');
UPDATE `xqwmrfeeug`.`usuario` SET `id` = '14' WHERE (`id_usuario` = 'Luz Maria');
UPDATE `xqwmrfeeug`.`usuario` SET `id` = '15' WHERE (`id_usuario` = 'Paola');
UPDATE `xqwmrfeeug`.`usuario` SET `id` = '16' WHERE (`id_usuario` = 'prueba');
UPDATE `xqwmrfeeug`.`usuario` SET `id` = '17' WHERE (`id_usuario` = 'Rubi');
UPDATE `xqwmrfeeug`.`usuario` SET `id` = '18' WHERE (`id_usuario` = 'Susy');
UPDATE `xqwmrfeeug`.`usuario` SET `id` = '19' WHERE (`id_usuario` = 'tavo');
UPDATE `xqwmrfeeug`.`usuario` SET `id` = '20' WHERE (`id_usuario` = 'vendedor1');
UPDATE `xqwmrfeeug`.`usuario` SET `id` = '21' WHERE (`id_usuario` = 'vendedor2');
UPDATE `xqwmrfeeug`.`usuario` SET `id` = '22' WHERE (`id_usuario` = 'Xiadany');
UPDATE `xqwmrfeeug`.`usuario` SET `id` = '23' WHERE (`id_usuario` = 'Yazmin');
UPDATE `xqwmrfeeug`.`usuario` SET `id` = '24' WHERE (`id_usuario` = 'Yesenia');


ALTER TABLE `xqwmrfeeug`.`usuario` 
CHANGE COLUMN `id` `id` INT(11) NOT NULL ,
DROP PRIMARY KEY,
ADD PRIMARY KEY (`id_usuario`, `id`);
;


ALTER TABLE `xqwmrfeeug`.`usuario` 
CHANGE COLUMN `password` `password` TEXT NULL DEFAULT NULL ;



CREATE TABLE `permiso` (
   `id` int(11) NOT NULL AUTO_INCREMENT,
   `nombre` varchar(100) DEFAULT NULL,
   `section` varchar(100) DEFAULT NULL,
   `page` varchar(100) DEFAULT NULL,
   `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
   `updated_date` timestamp NULL DEFAULT NULL,
   `deleted_date` timestamp NULL DEFAULT NULL,
   `status` varchar(45) DEFAULT 'active',
   PRIMARY KEY (`id`)
 ) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8

 CREATE TABLE `permiso_usuario` (
   `id` int(11) NOT NULL AUTO_INCREMENT,
   `id_permiso` int(11) DEFAULT NULL,
   `id_usuario` int(11) DEFAULT NULL,
   `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
   PRIMARY KEY (`id`))
   ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

ALTER TABLE `xqwmrfeeug`.`permiso_usuario` 
ADD CONSTRAINT `id_permiso_usuario_dx`
  FOREIGN KEY (`id_permiso`)
  REFERENCES `xqwmrfeeug`.`permiso` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

  ALTER TABLE `xqwmrfeeug`.`traspaso` 
DROP FOREIGN KEY `id_usu_tp_dx`;
ALTER TABLE `xqwmrfeeug`.`traspaso` 
DROP INDEX `id_usu_idx` ;
;


ALTER TABLE `xqwmrfeeug`.`usuario` 
DROP PRIMARY KEY,
ADD PRIMARY KEY (`id`);
;

ALTER TABLE `xqwmrfeeug`.`usuario` 
CHANGE COLUMN `id` `id` INT(11) NOT NULL AUTO_INCREMENT ;


ALTER TABLE `xqwmrfeeug`.`permiso_usuario` 
ADD CONSTRAINT `id_usuario_permisousuario_dx`
  FOREIGN KEY (`id_usuario`)
  REFERENCES `xqwmrfeeug`.`usuario` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;


INSERT INTO `xqwmrfeeug`.`permiso` (`nombre`, `section`, `page`) VALUES ('Usuarios', 'Users', 'index');
INSERT INTO `xqwmrfeeug`.`permiso` (`nombre`, `section`, `page`) VALUES ('Usuarios Alta', 'Users', 'add');
INSERT INTO `xqwmrfeeug`.`permiso` (`nombre`, `section`, `page`) VALUES ('Usuarios Editar', 'Users', 'edit');
INSERT INTO `xqwmrfeeug`.`permiso` (`nombre`, `section`, `page`) VALUES ('Usuarios Borrar', 'Users', 'userdelete');
INSERT INTO `xqwmrfeeug`.`permiso` (`nombre`, `section`, `page`) VALUES ('Usuarios Cambiar Password', 'Users', 'changepassword');
INSERT INTO `xqwmrfeeug`.`permiso` (`nombre`, `section`, `page`) VALUES ('Usuarios Perfiles', 'Users', 'usertype');
INSERT INTO `xqwmrfeeug`.`permiso` (`nombre`, `section`, `page`) VALUES ('Usuarios Perfiles Borrar', 'Users', 'usertypedelete');
INSERT INTO `xqwmrfeeug`.`permiso` (`nombre`, `section`, `page`) VALUES ('Permisos', 'Permisos', 'index');
INSERT INTO `xqwmrfeeug`.`permiso` (`nombre`, `section`, `page`) VALUES ('Permisos Asignar', 'Permisos', 'asignar');
INSERT INTO `xqwmrfeeug`.`permiso` (`nombre`, `section`, `page`) VALUES ('Permiso Tipos de Usuario', 'Permisos', 'asignartipouser');
INSERT INTO `xqwmrfeeug`.`permiso` (`nombre`, `section`, `page`) VALUES ('Usuarios Perfiles Alta', 'Users', 'usertypeadd');
INSERT INTO `xqwmrfeeug`.`permiso` (`nombre`, `section`, `page`) VALUES ('Usuarios Perfiles Editar', 'Users', 'usertypeedit');


INSERT INTO `xqwmrfeeug`.`permiso_usuario` (`id_permiso`, `id_usuario`) VALUES ('1', '10');
INSERT INTO `xqwmrfeeug`.`permiso_usuario` (`id_permiso`, `id_usuario`) VALUES ('2', '10');
INSERT INTO `xqwmrfeeug`.`permiso_usuario` (`id_permiso`, `id_usuario`) VALUES ('3', '10');
INSERT INTO `xqwmrfeeug`.`permiso_usuario` (`id_permiso`, `id_usuario`) VALUES ('4', '10');
INSERT INTO `xqwmrfeeug`.`permiso_usuario` (`id_permiso`, `id_usuario`) VALUES ('5', '10');
INSERT INTO `xqwmrfeeug`.`permiso_usuario` (`id_permiso`, `id_usuario`) VALUES ('6', '10');
INSERT INTO `xqwmrfeeug`.`permiso_usuario` (`id_permiso`, `id_usuario`) VALUES ('7', '10');
INSERT INTO `xqwmrfeeug`.`permiso_usuario` (`id_permiso`, `id_usuario`) VALUES ('8', '10');
INSERT INTO `xqwmrfeeug`.`permiso_usuario` (`id_permiso`, `id_usuario`) VALUES ('9', '10');
INSERT INTO `xqwmrfeeug`.`permiso_usuario` (`id_permiso`, `id_usuario`) VALUES ('10', '10');
INSERT INTO `xqwmrfeeug`.`permiso_usuario` (`id_permiso`, `id_usuario`) VALUES ('11', '10');
INSERT INTO `xqwmrfeeug`.`permiso_usuario` (`id_permiso`, `id_usuario`) VALUES ('12', '10');

UPDATE `xqwmrfeeug`.`permiso` SET `section` = 'Usuarios' WHERE (`id` = '1');
UPDATE `xqwmrfeeug`.`permiso` SET `section` = 'Usuarios' WHERE (`id` = '2');
UPDATE `xqwmrfeeug`.`permiso` SET `section` = 'Usuarios' WHERE (`id` = '3');
UPDATE `xqwmrfeeug`.`permiso` SET `section` = 'Usuarios', `page` = 'usuariosdelete' WHERE (`id` = '4');
UPDATE `xqwmrfeeug`.`permiso` SET `section` = 'Usuarios' WHERE (`id` = '5');
UPDATE `xqwmrfeeug`.`permiso` SET `section` = 'Usuarios' WHERE (`id` = '7');
UPDATE `xqwmrfeeug`.`permiso` SET `section` = 'Usuarios' WHERE (`id` = '6');


ALTER TABLE `xqwmrfeeug`.`usuario` 
ADD COLUMN `direccion` TEXT NULL AFTER `comision`;



CREATE TABLE `cita` (
   `id` int(11) NOT NULL AUTO_INCREMENT,
   `id_tienda` int(11) DEFAULT NULL,
   `id_personal` int(11) DEFAULT NULL,
   `id_usuario` int(11) DEFAULT NULL,
   `id_usuarioalta` int(11) DEFAULT NULL,
   `motivo` text CHARACTER SET latin1,
   `status` varchar(45) CHARACTER SET latin1 DEFAULT 'active',
   `fecha_inicial` timestamp NULL DEFAULT NULL,
   `fecha_final` timestamp NULL DEFAULT NULL,
   `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
   `updated_date` timestamp NULL DEFAULT NULL,
   `deleted_date` timestamp NULL DEFAULT NULL,
   PRIMARY KEY (`id`)) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;


ALTER TABLE `xqwmrfeeug`.`cita` 
CHANGE COLUMN `id_personal` `id_personal` BIGINT(20) NULL DEFAULT NULL ;

ALTER TABLE `xqwmrfeeug`.`cita` 
ADD CONSTRAINT `id_tienda_cita_dx`
  FOREIGN KEY (`id_tienda`)
  REFERENCES `xqwmrfeeug`.`tienda` (`id_tienda`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `id_usuario_cita_dx`
  FOREIGN KEY (`id_usuario`)
  REFERENCES `xqwmrfeeug`.`usuario` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `id_usuarioalta_cita_dx`
  FOREIGN KEY (`id_usuarioalta`)
  REFERENCES `xqwmrfeeug`.`usuario` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;


ALTER TABLE `xqwmrfeeug`.`cita` 
CHANGE COLUMN `id_personal` `id_persona` BIGINT(20) NULL DEFAULT NULL ;
ALTER TABLE `xqwmrfeeug`.`cita` 
ADD CONSTRAINT `id_persona_cita_dx`
  FOREIGN KEY (`id_persona`)
  REFERENCES `xqwmrfeeug`.`persona` (`id_persona`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;


  INSERT INTO `xqwmrfeeug`.`permiso` (`nombre`, `section`, `page`) VALUES ('Clientes', 'Clientes', 'index');
INSERT INTO `xqwmrfeeug`.`permiso` (`nombre`, `section`, `page`) VALUES ('Clientes Alta', 'Clientes', 'add');
INSERT INTO `xqwmrfeeug`.`permiso` (`nombre`, `section`, `page`) VALUES ('Clientes Editar', 'Clientes', 'edit');
INSERT INTO `xqwmrfeeug`.`permiso` (`nombre`, `section`, `page`) VALUES ('Clientes Borrar', 'Clientes', 'personadelete');
INSERT INTO `xqwmrfeeug`.`permiso` (`nombre`, `section`, `page`) VALUES ('Citas', 'Citas', 'index');
INSERT INTO `xqwmrfeeug`.`permiso` (`nombre`, `section`, `page`) VALUES ('Citas Alta', 'Citas', 'add');
INSERT INTO `xqwmrfeeug`.`permiso` (`nombre`, `section`, `page`) VALUES ('Citas Editar', 'Citas', 'edit');
INSERT INTO `xqwmrfeeug`.`permiso` (`nombre`, `section`, `page`) VALUES ('Citas Borrar', 'Citas', 'citadelete');


ALTER TABLE `xqwmrfeeug`.`persona` 
ADD COLUMN `alergias` TEXT NULL AFTER `celular`;


INSERT INTO `xqwmrfeeug`.`permiso` (`nombre`, `section`, `page`) VALUES ('Catalogos Categoria', 'Catalogos', 'categoria');
INSERT INTO `xqwmrfeeug`.`permiso` (`nombre`, `section`, `page`) VALUES ('Catalogos Categoria Alta', 'Catalogos', 'categoriaadd');
INSERT INTO `xqwmrfeeug`.`permiso` (`nombre`, `section`, `page`) VALUES ('Catalogos Categoria Editar', 'Catalogos', 'categoriaedit');
INSERT INTO `xqwmrfeeug`.`permiso` (`nombre`, `section`, `page`) VALUES ('Catalogos Categoria Borrar', 'Catalogos', 'categoriadelete');
INSERT INTO `xqwmrfeeug`.`permiso` (`nombre`, `section`, `page`) VALUES ('Catalogos Marca', 'Catalogos', 'marca');
INSERT INTO `xqwmrfeeug`.`permiso` (`nombre`, `section`, `page`) VALUES ('Catalogos Marca Alta', 'Catalogos', 'marcaadd');
INSERT INTO `xqwmrfeeug`.`permiso` (`nombre`, `section`, `page`) VALUES ('Catalogos Marca Editar', 'Catalogos', 'marcaedit');
INSERT INTO `xqwmrfeeug`.`permiso` (`nombre`, `section`, `page`) VALUES ('Catalogos Marca Borrar', 'Catalogos', 'marcadelete');
INSERT INTO `xqwmrfeeug`.`permiso` (`nombre`, `section`, `page`) VALUES ('Catalogos Usuarios Tipo', 'Catalogos', 'usuariotipo');
INSERT INTO `xqwmrfeeug`.`permiso` (`nombre`, `section`, `page`) VALUES ('Catalogos Usuarios Tipo Alta', 'Catalogos', 'usuariotipoadd');
INSERT INTO `xqwmrfeeug`.`permiso` (`nombre`, `section`, `page`) VALUES ('Catalogos Usuarios Tipo Editar', 'Catalogos', 'usuariotipoedit');
INSERT INTO `xqwmrfeeug`.`permiso` (`nombre`, `section`, `page`) VALUES ('Catalogos Usuarios Tipo Borrar', 'Catalogos', 'usuariotipodelete');
INSERT INTO `xqwmrfeeug`.`permiso` (`nombre`, `section`, `page`) VALUES ('Catalogos Tienda', 'Catalogos', 'tienda');
INSERT INTO `xqwmrfeeug`.`permiso` (`nombre`, `section`, `page`) VALUES ('Catalogos Tienda Alta', 'Catalogos', 'tiendaadd');
INSERT INTO `xqwmrfeeug`.`permiso` (`nombre`, `section`, `page`) VALUES ('Catalogos Tienda Editar', 'Catalogos', 'tiendaedit');
INSERT INTO `xqwmrfeeug`.`permiso` (`nombre`, `section`, `page`) VALUES ('Catalogos Tienda Borrar', 'Catalogos', 'tiendadelete');

ALTER TABLE `xqwmrfeeug`.`marca` 
ADD COLUMN `status` VARCHAR(45) NULL DEFAULT 'active' AFTER `descuento_activado`;


ALTER TABLE `xqwmrfeeug`.`usuario_tipo` 
ADD COLUMN `status` VARCHAR(45) NULL DEFAULT 'active' AFTER `usuario_tipo`;

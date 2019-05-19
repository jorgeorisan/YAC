
SET SQL_SAFE_UPDATES =  0;
-- 09 abril 2019
DROP TABLE `xqwmrfeeug`.`ventascorte1`;


 -- ------------------------------------
 -- cambios nuevo skin
 ALTER TABLE `xqwmrfeeug`.`venta` 
DROP FOREIGN KEY `id_usuar_vta_dx`;
ALTER TABLE `xqwmrfeeug`.`venta` 
DROP INDEX `fk_venta_usuario1_idx` ;


ALTER TABLE `xqwmrfeeug`.`asistencia` 
DROP FOREIGN KEY `fk_asistencia_usuario1`;
ALTER TABLE `xqwmrfeeug`.`asistencia` 
DROP INDEX `fk_asistencia_usuario1` ;

DROP TABLE `xqwmrfeeug`.`datos_facturacion`;
DROP TABLE `xqwmrfeeug`.`inventariocostomensual`;

DROP TABLE `xqwmrfeeug`.`descgastos_comision`;
DROP TABLE `xqwmrfeeug`.`comisiones_vendedor`;
DROP TABLE `xqwmrfeeug`.`comisiones`;

ALTER TABLE `xqwmrfeeug`.`salida` 
DROP FOREIGN KEY `id_usua_sal_dx`;
ALTER TABLE `xqwmrfeeug`.`salida` 
DROP INDEX `id_usu_idx` ;


ALTER TABLE `xqwmrfeeug`.`entrada` 
DROP FOREIGN KEY `fk_entrada_usuario1`;
ALTER TABLE `xqwmrfeeug`.`entrada` 
DROP INDEX `fk_entrada_usuario1_idx` ;


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
 ) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

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



ALTER TABLE `xqwmrfeeug`.`usuario` 
DROP PRIMARY KEY,
ADD PRIMARY KEY (`id`);


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


INSERT INTO `xqwmrfeeug`.`permiso` (`nombre`, `section`, `page`) VALUES ('Productos', 'Productos', 'index');
INSERT INTO `xqwmrfeeug`.`permiso` (`nombre`, `section`, `page`) VALUES ('Productos Borrar', 'Productos', 'productodelete');
INSERT INTO `xqwmrfeeug`.`permiso` (`nombre`, `section`, `page`) VALUES ('Productos Alta', 'Productos', 'add');
INSERT INTO `xqwmrfeeug`.`permiso` (`nombre`, `section`, `page`) VALUES ('Productos Editar', 'Productos', 'edit');

ALTER TABLE `xqwmrfeeug`.`usuario` 
ADD COLUMN `costos` VARCHAR(45) NULL DEFAULT 0 AFTER `direccion`;

UPDATE `xqwmrfeeug`.`usuario` SET `costos` = '1' WHERE (`id` = '10');
INSERT INTO `xqwmrfeeug`.`permiso` (`nombre`, `section`, `page`) VALUES ('Productos Ver', 'Productos', 'view');

ALTER TABLE `xqwmrfeeug`.`producto` 
CHANGE COLUMN `id_proveedor` `id_proveedor` INT(11) NOT NULL AFTER `id_producto`,
CHANGE COLUMN `id_marca` `id_marca` INT(11) NOT NULL AFTER `id_proveedor`,
CHANGE COLUMN `id_categoria` `id_categoria` INT(11) NOT NULL AFTER `id_marca`;
ALTER TABLE `xqwmrfeeug`.`producto` 
CHANGE COLUMN `condiciones` `condiciones` VARCHAR(45) NULL ;

ALTER TABLE `xqwmrfeeug`.`marca` 
CHANGE COLUMN `descuento_activado` `descuento_activado` INT NULL DEFAULT '0' ;
ALTER TABLE `xqwmrfeeug`.`producto` 
ADD COLUMN `updated_date` TIMESTAMP NULL AFTER `precio_editable`;

ALTER TABLE `xqwmrfeeug`.`producto` 
ADD COLUMN `deleted_date` TIMESTAMP NULL AFTER `updated_date`;

ALTER TABLE `xqwmrfeeug`.`usuario_tipo` 
ADD COLUMN `comentarios` TEXT NULL AFTER `status`;

UPDATE `xqwmrfeeug`.`permiso` SET `section` = 'Usuarios' WHERE (`id` = '11');
UPDATE `xqwmrfeeug`.`permiso` SET `section` = 'Usuarios' WHERE (`id` = '12');

INSERT INTO `xqwmrfeeug`.`permiso` (`nombre`, `section`, `page`) VALUES ('Ventas Alta', 'Ventas', 'add');
INSERT INTO `xqwmrfeeug`.`permiso` (`nombre`, `section`, `page`) VALUES ('Ventas Editar', 'Ventas', 'edit');
INSERT INTO `xqwmrfeeug`.`permiso` (`nombre`, `section`, `page`) VALUES ('Ventas Ver', 'Ventas', 'view');
INSERT INTO `xqwmrfeeug`.`permiso` (`nombre`, `section`, `page`) VALUES ('Ventas Reporte', 'Ventas', 'index');
INSERT INTO `xqwmrfeeug`.`permiso` (`nombre`, `section`, `page`) VALUES ('Ventas a Credito', 'Ventas', 'credito');


ALTER TABLE `xqwmrfeeug`.`productos_venta` 
ADD COLUMN `fecha_registro` TIMESTAMP NULL DEFAULT current_timestamp AFTER `tipoprecio`;
ALTER TABLE `xqwmrfeeug`.`venta` 
ADD COLUMN `fecha_cancelacion` TIMESTAMP NULL AFTER `credencial`;
ALTER TABLE `xqwmrfeeug`.`venta` 
ADD COLUMN `razon_cancelacion` TEXT NULL AFTER `fecha_cancelacion`;
ALTER TABLE `xqwmrfeeug`.`venta` 
ADD COLUMN `usuario_cancelacion` VARCHAR(45) NULL AFTER `razon_cancelacion`;

-- decuento en la venta
ALTER TABLE `xqwmrfeeug`.`venta` 
ADD COLUMN `descuento` DOUBLE NULL DEFAULT 0 AFTER `usuario_cancelacion`;


ALTER TABLE `xqwmrfeeug`.`venta` 
DROP COLUMN `consignacion`,
DROP COLUMN `no_calculable`,
DROP COLUMN `usuariosventa`;

ALTER TABLE `xqwmrfeeug`.`deudores` 
ADD COLUMN `tipo_pago` VARCHAR(45) NULL AFTER `comentarios`;


ALTER TABLE `xqwmrfeeug`.`deudores` 
DROP FOREIGN KEY `id_persona`;
ALTER TABLE `xqwmrfeeug`.`deudores` 
DROP COLUMN `id_persona`,
CHANGE COLUMN `comentarios` `comentarios` VARCHAR(150) NULL ,
DROP INDEX `id_persona_idx` ;


ALTER TABLE `xqwmrfeeug`.`venta` 
DROP COLUMN `ticket_items`;

ALTER TABLE `xqwmrfeeug`.`productos_venta` 
ADD COLUMN `fecha_cancelacion` VARCHAR(45) NULL AFTER `fecha_registro`,
ADD COLUMN `usuario_cancelacion` VARCHAR(45) NULL AFTER `fecha_cancelacion`;
ALTER TABLE `xqwmrfeeug`.`productos_venta` 
ADD COLUMN `razon_cancelacion` TEXT NULL AFTER `usuario_cancelacion`,
CHANGE COLUMN `fecha_cancelacion` `fecha_cancelacion` TIMESTAMP NULL DEFAULT NULL ;

ALTER TABLE `xqwmrfeeug`.`deudores` 
DROP COLUMN `id_tienda`;


ALTER TABLE `xqwmrfeeug`.`tienda` 
ADD COLUMN `rfc` VARCHAR(45) NULL AFTER `permiso_adicional`;

ALTER TABLE `xqwmrfeeug`.`usuario` 
ADD COLUMN `email` VARCHAR(255) NULL AFTER `costos`;

-- arreglar ventas canceladas en productos venta
exit;
primero ejecutar funcion 

$obj = new Venta();
$obj->arreglar_Descuentos();
$obj->arreglar_cancelaciones();
$obj->arreglar_cancelacionesproductos();
$obj->arreglar_precios();

update xqwmrfeeug.productos_venta pv 
JOIN venta v ON pv.id_venta=v.id_venta
set pv.cancelado=1
  where v.cancelado=1 and pv.cancelado=0;

ALTER TABLE `xqwmrfeeug`.`producto_tienda` 
ADD COLUMN `fecha_registro` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP AFTER `usuario_actualizacion`;


INSERT INTO `xqwmrfeeug`.`permiso` (`nombre`, `section`, `page`) VALUES ('Entradas', 'Entradas', 'index');
INSERT INTO `xqwmrfeeug`.`permiso` (`nombre`, `section`, `page`) VALUES ('Entradas Alta', 'Entradas', 'add');
INSERT INTO `xqwmrfeeug`.`permiso` (`nombre`, `section`, `page`) VALUES ('Entradas Borrar', 'Entradas', 'entradadelete');
INSERT INTO `xqwmrfeeug`.`permiso` (`nombre`, `section`, `page`) VALUES ('Entradas Ver', 'Entradas', 'view');
INSERT INTO `xqwmrfeeug`.`permiso` (`nombre`, `section`, `page`) VALUES ('Traspasos', 'Traspasos', 'index');
INSERT INTO `xqwmrfeeug`.`permiso` (`nombre`, `section`, `page`) VALUES ('Traspasos Alta', 'Traspasos', 'add');
INSERT INTO `xqwmrfeeug`.`permiso` (`nombre`, `section`, `page`) VALUES ('Traspasos Borrar', 'Traspasos', 'traspasodelete');
INSERT INTO `xqwmrfeeug`.`permiso` (`nombre`, `section`, `page`) VALUES ('Traspasos Ver', 'Traspasos', 'view');
INSERT INTO `xqwmrfeeug`.`permiso` (`nombre`, `section`, `page`) VALUES ('Salidas', 'Salidas', 'index');
INSERT INTO `xqwmrfeeug`.`permiso` (`nombre`, `section`, `page`) VALUES ('Salidas Alta', 'Salidas', 'add');
INSERT INTO `xqwmrfeeug`.`permiso` (`nombre`, `section`, `page`) VALUES ('Salidas Borrar', 'Salidas', 'salidadelete');
INSERT INTO `xqwmrfeeug`.`permiso` (`nombre`, `section`, `page`) VALUES ('Salidas Ver', 'Salidas', 'view');


CREATE TABLE `xqwmrfeeug`.`proveedor_compra` (
  `id_proveedor_compra` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL,
  `status` VARCHAR(45) NULL DEFAULT 'ACTIVO',
  PRIMARY KEY (`id_proveedor_compra`));

INSERT INTO `xqwmrfeeug`.`proveedor_compra` (`id_proveedor_compra`, `nombre`) VALUES ('1', 'No Asignado');
INSERT INTO `xqwmrfeeug`.`proveedor_compra` (`id_proveedor_compra`, `nombre`) VALUES ('2', 'Brush');
INSERT INTO `xqwmrfeeug`.`proveedor_compra` (`id_proveedor_compra`, `nombre`) VALUES ('3', 'Toop Belleza');
INSERT INTO `xqwmrfeeug`.`proveedor_compra` (`id_proveedor_compra`, `nombre`) VALUES ('4', 'Cosmetiwordl');
INSERT INTO `xqwmrfeeug`.`proveedor_compra` (`id_proveedor_compra`, `nombre`) VALUES ('5', 'Kahal');
INSERT INTO `xqwmrfeeug`.`proveedor_compra` (`id_proveedor_compra`, `nombre`) VALUES ('6', 'Lentes');

ALTER TABLE `xqwmrfeeug`.`proveedor_compra` 
ADD COLUMN `telefono` VARCHAR(45) NULL AFTER `status`,
ADD COLUMN `direccion` VARCHAR(200) NULL AFTER `telefono`,
ADD COLUMN `email` VARCHAR(105) NULL AFTER `direccion`;

ALTER TABLE `xqwmrfeeug`.`entrada` 
ADD COLUMN `id_proveedorcompra` INT NULL AFTER `id_entrada`,
ADD COLUMN `tipo_pago` VARCHAR(45) NULL AFTER `ticket_items`,
CHANGE COLUMN `id_tienda` `id_tienda` INT(11) NOT NULL DEFAULT '6' AFTER `id_proveedorcompra`,
CHANGE COLUMN `id_usuario` `id_usuario` VARCHAR(45) NOT NULL AFTER `id_tienda`;
ALTER TABLE `xqwmrfeeug`.`entrada` 
ADD CONSTRAINT `id_proveedorcompra_dx`
  FOREIGN KEY (`id_proveedorcompra`)
  REFERENCES `xqwmrfeeug`.`proveedor_compra` (`id_proveedor_compra`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

UPDATE `xqwmrfeeug`.`permiso` SET `page` = 'apartado' WHERE (`id` = '46');

update venta set tipo='Apartado' where tipo='Credito';

ALTER TABLE `xqwmrfeeug`.`tienda` 
ADD COLUMN `abreviacion` VARCHAR(45) NULL AFTER `rfc`;

UPDATE `xqwmrfeeug`.`tienda` SET `abreviacion` = 'YAC' WHERE (`id_tienda` = '13');
UPDATE `xqwmrfeeug`.`tienda` SET `abreviacion` = 'ZARAGOZA' WHERE (`id_tienda` = '15');
UPDATE `xqwmrfeeug`.`tienda` SET `abreviacion` = 'URBAN' WHERE (`id_tienda` = '16');
UPDATE `xqwmrfeeug`.`tienda` SET `abreviacion` = 'ALMACEN' WHERE (`id_tienda` = '12');
ALTER TABLE `xqwmrfeeug`.`entrada` 
ADD COLUMN `icredito` INT NULL DEFAULT 0 AFTER `tipo_pago`;


ALTER TABLE `xqwmrfeeug`.`entrada_producto` 
DROP COLUMN `ieps`,
DROP COLUMN `cantvendida`,
DROP COLUMN `iva`,
DROP COLUMN `multiplicador`,
CHANGE COLUMN `nombre` `nombre` VARCHAR(100) NULL DEFAULT NULL AFTER `id_producto`,
CHANGE COLUMN `fechare_gistro` `fecha_registro` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP AFTER `precio_costo`;

ALTER TABLE `xqwmrfeeug`.`entrada_producto` 
CHANGE COLUMN `precio_descuento` `mayoreo` DOUBLE NULL DEFAULT NULL AFTER `costo`;
ALTER TABLE `xqwmrfeeug`.`proveedor_compra` 
CHANGE COLUMN `id_proveedor_compra` `id_proveedorcompra` INT(11) NOT NULL AUTO_INCREMENT ;

ALTER TABLE `xqwmrfeeug`.`entrada` 
ADD COLUMN `fecha_validacion` VARCHAR(45) NULL AFTER `icredito`,
ADD COLUMN `usuario_validacion` TIMESTAMP NULL AFTER `fecha_validacion`,
ADD COLUMN `usuario_deleted` VARCHAR(45) NULL AFTER `usuario_validacion`,
ADD COLUMN `deleted_date` TIMESTAMP NULL AFTER `usuario_deleted`;

ALTER TABLE `xqwmrfeeug`.`traspaso` 
ADD COLUMN `fecha_validacion` VARCHAR(45) NULL AFTER `status`,
ADD COLUMN `usuario_validacion` TIMESTAMP NULL AFTER `fecha_validacion`,
ADD COLUMN `usuario_deleted` VARCHAR(45) NULL AFTER `usuario_validacion`,
ADD COLUMN `deleted_date` TIMESTAMP NULL AFTER `usuario_deleted`;

ALTER TABLE `xqwmrfeeug`.`salida` 
ADD COLUMN `fecha_validacion` VARCHAR(45) NULL AFTER `status`,
ADD COLUMN `usuario_validacion` TIMESTAMP NULL AFTER `fecha_validacion`,
ADD COLUMN `usuario_deleted` VARCHAR(45) NULL AFTER `usuario_validacion`,
ADD COLUMN `deleted_date` TIMESTAMP NULL AFTER `usuario_deleted`;


DROP TABLE `xqwmrfeeug`.`entrada_productocancelado`;
DROP TABLE `xqwmrfeeug`.`venta_productocancelado`;
DROP TABLE `xqwmrfeeug`.`venta_cancelada`;

ALTER TABLE `xqwmrfeeug`.`traspaso_producto` 
DROP COLUMN `cancelado`,
DROP COLUMN `ieps`,
DROP COLUMN `cantvendida`,
DROP COLUMN `iva`,
DROP COLUMN `multiplicador`,
CHANGE COLUMN `id_traspaso` `id_traspaso` INT(11) NOT NULL AFTER `id_producto`,
CHANGE COLUMN `id_tienda` `id_tienda` INT(11) NULL DEFAULT NULL AFTER `id_traspaso`,
CHANGE COLUMN `nombre` `nombre` VARCHAR(100) NULL DEFAULT NULL AFTER `id_tienda`,
CHANGE COLUMN `precio_descuento` `mayoreo` DOUBLE NULL DEFAULT NULL AFTER `costo`,
CHANGE COLUMN `status` `status` VARCHAR(45) NOT NULL DEFAULT 'ACTIVO' AFTER `cantidad_anterior`,
CHANGE COLUMN `fechare_gistro` `fecha_registro` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP AFTER `status`,
CHANGE COLUMN `cant_anterior` `cantidad_anterior` INT(11) NULL DEFAULT '0' ;
ALTER TABLE `xqwmrfeeug`.`traspaso_producto` 
ADD COLUMN `total` DOUBLE NULL AFTER `totalcosto`;


UPDATE `xqwmrfeeug`.`tienda` SET `info_adicional` = 'SALIDA', `abreviacion` = 'SALIDA YAC' WHERE (`id_tienda` = '14');
UPDATE `xqwmrfeeug`.`tienda` SET `info_adicional` = 'ALMACEN' WHERE (`id_tienda` = '12');

ALTER TABLE `xqwmrfeeug`.`traspaso` 
CHANGE COLUMN `fecha_validacion` `fecha_validacion` TIMESTAMP NULL DEFAULT NULL ,
CHANGE COLUMN `usuario_validacion` `usuario_validacion` VARCHAR(45) NULL DEFAULT NULL ;
ALTER TABLE `xqwmrfeeug`.`entrada_producto` 
ADD COLUMN `act_inventario` INT NULL DEFAULT 0 AFTER `fecha_registro`;

ALTER TABLE `xqwmrfeeug`.`salida_producto` 
DROP COLUMN `cancelado`,
DROP COLUMN `ieps`,
DROP COLUMN `cantvendida`,
DROP COLUMN `iva`,
DROP COLUMN `multiplicador`,
ADD COLUMN `cantidad_anterior` INT NULL AFTER `nombre`,
ADD COLUMN `total` VARCHAR(45) NULL AFTER `totalcosto`,
CHANGE COLUMN `id_salida` `id_salida` INT(11) NOT NULL AFTER `id_salida_producto`,
CHANGE COLUMN `id_tienda` `id_tienda` INT(11) NULL DEFAULT NULL AFTER `id_salida`,
CHANGE COLUMN `nombre` `nombre` VARCHAR(100) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL AFTER `id_producto`,
CHANGE COLUMN `precio_descuento` `mayoreo` DOUBLE NULL DEFAULT NULL AFTER `costo`,
CHANGE COLUMN `status` `status` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL DEFAULT 'ACTIVO' AFTER `total`,
CHANGE COLUMN `fechare_gistro` `fecha_registro` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP AFTER `status`;

ALTER TABLE `xqwmrfeeug`.`entrada_producto` 
ADD COLUMN `deleted_date` TIMESTAMP NULL AFTER `act_inventario`;

ALTER TABLE `xqwmrfeeug`.`traspaso_producto` 
ADD COLUMN `deleted_date` TIMESTAMP NULL AFTER `fecha_registro`;

ALTER TABLE `xqwmrfeeug`.`entrada_producto` 
ADD COLUMN `usuario_deleted` VARCHAR(45) NULL AFTER `deleted_date`;

ALTER TABLE `xqwmrfeeug`.`traspaso_producto` 
ADD COLUMN `usuario_deleted` VARCHAR(45) NULL AFTER `deleted_date`;


ALTER TABLE `xqwmrfeeug`.`salida_producto` 
ADD COLUMN `deleted_date` TIMESTAMP NULL AFTER `fecha_registro`,
ADD COLUMN `usuario_deleted` VARCHAR(45) NULL AFTER `deleted_date`;

 --  add foraneas

ALTER TABLE `xqwmrfeeug`.`venta` 
ADD COLUMN `id_user` INT NULL AFTER `id_tienda`;
ALTER TABLE `xqwmrfeeug`.`venta` 
ADD CONSTRAINT `id_user_venta_dx`
  FOREIGN KEY (`id_user`)
  REFERENCES `xqwmrfeeug`.`usuario` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;


ALTER TABLE `xqwmrfeeug`.`entrada` 
ADD COLUMN `id_user` INT NULL AFTER `id_usuario`;
ALTER TABLE `xqwmrfeeug`.`entrada` 
ADD CONSTRAINT `id_user_entrada`
  FOREIGN KEY (`id_user`)
  REFERENCES `xqwmrfeeug`.`usuario` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `xqwmrfeeug`.`traspaso` 
ADD COLUMN `id_user` INT NULL AFTER `id_usuario`;
ALTER TABLE `xqwmrfeeug`.`traspaso` 
ADD CONSTRAINT `id_user_traspaso`
  FOREIGN KEY (`id_user`)
  REFERENCES `xqwmrfeeug`.`usuario` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `xqwmrfeeug`.`salida` 
ADD COLUMN `id_user` INT NULL AFTER `id_usuario`;
ALTER TABLE `xqwmrfeeug`.`salida` 
ADD CONSTRAINT `id_user_salida`
  FOREIGN KEY (`id_user`)
  REFERENCES `xqwmrfeeug`.`usuario` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

  ALTER TABLE `xqwmrfeeug`.`historial_inventario` 
ADD COLUMN `id_user` INT NULL AFTER `id_usuario`;
ALTER TABLE `xqwmrfeeug`.`historial_inventario` 
ADD CONSTRAINT `id_user_historialinventario`
  FOREIGN KEY (`id_user`)
  REFERENCES `xqwmrfeeug`.`usuario` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

  ALTER TABLE `xqwmrfeeug`.`deudores` 
ADD COLUMN `id_user` INT NULL AFTER `id_usuario`;
ALTER TABLE `xqwmrfeeug`.`deudores` 
ADD CONSTRAINT `id_user_deudores`
  FOREIGN KEY (`id_user`)
  REFERENCES `xqwmrfeeug`.`usuario` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

DROP TABLE `xqwmrfeeug`.`descuentos`;
DROP TABLE `xqwmrfeeug`.`bitacora_accesos`;
DROP TABLE `xqwmrfeeug`.`usuarios_venta`;
DROP TABLE `xqwmrfeeug`.`valida_inventario`, `xqwmrfeeug`.`validaentrada`, `xqwmrfeeug`.`validasalida`, `xqwmrfeeug`.`validatraspaso`;

update xqwmrfeeug.entrada e 
JOIN usuario u ON u.id_usuario=e.id_usuario
set e.id_user=u.id;

update xqwmrfeeug.traspaso e 
JOIN usuario u ON u.id_usuario=e.id_usuario
set e.id_user=u.id;

update xqwmrfeeug.salida e 
JOIN usuario u ON u.id_usuario=e.id_usuario
set e.id_user=u.id;

update xqwmrfeeug.venta e 
JOIN usuario u ON u.id_usuario=e.id_usuario
set e.id_user=u.id;

update xqwmrfeeug.deudores e 
JOIN usuario u ON u.id_usuario=e.id_usuario
set e.id_user=u.id;

update xqwmrfeeug.historial_inventario e 
JOIN usuario u ON u.id_usuario=e.id_usuario
set e.id_user=u.id;

update xqwmrfeeug.productos_venta e 
LEFT JOIN venta v ON e.usuario_cancelacion=v.id_usuario
LEFT JOIN usuario u ON u.id_usuario=v.id_usuario
set e.usuario_cancelacion=u.id;

update xqwmrfeeug.productos_venta e 
LEFT JOIN usuario u ON u.id_usuario=e.usuario_cancelacion
set e.usuario_cancelacion=u.id
where e.usuario_cancelacion is not null;

update xqwmrfeeug.venta e 
LEFT JOIN usuario u ON u.id_usuario=e.usuario_cancelacion
set e.usuario_cancelacion=u.id
where e.usuario_cancelacion is not null;

ALTER TABLE `xqwmrfeeug`.`entrada` 
CHANGE COLUMN `usuario_validacion` `usuario_validacion` INT NULL DEFAULT NULL ,
CHANGE COLUMN `usuario_deleted` `usuario_deleted` INT NULL DEFAULT NULL ;



ALTER TABLE `xqwmrfeeug`.`traspaso` 
DROP FOREIGN KEY `id_user_traspaso`;
ALTER TABLE `xqwmrfeeug`.`traspaso` 
CHANGE COLUMN `id_tienda` `id_tienda` INT(11) NOT NULL DEFAULT '6' AFTER `id_traspaso`,
CHANGE COLUMN `id_user` `id_user` INT(11) NOT NULL AFTER `id_tienda`,
CHANGE COLUMN `id_tiendaanterior` `id_tiendaanterior` INT(11) NOT NULL AFTER `id_user`,
CHANGE COLUMN `usuario_validacion` `usuario_validacion` INT NULL DEFAULT NULL ,
CHANGE COLUMN `usuario_deleted` `usuario_deleted` INT NULL DEFAULT NULL ;
ALTER TABLE `xqwmrfeeug`.`traspaso` 
ADD CONSTRAINT `id_user_traspaso`
  FOREIGN KEY (`id_user`)
  REFERENCES `xqwmrfeeug`.`usuario` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `id_tiendaanterior_traspaso`
  FOREIGN KEY (`id_tiendaanterior`)
  REFERENCES `xqwmrfeeug`.`tienda` (`id_tienda`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;


update xqwmrfeeug.producto_tienda e 
JOIN usuario u ON binary u.id_usuario= binary e.usuario_actualizacion
set e.usuario_actualizacion=u.id
where e.usuario_actualizacion is not null;

update xqwmrfeeug.salida e 
JOIN usuario u ON binary u.id_usuario= binary e.id_usuario
set e.id_usuario=u.id
where e.id_usuario is not null;

ALTER TABLE `xqwmrfeeug`.`salida_producto` 
ADD COLUMN `act_inventario` INT NULL DEFAULT 0 AFTER `cantidad_anterior`;

ALTER TABLE `xqwmrfeeug`.`salida` 
ADD COLUMN `folio` VARCHAR(45) NULL AFTER `id_tiendaanterior`;


ALTER TABLE `xqwmrfeeug`.`venta` 
DROP COLUMN `id_usuario`;

INSERT INTO `xqwmrfeeug`.`permiso` (`nombre`, `section`, `page`) VALUES ('Clientes View', 'Clientes', 'view');

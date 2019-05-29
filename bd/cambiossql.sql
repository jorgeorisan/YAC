
SET SQL_SAFE_UPDATES =  0;
ALTER TABLE `xqwmrfeeug`.`cita` 
DROP FOREIGN KEY `id_usuario_cita_dx`;
ALTER TABLE `xqwmrfeeug`.`cita` 
CHANGE COLUMN `id_usuario` `id_user` INT(11) NULL DEFAULT NULL ;
ALTER TABLE `xqwmrfeeug`.`cita` 
ADD CONSTRAINT `id_usuario_cita_dx`
  FOREIGN KEY (`id_user`)
  REFERENCES `xqwmrfeeug`.`usuario` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;



CREATE TABLE `pedido` (
   `id_pedido` int(11) NOT NULL AUTO_INCREMENT,
   `id_tienda` int(11) NOT NULL DEFAULT '6',
   `id_usuario` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
   `id_user` int(11) DEFAULT NULL,
   `fecha_registro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
   `fecha` timestamp NULL DEFAULT NULL,
   `costo_total` double DEFAULT NULL,
   `total` double DEFAULT NULL,
   `concepto` varchar(45) COLLATE utf8_unicode_ci DEFAULT 'Pedido',
   `folio` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
   `referencia` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
   `cancelado` tinyint(4) DEFAULT '0',
   `comentarios` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
   `status` varchar(45) COLLATE utf8_unicode_ci DEFAULT 'SOLICITADO',
   `ticket_items` text COLLATE utf8_unicode_ci,
   `tipo_pago` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
   `icredito` int(11) DEFAULT '0',
   `fecha_validacion` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
   `usuario_validacion` int(11) DEFAULT NULL,
   `usuario_deleted` int(11) DEFAULT NULL,
   `deleted_date` timestamp NULL DEFAULT NULL,
   PRIMARY KEY (`id_pedido`),
   KEY `id_tienda_idx` (`id_tienda`),
   KEY `id_user_pedido` (`id_user`),
   KEY `fecha` (`fecha`),
   KEY `usuario_validacion` (`usuario_validacion`),
   KEY `usuario_deleted` (`usuario_deleted`),
   CONSTRAINT `id_user_pedido_dx` FOREIGN KEY (`id_user`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
   CONSTRAINT `idtienda_pedido_dx` FOREIGN KEY (`id_tienda`) REFERENCES `tienda` (`id_tienda`) ON DELETE NO ACTION ON UPDATE NO ACTION
 ) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
 
 CREATE TABLE `pedido_producto` (
   `id_pedido_producto` int(11) NOT NULL AUTO_INCREMENT,
   `id_producto` bigint(20) NOT NULL,
   `nombre` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
   `cantidad` double DEFAULT NULL,
   `status` varchar(45) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'ACTIVO',
   `costo` double NOT NULL DEFAULT '0',
   `mayoreo` double DEFAULT NULL,
   `precio` double DEFAULT NULL,
   `id_pedido` int(11) NOT NULL,
   `totalcosto` double DEFAULT '0',
   `id_tienda` int(11) DEFAULT NULL,
   `cancelado` tinyint(4) DEFAULT '0',
   `cantidad_anterior` double DEFAULT NULL,
   `precio_costo` double DEFAULT '0',
   `fecha_registro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
   `act_inventario` int(11) DEFAULT '0',
   `deleted_date` timestamp NULL DEFAULT NULL,
   `usuario_deleted` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
   PRIMARY KEY (`id_pedido_producto`),
   KEY `fk_pedido_producto_producto1` (`id_producto`),
   KEY `id_pedido_idx` (`id_pedido`),
   KEY `id_tienda_pedido_idx` (`id_tienda`),
   CONSTRAINT `fk_pedido_producto_producto1` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE,
   CONSTRAINT `id_pedido_dx` FOREIGN KEY (`id_pedido`) REFERENCES `pedido` (`id_pedido`) ON DELETE NO ACTION ON UPDATE NO ACTION,
   CONSTRAINT `id_tienda_pedido` FOREIGN KEY (`id_tienda`) REFERENCES `tienda` (`id_tienda`) ON DELETE NO ACTION ON UPDATE NO ACTION
 ) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `xqwmrfeeug`.`permiso` (`nombre`, `section`, `page`) VALUES ('Pedidos Alta', 'Pedidos', 'add');
INSERT INTO `xqwmrfeeug`.`permiso` (`nombre`, `section`, `page`) VALUES ('Pedidos Borrar', 'Pedidos', 'pedidodelete');
INSERT INTO `xqwmrfeeug`.`permiso` (`nombre`, `section`, `page`) VALUES ('Pedidos Ver', 'Pedidos', 'view');
INSERT INTO `xqwmrfeeug`.`permiso` (`nombre`, `section`, `page`) VALUES ('Pedidos', 'Pedidos', 'index');
INSERT INTO `xqwmrfeeug`.`permiso` (`nombre`, `section`, `page`) VALUES ('Clientes pedidos', 'Clientes', 'pedido');
INSERT INTO `xqwmrfeeug`.`permiso` (`nombre`, `section`, `page`) VALUES ('Entradas Validar', 'Entradas', 'validar');
INSERT INTO `xqwmrfeeug`.`permiso` (`nombre`, `section`, `page`) VALUES ('Traspasos Validar', 'Traspasos', 'validar');
INSERT INTO `xqwmrfeeug`.`permiso` (`nombre`, `section`, `page`) VALUES ('Salidas Validar', 'Salidas', 'validar');


ALTER TABLE `xqwmrfeeug`.`pedido` 
DROP COLUMN `icredito`,
DROP COLUMN `tipo_pago`,
DROP COLUMN `ticket_items`;

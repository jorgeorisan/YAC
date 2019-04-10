-- 09 abril 2019
DROP TABLE `xqwmrfeeug`.`ventascorte1`;


CREATE TABLE `accion` (
   `id_accion` int(10) unsigned NOT NULL AUTO_INCREMENT,
   `modulo` varchar(45) NOT NULL,
   `controlador` varchar(45) NOT NULL,
   `accion` varchar(45) NOT NULL,
   `nombre` text,
   `nombremodulo` varchar(100) DEFAULT NULL,
   PRIMARY KEY (`id_accion`),
   UNIQUE KEY `id_accion_UNIQUE` (`id_accion`)
 ) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;

 CREATE TABLE `usuario_accion` (
   `id_usuario_accion` int(11) NOT NULL AUTO_INCREMENT,
   `id_usuario` varchar(45) NOT NULL,
   `id_accion` int(10) unsigned NOT NULL,
   PRIMARY KEY (`id_usuario_accion`,`id_accion`,`id_usuario`),
   KEY `fk_usuario_accion_2_idx` (`id_accion`),
   CONSTRAINT `id_ac` FOREIGN KEY (`id_accion`) REFERENCES `accion` (`id_accion`) ON DELETE NO ACTION ON UPDATE NO ACTION
 ) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;
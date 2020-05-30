
CREATE TABLE `corte` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_user` int(10) DEFAULT NULL,
  `id_tienda` int(10) DEFAULT NULL,
  `fecha` timestamp NULL DEFAULT NULL,
  `total_diferencia` double DEFAULT NULL,
  `status` varchar(255) DEFAULT 'active',
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `total_entrada` double DEFAULT NULL,
  `total_salida` double DEFAULT NULL,
  `total_caja` double DEFAULT NULL,
  `total_dinero` double DEFAULT NULL,
  `total_cajanew` double(255,0) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user_corte_dx` (`id_user`),
  CONSTRAINT `id_user_corte_dx` FOREIGN KEY (`id_user`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;

CREATE TABLE `corte_conceptos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `corte_id` int(10) NOT NULL,
  `concepto` varchar(255) DEFAULT NULL,
  `cantidad` double DEFAULT NULL,
  `status` varchar(255) DEFAULT 'active',
  `fecha_registro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `tipo` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_corte_conceptos_dx` (`corte_id`),
  CONSTRAINT `id_corte_conceptos_dx` FOREIGN KEY (`corte_id`) REFERENCES `corte` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;
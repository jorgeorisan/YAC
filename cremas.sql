CREATE DATABASE  IF NOT EXISTS `jpetdeshdn` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `jpetdeshdn`;
-- MySQL dump 10.13  Distrib 5.6.17, for Win64 (x86_64)
--
-- Host: localhost    Database: jpetdeshdn
-- ------------------------------------------------------
-- Server version	5.5.49-0+deb7u1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `asistencia`
--

DROP TABLE IF EXISTS `asistencia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `asistencia` (
  `id_asistencia` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `fecha` date DEFAULT NULL,
  `tipo` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hora` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_asistencia`),
  KEY `fk_asistencia_usuario1` (`id_usuario`),
  CONSTRAINT `fk_asistencia_usuario1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asistencia`
--

LOCK TABLES `asistencia` WRITE;
/*!40000 ALTER TABLE `asistencia` DISABLE KEYS */;
INSERT INTO `asistencia` VALUES (1,'789.mx',NULL,'Entrada','2016-02-26 18:22:50'),(2,'789.mx',NULL,'Entrada','2016-02-01 18:22:50'),(3,'789.mx',NULL,'Entrada','2016-02-23 18:22:50'),(4,'vendedor1',NULL,'Entrada','2016-02-25 18:22:50'),(5,'789.mx',NULL,'Entrada','2016-02-22 18:22:50'),(6,'789.mx',NULL,'Entrada','2016-02-20 18:22:50'),(7,'vendedor1',NULL,'Entrada','2016-02-19 18:22:50'),(15,'vendedor1',NULL,'Entrada','2016-02-20 18:22:50'),(16,'vendedor1',NULL,'Entrada','2016-02-22 18:22:50'),(17,'vendedor1',NULL,'Entrada','2016-02-06 18:22:50'),(18,'vendedor1',NULL,'Entrada','2016-02-10 18:22:50'),(19,'jorge',NULL,'Entrada','2016-02-10 18:22:50'),(20,'jorge',NULL,'Entrada','2016-02-04 18:22:50'),(21,'vendedor2',NULL,'Entrada','2016-02-04 18:22:50'),(22,'vendedor2',NULL,'Entrada','2016-02-10 18:22:50'),(23,'vendedor2',NULL,'Entrada','2016-02-22 18:22:50'),(24,'vendedor2',NULL,'Entrada','2016-02-11 18:22:50'),(25,'vendedor2',NULL,'Entrada','2016-02-10 18:22:50'),(26,'789.mx',NULL,'Entrada','2016-02-29 22:12:31'),(27,'789.mx',NULL,'Salida','2016-02-29 22:12:35'),(28,'789.mx',NULL,'Entrada','2016-02-29 22:12:45'),(29,'789.mx',NULL,'Entrada','2016-03-03 17:37:22'),(30,'789.mx',NULL,'Entrada','2016-03-08 17:14:28'),(31,'789.mx',NULL,'Salida','2016-03-08 17:14:44'),(32,'jorge',NULL,'Entrada','2016-03-15 16:19:33'),(33,'jorge123',NULL,'Entrada','2016-03-15 16:20:39'),(34,'jorge',NULL,'Entrada','2016-03-31 16:59:14'),(35,'789.mx',NULL,'Entrada','2016-03-31 16:59:20'),(36,'vendedor1',NULL,'Entrada','2016-03-31 16:59:25');
/*!40000 ALTER TABLE `asistencia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `base_inventario`
--

DROP TABLE IF EXISTS `base_inventario`;
/*!50001 DROP VIEW IF EXISTS `base_inventario`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `base_inventario` (
  `id_entrada_producto` tinyint NOT NULL,
  `id_producto` tinyint NOT NULL,
  `id_tienda` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `bitacora_accesos`
--

DROP TABLE IF EXISTS `bitacora_accesos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bitacora_accesos` (
  `id_bitacoraaccesos` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha_registro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_bitacoraaccesos`)
) ENGINE=MyISAM AUTO_INCREMENT=106 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bitacora_accesos`
--

LOCK TABLES `bitacora_accesos` WRITE;
/*!40000 ALTER TABLE `bitacora_accesos` DISABLE KEYS */;
INSERT INTO `bitacora_accesos` VALUES (1,'789.mx','2016-02-11 15:18:10'),(2,'789.mx','2016-02-12 00:53:45'),(3,'789.mx','2016-02-12 00:53:50'),(4,'789.mx','2016-02-12 00:56:50'),(5,'789.mx','2016-02-16 19:07:29'),(6,'789.mx','2016-02-16 21:45:33'),(7,'789.mx','2016-02-17 23:48:07'),(8,'789.mx','2016-02-20 16:47:39'),(9,'789.mx','2016-02-23 04:02:31'),(10,'789.mx','2016-02-23 05:53:18'),(11,'789.mx','2016-02-23 05:54:04'),(12,'789.mx','2016-02-23 19:18:03'),(13,'789.mx','2016-02-24 03:15:08'),(14,'789.mx','2016-02-24 15:29:29'),(15,'ejoloy','2016-02-24 15:37:00'),(16,'ejoloy','2016-02-24 15:37:24'),(17,'789.mx','2016-02-24 15:38:25'),(18,'789.mx','2016-02-24 16:50:11'),(19,'vendedor1','2016-02-24 17:18:36'),(20,'vendedor1','2016-02-24 17:24:44'),(21,'789.mx','2016-02-24 17:36:10'),(22,'789.mx','2016-02-24 17:37:24'),(23,'789.mx','2016-02-24 18:01:01'),(24,'liron','2016-02-24 18:06:56'),(25,'789.mx','2016-02-24 18:19:04'),(26,'789.mx','2016-02-24 19:00:53'),(27,'789.mx','2016-02-25 17:12:04'),(28,'789.mx','2016-02-25 18:59:22'),(29,'789.mx','2016-02-26 15:10:43'),(30,'789.mx','2016-02-26 16:00:42'),(31,'789.mx','2016-02-26 16:55:47'),(32,'789.mx','2016-02-26 17:54:26'),(33,'789.mx','2016-02-26 19:34:29'),(34,'789.mx','2016-02-29 22:05:39'),(35,'789.mx','2016-02-29 22:12:13'),(36,'789.mx','2016-03-01 20:45:39'),(37,'789.mx','2016-03-02 17:10:19'),(38,'789.mx','2016-03-03 17:35:00'),(39,'789.mx','2016-03-07 05:15:33'),(40,'789.mx','2016-03-07 17:34:17'),(41,'789.mx','2016-03-08 15:51:39'),(42,'789.mx','2016-03-08 16:08:06'),(43,'789.mx','2016-03-08 16:17:47'),(44,'789.mx','2016-03-08 16:28:06'),(45,'789.mx','2016-03-08 16:47:08'),(46,'789.mx','2016-03-08 17:07:28'),(47,'789.mx','2016-03-08 17:08:56'),(48,'789.mx','2016-03-08 17:19:26'),(49,'789.mx','2016-03-08 17:20:05'),(50,'jorge','2016-03-08 17:21:16'),(51,'jorge','2016-03-09 02:06:58'),(52,'789.mx','2016-03-10 16:45:41'),(53,'789.mx','2016-03-10 19:21:01'),(54,'789.mx','2016-03-10 19:24:41'),(55,'789.mx','2016-03-10 19:26:18'),(56,'jorge','2016-03-11 02:27:14'),(57,'jorge','2016-03-11 05:44:27'),(58,'jorge','2016-03-11 20:27:32'),(59,'jorge','2016-03-14 15:10:40'),(60,'789.mx','2016-03-14 20:37:07'),(61,'2385','2016-03-14 20:56:03'),(62,'jorge','2016-03-14 23:56:31'),(63,'jorge','2016-03-15 15:01:43'),(64,'jorge','2016-03-15 16:12:16'),(65,'jorge','2016-03-15 18:28:18'),(66,'jorge','2016-03-15 21:46:53'),(67,'789.mx','2016-03-15 23:12:34'),(68,'jorge','2016-03-16 01:27:45'),(69,'789.mx','2016-03-18 18:41:48'),(70,'jorge','2016-03-22 21:40:58'),(71,'jorge','2016-03-23 17:19:24'),(72,'jorge','2016-03-28 16:01:22'),(73,'jorge','2016-03-28 18:21:11'),(74,'jorge','2016-03-29 00:08:19'),(75,'jorge','2016-03-30 15:07:12'),(76,'jorge','2016-03-30 15:13:52'),(77,'jorge','2016-03-31 15:16:56'),(78,'789.mx','2016-04-04 15:06:27'),(79,'789.mx','2016-04-04 18:58:48'),(80,'789.mx','2016-04-04 19:15:17'),(81,'789.mx','2016-04-04 19:16:59'),(82,'789.mx','2016-04-11 14:31:13'),(83,'789.mx','2016-04-11 23:36:27'),(84,'789.mx','2016-04-12 16:55:55'),(85,'789.mx','2016-04-12 19:22:58'),(86,'789.mx','2016-04-12 22:30:10'),(87,'789.mx','2016-04-13 15:26:09'),(88,'789.mx','2016-04-13 15:54:24'),(89,'jorge','2016-04-13 18:44:25'),(90,'789.mx','2016-04-13 18:54:40'),(91,'789.mx','2016-04-14 17:47:10'),(92,'jorge','2016-04-14 18:03:56'),(93,'jorge','2016-04-15 17:42:22'),(94,'jorge','2016-04-18 15:00:56'),(95,'jorge','2016-04-18 20:58:26'),(96,'789.mx','2016-04-19 14:53:45'),(97,'789.mx','2016-04-19 14:58:47'),(98,'789.mx','2016-04-19 18:33:16'),(99,'789.mx','2016-04-27 18:33:42'),(100,'jorge','2016-04-28 23:35:33'),(101,'789.mx','2016-05-09 15:15:11'),(102,'789.mx','2016-05-11 21:07:20'),(103,'789.mx','2016-05-12 02:31:22'),(104,'789.mx','2016-05-12 15:11:19'),(105,'jorge','2016-07-04 21:45:05');
/*!40000 ALTER TABLE `bitacora_accesos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categoria`
--

DROP TABLE IF EXISTS `categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categoria` (
  `id_categoria` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `descuento` double DEFAULT '0',
  `descuento_activado` tinyint(4) DEFAULT '0',
  `categoria` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria`
--

LOCK TABLES `categoria` WRITE;
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT INTO `categoria` VALUES ('',0,0,'FACE CARE'),('1',0,0,'No asignado');
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comisiones`
--

DROP TABLE IF EXISTS `comisiones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comisiones` (
  `id_comisiones` int(11) NOT NULL AUTO_INCREMENT,
  `concepto` varchar(100) DEFAULT NULL,
  `fecha_registro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_inicial` varchar(45) DEFAULT NULL,
  `fecha_final` varchar(45) DEFAULT NULL,
  `vendedor` varchar(45) DEFAULT NULL,
  `id_usuario` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT 'ACTIVO',
  PRIMARY KEY (`id_comisiones`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comisiones`
--

LOCK TABLES `comisiones` WRITE;
/*!40000 ALTER TABLE `comisiones` DISABLE KEYS */;
INSERT INTO `comisiones` VALUES (1,NULL,'2016-04-11 15:38:47',' 2016-03-01 ',' 2016-03-15 ',' ','789.mx','ACTIVO'),(2,NULL,'2016-04-12 22:32:22',' 2016-03-01 ',' 2016-03-15 ','789.mx ','789.mx','ACTIVO'),(3,NULL,'2016-04-13 18:50:28',' 2016-03-15 ',' 2016-03-31 ',' ','jorge','ACTIVO'),(4,NULL,'2016-04-13 18:57:55',' 2016-03-15 ',' 2016-03-31 ',' ','789.mx','ACTIVO'),(5,NULL,'2016-04-13 18:58:46',' 2016-03-15 ',' 2016-03-31 ',' ','789.mx','ACTIVO'),(6,NULL,'2016-04-13 18:58:52',' 2016-03-15 ',' 2016-03-31 ',' ','jorge','ACTIVO'),(7,NULL,'2016-04-13 19:00:34',' 2016-03-15 ',' 2016-03-31 ',' ','789.mx','ACTIVO'),(8,NULL,'2016-04-13 19:01:25',' 2016-03-15 ',' 2016-03-31 ',' ','789.mx','ACTIVO'),(9,NULL,'2016-04-14 18:05:17',' 2016-04-01 ',' 2016-04-15 ','789.mx ','789.mx','ACTIVO'),(10,NULL,'2016-04-18 21:28:43',' 2016-03-01 ',' 2016-03-15 ',' ','jorge','ACTIVO'),(11,NULL,'2016-04-19 14:54:32',' 2016-03-15 ',' 2016-03-31 ',' ','789.mx','ACTIVO');
/*!40000 ALTER TABLE `comisiones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comisiones_vendedor`
--

DROP TABLE IF EXISTS `comisiones_vendedor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comisiones_vendedor` (
  `id_comisiones_vendedor` int(11) NOT NULL AUTO_INCREMENT,
  `id_comisiones` int(11) DEFAULT NULL,
  `idsusuario` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT 'ACTIVO',
  `totalvtas` double DEFAULT NULL,
  `totalasis` int(11) DEFAULT NULL,
  `descgastos` double DEFAULT NULL,
  `montocomi` double DEFAULT NULL,
  `porcen` int(11) DEFAULT NULL,
  `totalcomi` double DEFAULT NULL,
  `id_tienda` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_comisiones_vendedor`),
  KEY `ID_comi_dx_idx` (`id_comisiones`),
  KEY `id_tiendadxcomi_idx` (`id_tienda`),
  CONSTRAINT `ID_comi_dx` FOREIGN KEY (`id_comisiones`) REFERENCES `comisiones` (`id_comisiones`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `id_tiendadxcomi` FOREIGN KEY (`id_tienda`) REFERENCES `tienda` (`id_tienda`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comisiones_vendedor`
--

LOCK TABLES `comisiones_vendedor` WRITE;
/*!40000 ALTER TABLE `comisiones_vendedor` DISABLE KEYS */;
INSERT INTO `comisiones_vendedor` VALUES (1,1,'789.mx ','ACTIVO',1000,2,10,490,20,98,12),(2,1,'jorge ','ACTIVO',1500,1,45,1455,20,291,13),(3,2,'789.mx ','ACTIVO',10,2,3,2,80,1.6,12),(4,3,'jorge ','ACTIVO',10,2,2,3,20,0.6000000000000001,13),(5,4,'jorge ','ACTIVO',10,2,0,5,20,1,13),(6,5,'jorge ','ACTIVO',100,2,1,49,20,9.8,13),(7,6,'jorge ','ACTIVO',100,2,1,49,20,9.8,13),(8,7,'jorge ','ACTIVO',100,2,0,50,10,5,13),(9,8,'jorge ','ACTIVO',10,2,0,5,20,1,13),(10,9,'789.mx ','ACTIVO',135,1,0,135,20,27,12),(11,10,'789.mx ','ACTIVO',100,2,3,50,20,7,12),(12,10,'jorge ','ACTIVO',100,1,7,100,20,13,13),(13,10,'prueba ','ACTIVO',0,0,0,0,0,0,14),(14,11,'jorge ','ACTIVO',1000,2,50,500,20,50,13);
/*!40000 ALTER TABLE `comisiones_vendedor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `costos`
--

DROP TABLE IF EXISTS `costos`;
/*!50001 DROP VIEW IF EXISTS `costos`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `costos` (
  `costo` tinyint NOT NULL,
  `id_tienda` tinyint NOT NULL,
  `existencias` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `datos_facturacion`
--

DROP TABLE IF EXISTS `datos_facturacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `datos_facturacion` (
  `id_datos_facturacion` int(11) NOT NULL AUTO_INCREMENT,
  `serie` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `folio_inicial` int(11) DEFAULT NULL,
  `folio_actual` int(11) DEFAULT NULL,
  `predeterminado` tinyint(4) DEFAULT '0',
  `id_persona` bigint(20) NOT NULL,
  PRIMARY KEY (`id_datos_facturacion`),
  KEY `fk_datos_facturacion_persona1_idx` (`id_persona`),
  CONSTRAINT `fk_datos_facturacion_persona1` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id_persona`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `datos_facturacion`
--

LOCK TABLES `datos_facturacion` WRITE;
/*!40000 ALTER TABLE `datos_facturacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `datos_facturacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `descgastos_comision`
--

DROP TABLE IF EXISTS `descgastos_comision`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `descgastos_comision` (
  `id_descgastos_comision` int(11) NOT NULL AUTO_INCREMENT,
  `monto` double DEFAULT NULL,
  `id_comisiones_vendedor` int(11) DEFAULT NULL,
  `concepto` varchar(100) DEFAULT NULL,
  `fecha_registro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(45) DEFAULT 'ACTIVO',
  PRIMARY KEY (`id_descgastos_comision`),
  KEY `ID_COMIDXVENDEDOR_idx` (`id_comisiones_vendedor`),
  CONSTRAINT `id_comisionesvendedx` FOREIGN KEY (`id_comisiones_vendedor`) REFERENCES `comisiones_vendedor` (`id_comisiones_vendedor`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `descgastos_comision`
--

LOCK TABLES `descgastos_comision` WRITE;
/*!40000 ALTER TABLE `descgastos_comision` DISABLE KEYS */;
INSERT INTO `descgastos_comision` VALUES (1,1,11,'prueba1','2016-04-18 21:28:43','ACTIVO'),(2,2,11,'prueba2','2016-04-18 21:28:43','ACTIVO'),(3,3,12,'prueba3','2016-04-18 21:28:43','ACTIVO'),(4,4,12,'prueba4','2016-04-18 21:28:43','ACTIVO'),(5,50,14,'prestamo','2016-04-19 14:54:32','ACTIVO');
/*!40000 ALTER TABLE `descgastos_comision` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `descuentos`
--

DROP TABLE IF EXISTS `descuentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `descuentos` (
  `id_descuentos` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` varchar(45) DEFAULT NULL,
  `porcentajedesc` varchar(45) DEFAULT NULL,
  `montodesc` double DEFAULT NULL,
  `totaldesc` double DEFAULT NULL,
  `id_venta` bigint(20) NOT NULL,
  `fecha_registro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `descripciondesc` varchar(80) DEFAULT NULL,
  `status` varchar(45) DEFAULT 'ACTIVO',
  PRIMARY KEY (`id_descuentos`),
  KEY `id_venta1_idx` (`id_venta`),
  CONSTRAINT `id_venta1` FOREIGN KEY (`id_venta`) REFERENCES `venta` (`id_venta`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `descuentos`
--

LOCK TABLES `descuentos` WRITE;
/*!40000 ALTER TABLE `descuentos` DISABLE KEYS */;
INSERT INTO `descuentos` VALUES (1,'789.mx','100',80,80,9,'2016-02-24 17:14:12','Tester 100%: 789.mx','ACTIVO'),(2,'789.mx','10',15,150,15,'2016-04-14 18:02:55','Tester 10%: 789.mx','ACTIVO');
/*!40000 ALTER TABLE `descuentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `detalle_ventascorte`
--

DROP TABLE IF EXISTS `detalle_ventascorte`;
/*!50001 DROP VIEW IF EXISTS `detalle_ventascorte`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `detalle_ventascorte` (
  `id` tinyint NOT NULL,
  `id_venta` tinyint NOT NULL,
  `cantidad` tinyint NOT NULL,
  `codinter` tinyint NOT NULL,
  `nombre` tinyint NOT NULL,
  `exento_iva` tinyint NOT NULL,
  `exento_ieps` tinyint NOT NULL,
  `fecha` tinyint NOT NULL,
  `total` tinyint NOT NULL,
  `tipo` tinyint NOT NULL,
  `id_usuario` tinyint NOT NULL,
  `id_tienda` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `deudores`
--

DROP TABLE IF EXISTS `deudores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `deudores` (
  `id_deudores` int(11) NOT NULL AUTO_INCREMENT,
  `id_venta` bigint(20) DEFAULT NULL,
  `id_persona` bigint(20) DEFAULT NULL,
  `fecha_abono` varchar(45) DEFAULT NULL,
  `fecha_registro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(45) DEFAULT 'ACTIVA',
  `montoabono` double DEFAULT NULL,
  `id_usuario` varchar(45) DEFAULT NULL,
  `id_tienda` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_deudores`),
  KEY `id_venta_idx` (`id_venta`),
  KEY `id_persona_idx` (`id_persona`),
  CONSTRAINT `id_persona` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id_persona`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `id_venta` FOREIGN KEY (`id_venta`) REFERENCES `venta` (`id_venta`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `deudores`
--

LOCK TABLES `deudores` WRITE;
/*!40000 ALTER TABLE `deudores` DISABLE KEYS */;
/*!40000 ALTER TABLE `deudores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `entrada`
--

DROP TABLE IF EXISTS `entrada`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `entrada` (
  `id_entrada` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_registro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha` timestamp NULL DEFAULT NULL,
  `costo_total` double DEFAULT NULL,
  `total` double DEFAULT NULL,
  `concepto` varchar(45) COLLATE utf8_unicode_ci DEFAULT 'Entrada de Almacen',
  `folio` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `referencia` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cancelado` tinyint(4) DEFAULT '0',
  `id_usuario` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `id_tienda` int(11) NOT NULL DEFAULT '6',
  `comentarios` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(45) COLLATE utf8_unicode_ci DEFAULT 'SOLICITADO',
  `ticket_items` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id_entrada`),
  KEY `fk_entrada_usuario1_idx` (`id_usuario`),
  KEY `id_tienda_idx` (`id_tienda`),
  CONSTRAINT `fk_entrada_usuario1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `idtienda` FOREIGN KEY (`id_tienda`) REFERENCES `tienda` (`id_tienda`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entrada`
--

LOCK TABLES `entrada` WRITE;
/*!40000 ALTER TABLE `entrada` DISABLE KEYS */;
INSERT INTO `entrada` VALUES (1,'2016-02-12 01:48:20','2016-02-11 06:00:00',50,30,'ENTRADA DE ALMACEN',NULL,'pruebas 789',0,'789.mx',12,'prueba entrada','ACTIVO','\r\n        <tbody><tr>\r\n            <th>Cantidad</th>\r\n            <th>Codigo Interno</th>\r\n            <th>Producto</th>\r\n            <th>Costo</th>\r\n            <th>Precio</th>\r\n            <th>Precio Mayoreo</th>\r\n            <th>Precio Costo</th>\r\n            <th>Importe</th>\r\n            \r\n        </tr>\r\n    \r\n<tr class=\"producto\" lineid=\"66501\">\r\n    <td>\r\n        <div id=\"cantidad66501\" placeholder=\"$0.00\">10</div>\r\n\r\n        <input type=\"hidden\" name=\"id_producto[]\" value=\"5\">\r\n        <input type=\"hidden\" name=\"cantidad[]\" value=\"10\">\r\n    </td>\r\n    <td>\r\n        cod12345    </td>\r\n    <td>\r\n        Producto1    </td>\r\n    <td>\r\n        <input type=\"text\" name=\"costo[]\" class=\"small-field\" id=\"costo66501\" onkeyup=\"calculaprecio(66501)\" style=\"width: 50\" pattern=\"[0-9]+([\\.|,][0-9]+)?>$\" placeholder=\"$0.00\" value=\"1\">    </td>\r\n    <td>\r\n        <input type=\"text\" name=\"precio[]\" class=\"small-field\" id=\"precio66501\" style=\"width: 50\" pattern=\"[0-9]+([\\.|,][0-9]+)?>$\" placeholder=\"$0.00\" value=\"1.74\">    </td>\r\n    <td>\r\n        <input type=\"text\" name=\"precio_descuento[]\" class=\"small-field\" id=\"precio_descuento66501\" style=\"width: 50\" pattern=\"[0-9]+([\\.|,][0-9]+)?>$\" placeholder=\"$0.00\" value=\"1.3\">    </td>\r\n    <td>\r\n        <input type=\"text\" name=\"precio_costo[]\" class=\"small-field\" id=\"precio_costo66501\" style=\"width: 50\" pattern=\"[0-9]+([\\.|,][0-9]+)?>$\" placeholder=\"$0.00\" value=\"1\">    </td>\r\n    <td>\r\n\r\n        <input type=\"hidden\" value=\"0\">\r\n        <div class=\"totales\" id=\"importe66501\">10</div><input type=\"hidden\" value=\"10\" name=\"total[]\" id=\"importe266501\">    </td>\r\n\r\n    \r\n</tr>\r\n<tr class=\"producto\" lineid=\"4742\">\r\n    <td>\r\n        <div id=\"cantidad4742\" placeholder=\"$0.00\">20</div>\r\n\r\n        <input type=\"hidden\" name=\"id_producto[]\" value=\"7\">\r\n        <input type=\"hidden\" name=\"cantidad[]\" value=\"20\">\r\n    </td>\r\n    <td>\r\n        cod54321    </td>\r\n    <td>\r\n        Producto2    </td>\r\n    <td>\r\n        <input type=\"text\" name=\"costo[]\" class=\"small-field\" id=\"costo4742\" onkeyup=\"calculaprecio(4742)\" style=\"width: 50\" pattern=\"[0-9]+([\\.|,][0-9]+)?>$\" placeholder=\"$0.00\" value=\"2\">    </td>\r\n    <td>\r\n        <input type=\"text\" name=\"precio[]\" class=\"small-field\" id=\"precio4742\" style=\"width: 50\" pattern=\"[0-9]+([\\.|,][0-9]+)?>$\" placeholder=\"$0.00\" value=\"3.48\">    </td>\r\n    <td>\r\n        <input type=\"text\" name=\"precio_descuento[]\" class=\"small-field\" id=\"precio_descuento4742\" style=\"width: 50\" pattern=\"[0-9]+([\\.|,][0-9]+)?>$\" placeholder=\"$0.00\" value=\"2.6\">    </td>\r\n    <td>\r\n        <input type=\"text\" name=\"precio_costo[]\" class=\"small-field\" id=\"precio_costo4742\" style=\"width: 50\" pattern=\"[0-9]+([\\.|,][0-9]+)?>$\" placeholder=\"$0.00\" value=\"2.2\">    </td>\r\n    <td>\r\n\r\n        <input type=\"hidden\" value=\"0\">\r\n        <div class=\"totales\" id=\"importe4742\">40</div><input type=\"hidden\" value=\"40\" name=\"total[]\" id=\"importe24742\">    </td>\r\n\r\n    \r\n</tr>\r\n</tbody>'),(2,'2016-02-12 02:48:41','2016-02-11 06:00:00',25,5,'ENTRADA DE ALMACEN',NULL,'pruebas 789',0,'789.mx',12,'entrada de 5 paquetes ','ACTIVO','\r\n        <tbody><tr>\r\n            <th>Cantidad</th>\r\n            <th>Codigo Interno</th>\r\n            <th>Producto</th>\r\n            <th>Costo</th>\r\n            <th>Precio</th>\r\n            <th>Precio Mayoreo</th>\r\n            <th>Precio Costo</th>\r\n            <th>Importe</th>\r\n            \r\n        </tr>\r\n    \r\n<tr class=\"producto\" lineid=\"57721\">\r\n    <td>\r\n        <div id=\"cantidad57721\" placeholder=\"$0.00\">5</div>\r\n\r\n        <input type=\"hidden\" name=\"id_producto[]\" value=\"6\">\r\n        <input type=\"hidden\" name=\"cantidad[]\" value=\"5\">\r\n    </td>\r\n    <td>\r\n        cod1212    </td>\r\n    <td>\r\n        Paquete1    </td>\r\n    <td>\r\n        <input type=\"text\" name=\"costo[]\" class=\"small-field\" id=\"costo57721\" onkeyup=\"calculaprecio(57721)\" style=\"width: 50\" pattern=\"[0-9]+([\\.|,][0-9]+)?>$\" placeholder=\"$0.00\" value=\"5\">    </td>\r\n    <td>\r\n        <input type=\"text\" name=\"precio[]\" class=\"small-field\" id=\"precio57721\" style=\"width: 50\" pattern=\"[0-9]+([\\.|,][0-9]+)?>$\" placeholder=\"$0.00\" value=\"8.7\">    </td>\r\n    <td>\r\n        <input type=\"text\" name=\"precio_descuento[]\" class=\"small-field\" id=\"precio_descuento57721\" style=\"width: 50\" pattern=\"[0-9]+([\\.|,][0-9]+)?>$\" placeholder=\"$0.00\" value=\"6.5\">    </td>\r\n    <td>\r\n        <input type=\"text\" name=\"precio_costo[]\" class=\"small-field\" id=\"precio_costo57721\" style=\"width: 50\" pattern=\"[0-9]+([\\.|,][0-9]+)?>$\" placeholder=\"$0.00\" value=\"5\">    </td>\r\n    <td>\r\n\r\n        <input type=\"hidden\" value=\"0\">\r\n        <div class=\"totales\" id=\"importe57721\">25</div><input type=\"hidden\" value=\"25\" name=\"total[]\" id=\"importe257721\">    </td>\r\n\r\n    \r\n</tr>\r\n</tbody>'),(3,'2016-02-24 17:22:05','2016-02-24 06:00:00',10,10,'ENTRADA DE ALMACEN',NULL,'pruebas 789',0,'vendedor1',12,'pruebas','ACTIVO','\r\n        <tbody><tr>\r\n            <th>Cantidad</th>\r\n            <th>Codigo Interno</th>\r\n            <th>Producto</th>\r\n            <th>Costo</th>\r\n            <th>Precio</th>\r\n            <th>Precio Mayoreo</th>\r\n            <th>Precio Costo</th>\r\n            <th>Importe</th>\r\n            \r\n        </tr>\r\n    <tr class=\"producto\" lineid=\"84557\">\r\n    <td>\r\n        <div id=\"cantidad84557\" placeholder=\"$0.00\">10</div>\r\n\r\n        <input type=\"hidden\" name=\"id_producto[]\" value=\"5\">\r\n        <input type=\"hidden\" name=\"cantidad[]\" value=\"10\">\r\n    </td>\r\n    <td>\r\n        cod12345    </td>\r\n    <td>\r\n        Producto1    </td>\r\n    <td>\r\n        <input type=\"text\" name=\"costo[]\" class=\"small-field\" id=\"costo84557\" onkeyup=\"calculaprecio(84557)\" style=\"width: 50\" pattern=\"[0-9]+([\\.|,][0-9]+)?>$\" placeholder=\"$0.00\" value=\"1\">    </td>\r\n    <td>\r\n        <input type=\"text\" name=\"precio[]\" class=\"small-field\" id=\"precio84557\" style=\"width: 50\" pattern=\"[0-9]+([\\.|,][0-9]+)?>$\" placeholder=\"$0.00\" value=\"1.74\">    </td>\r\n    <td>\r\n            </td>\r\n    <td>\r\n            </td>\r\n    <td>\r\n\r\n        <input type=\"hidden\" value=\"0\">\r\n        <div class=\"totales\" id=\"importe84557\">10</div><input type=\"hidden\" value=\"10\" name=\"total[]\" id=\"importe284557\">    </td>\r\n\r\n    \r\n</tr>\r\n</tbody>'),(4,'2016-02-24 17:46:04','2016-02-24 06:00:00',121600,152,'ENTRADA DE ALMACEN',NULL,'2',0,'789.mx',12,'','ACTIVO','\r\n        <tbody><tr>\r\n            <th>Cantidad</th>\r\n            <th>Codigo Interno</th>\r\n            <th>Producto</th>\r\n            <th>Costo</th>\r\n            <th>Precio</th>\r\n            <th>Precio Mayoreo</th>\r\n            <th>Precio Costo</th>\r\n            <th>Importe</th>\r\n            \r\n        </tr>\r\n    <tr class=\"producto\" lineid=\"95355\">\r\n    <td>\r\n        <div id=\"cantidad95355\" placeholder=\"$0.00\">152</div>\r\n\r\n        <input type=\"hidden\" name=\"id_producto[]\" value=\"8\">\r\n        <input type=\"hidden\" name=\"cantidad[]\" value=\"152\">\r\n    </td>\r\n    <td>\r\n        ml165    </td>\r\n    <td>\r\n        Milk Lotion    </td>\r\n    <td>\r\n        <input type=\"text\" name=\"costo[]\" class=\"small-field\" id=\"costo95355\" onkeyup=\"calculaprecio(95355)\" style=\"width: 50\" pattern=\"[0-9]+([\\.|,][0-9]+)?>$\" placeholder=\"$0.00\" value=\"0\">    </td>\r\n    <td>\r\n        <input type=\"text\" name=\"precio[]\" class=\"small-field\" id=\"precio95355\" style=\"width: 50\" pattern=\"[0-9]+([\\.|,][0-9]+)?>$\" placeholder=\"$0.00\" value=\"750\">    </td>\r\n    <td>\r\n        <input type=\"text\" name=\"precio_descuento[]\" class=\"small-field\" id=\"precio_descuento95355\" style=\"width: 50\" pattern=\"[0-9]+([\\.|,][0-9]+)?>$\" placeholder=\"$0.00\" value=\"600\">    </td>\r\n    <td>\r\n        <input type=\"text\" name=\"precio_costo[]\" class=\"small-field\" id=\"precio_costo95355\" style=\"width: 50\" pattern=\"[0-9]+([\\.|,][0-9]+)?>$\" placeholder=\"$0.00\" value=\"300\">    </td>\r\n    <td>\r\n\r\n        <input type=\"hidden\" value=\"0\">\r\n        <div class=\"totales\" id=\"importe95355\">121600.00</div><input type=\"hidden\" value=\"121600.00\" name=\"total[]\" id=\"importe295355\">    </td>\r\n\r\n    \r\n</tr>\r\n</tbody>'),(5,'2016-04-14 17:48:02','2016-04-14 05:00:00',100,1,'ENTRADA DE ALMACEN',NULL,'ref prueba',0,'789.mx',13,'','ACTIVO','\r\n        <tbody><tr>\r\n            <th>Cantidad</th>\r\n            <th>Codigo Interno</th>\r\n            <th>Producto</th>\r\n            <th>Costo</th>\r\n            <th>Precio</th>\r\n            <th>Precio Mayoreo</th>\r\n            <th>Precio Costo</th>\r\n            <th>Importe</th>\r\n            \r\n        </tr>\r\n    <tr class=\"producto\" lineid=\"41847\">\r\n    <td>\r\n        <div id=\"cantidad41847\" placeholder=\"$0.00\">1</div>\r\n\r\n        <input type=\"hidden\" name=\"id_producto[]\" value=\"10\">\r\n        <input type=\"hidden\" name=\"cantidad[]\" value=\"1\">\r\n    </td>\r\n    <td>\r\n        PRUEBA1111    </td>\r\n    <td>\r\n        PRODUCTOPRUEBA    </td>\r\n    <td>\r\n        <input type=\"text\" name=\"costo[]\" class=\"small-field\" id=\"costo41847\" onkeyup=\"calculaprecio(41847)\" style=\"width: 50\" pattern=\"[0-9]+([\\.|,][0-9]+)?>$\" placeholder=\"$0.00\" value=\"100\">    </td>\r\n    <td>\r\n        <input type=\"text\" name=\"precio[]\" class=\"small-field\" id=\"precio41847\" style=\"width: 50\" pattern=\"[0-9]+([\\.|,][0-9]+)?>$\" placeholder=\"$0.00\" value=\"174\">    </td>\r\n    <td>\r\n        <input type=\"text\" name=\"precio_descuento[]\" class=\"small-field\" id=\"precio_descuento41847\" style=\"width: 50\" pattern=\"[0-9]+([\\.|,][0-9]+)?>$\" placeholder=\"$0.00\" value=\"130\">    </td>\r\n    <td>\r\n        <input type=\"text\" name=\"precio_costo[]\" class=\"small-field\" id=\"precio_costo41847\" style=\"width: 50\" pattern=\"[0-9]+([\\.|,][0-9]+)?>$\" placeholder=\"$0.00\" value=\"110\">    </td>\r\n    <td>\r\n\r\n        <input type=\"hidden\" value=\"0\">\r\n        <div class=\"totales\" id=\"importe41847\">100</div><input type=\"hidden\" value=\"100\" name=\"total[]\" id=\"importe241847\">    </td>\r\n\r\n    \r\n</tr>\r\n</tbody>'),(6,'2016-04-14 18:00:47','2016-04-14 05:00:00',10000,100,'ENTRADA DE ALMACEN',NULL,'2',0,'789.mx',13,'','ACTIVO','\r\n        <tbody><tr>\r\n            <th>Cantidad</th>\r\n            <th>Codigo Interno</th>\r\n            <th>Producto</th>\r\n            <th>Costo</th>\r\n            <th>Precio</th>\r\n            <th>Precio Mayoreo</th>\r\n            <th>Precio Costo</th>\r\n            <th>Importe</th>\r\n            \r\n        </tr>\r\n    <tr class=\"producto\" lineid=\"21224\">\r\n    <td>\r\n        <div id=\"cantidad21224\" placeholder=\"$0.00\">100</div>\r\n\r\n        <input type=\"hidden\" name=\"id_producto[]\" value=\"10\">\r\n        <input type=\"hidden\" name=\"cantidad[]\" value=\"100\">\r\n    </td>\r\n    <td>\r\n        PRUEBA1111    </td>\r\n    <td>\r\n        PRODUCTOPRUEBA    </td>\r\n    <td>\r\n        <input type=\"text\" name=\"costo[]\" class=\"small-field\" id=\"costo21224\" onkeyup=\"calculaprecio(21224)\" style=\"width: 50\" pattern=\"[0-9]+([\\.|,][0-9]+)?>$\" placeholder=\"$0.00\" value=\"100\">    </td>\r\n    <td>\r\n        <input type=\"text\" name=\"precio[]\" class=\"small-field\" id=\"precio21224\" style=\"width: 50\" pattern=\"[0-9]+([\\.|,][0-9]+)?>$\" placeholder=\"$0.00\" value=\"174\">    </td>\r\n    <td>\r\n        <input type=\"text\" name=\"precio_descuento[]\" class=\"small-field\" id=\"precio_descuento21224\" style=\"width: 50\" pattern=\"[0-9]+([\\.|,][0-9]+)?>$\" placeholder=\"$0.00\" value=\"130\">    </td>\r\n    <td>\r\n        <input type=\"text\" name=\"precio_costo[]\" class=\"small-field\" id=\"precio_costo21224\" style=\"width: 50\" pattern=\"[0-9]+([\\.|,][0-9]+)?>$\" placeholder=\"$0.00\" value=\"110\">    </td>\r\n    <td>\r\n\r\n        <input type=\"hidden\" value=\"0\">\r\n        <div class=\"totales\" id=\"importe21224\">10000</div><input type=\"hidden\" value=\"10000\" name=\"total[]\" id=\"importe221224\">    </td>\r\n\r\n    \r\n</tr>\r\n</tbody>'),(7,'2016-05-12 16:11:17','2016-05-12 05:00:00',80000,100,'ENTRADA DE ALMACEN',NULL,'',0,'789.mx',4,'','ACTIVO','\r\n        <tbody><tr>\r\n            <th>Cantidad</th>\r\n            <th>Codigo Interno</th>\r\n            <th>Producto</th>\r\n            <th>Costo</th>\r\n            <th>Precio</th>\r\n            <th>Precio Mayoreo</th>\r\n            <th>Precio Costo</th>\r\n            <th>Importe</th>\r\n            \r\n        </tr>\r\n    <tr class=\"producto\" lineid=\"9872\">\r\n    <td>\r\n        <div id=\"cantidad9872\" placeholder=\"$0.00\">100</div>\r\n\r\n        <input type=\"hidden\" name=\"id_producto[]\" value=\"8\">\r\n        <input type=\"hidden\" name=\"cantidad[]\" value=\"100\">\r\n    </td>\r\n    <td>\r\n        ml165    </td>\r\n    <td>\r\n        Milk Lotion    </td>\r\n    <td>\r\n        <input type=\"text\" name=\"costo[]\" class=\"small-field\" id=\"costo9872\" onkeyup=\"calculaprecio(9872)\" style=\"width: 50\" pattern=\"[0-9]+([\\.|,][0-9]+)?>$\" placeholder=\"$0.00\" value=\"800\">    </td>\r\n    <td>\r\n        <input type=\"text\" name=\"precio[]\" class=\"small-field\" id=\"precio9872\" style=\"width: 50\" pattern=\"[0-9]+([\\.|,][0-9]+)?>$\" placeholder=\"$0.00\" value=\"1392\">    </td>\r\n    <td>\r\n        <input type=\"text\" name=\"precio_descuento[]\" class=\"small-field\" id=\"precio_descuento9872\" style=\"width: 50\" pattern=\"[0-9]+([\\.|,][0-9]+)?>$\" placeholder=\"$0.00\" value=\"600\">    </td>\r\n    <td>\r\n        <input type=\"text\" name=\"precio_costo[]\" class=\"small-field\" id=\"precio_costo9872\" style=\"width: 50\" pattern=\"[0-9]+([\\.|,][0-9]+)?>$\" placeholder=\"$0.00\" value=\"300\">    </td>\r\n    <td>\r\n\r\n        <input type=\"hidden\" value=\"0\">\r\n        <div class=\"totales\" id=\"importe9872\">80000</div><input type=\"hidden\" value=\"80000\" name=\"total[]\" id=\"importe29872\">    </td>\r\n\r\n    \r\n</tr>\r\n</tbody>');
/*!40000 ALTER TABLE `entrada` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `entrada_producto`
--

DROP TABLE IF EXISTS `entrada_producto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `entrada_producto` (
  `id_entrada_producto` int(11) NOT NULL AUTO_INCREMENT,
  `id_producto` bigint(20) NOT NULL,
  `fechare_gistro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `cantidad` double DEFAULT NULL,
  `status` varchar(45) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'ACTIVO',
  `costo` double NOT NULL DEFAULT '0',
  `multiplicador` double DEFAULT NULL,
  `precio` double DEFAULT NULL,
  `iva` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cantvendida` double DEFAULT '0',
  `ieps` double DEFAULT '0',
  `id_entrada` int(11) NOT NULL,
  `totalcosto` double DEFAULT '0',
  `nombre` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_tienda` int(11) DEFAULT NULL,
  `precio_descuento` double DEFAULT NULL,
  `cancelado` tinyint(4) DEFAULT '0',
  `cantidad_anterior` double DEFAULT NULL,
  `precio_costo` double DEFAULT '0',
  PRIMARY KEY (`id_entrada_producto`),
  KEY `fk_entrada_producto_producto1` (`id_producto`),
  KEY `id_entrada_idx` (`id_entrada`),
  CONSTRAINT `fk_entrada_producto_producto1` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `id_entr` FOREIGN KEY (`id_entrada`) REFERENCES `entrada` (`id_entrada`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3186 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entrada_producto`
--

LOCK TABLES `entrada_producto` WRITE;
/*!40000 ALTER TABLE `entrada_producto` DISABLE KEYS */;
INSERT INTO `entrada_producto` VALUES (3178,5,'2016-02-12 01:48:20',10,'ACTIVO',1,1.5,1.74,'1.16',0,0,1,10,'Producto1',12,1.3,0,0,1),(3179,7,'2016-02-12 01:48:20',20,'ACTIVO',2,1.5,3.48,'1.16',0,0,1,40,'Producto2',12,2.6,0,0,2.2),(3180,6,'2016-02-12 02:48:41',5,'ACTIVO',5,1.5,8.7,'1.16',0,0,2,25,'Paquete1',12,6.5,0,0,5),(3181,5,'2016-02-24 17:22:05',10,'ACTIVO',1,1.5,2,'1.16',0,0,3,10,'Producto1',12,NULL,0,1,0),(3182,8,'2016-02-24 17:46:04',152,'ACTIVO',800,1.5,1392,'1.16',0,0,4,121600,'Milk Lotion',12,600,0,0,300),(3183,10,'2016-04-14 17:48:02',1,'ACTIVO',100,1.5,174,'1.16',0,0,5,100,'PRODUCTOPRUEBA',13,130,0,0,110),(3184,10,'2016-04-14 18:00:47',100,'ACTIVO',100,1.5,174,'1.16',0,0,6,10000,'PRODUCTOPRUEBA',13,130,0,0,110),(3185,8,'2016-05-12 16:11:17',100,'ACTIVO',800,1.5,1392,'1.16',0,0,7,80000,'Milk Lotion',4,600,0,0,300);
/*!40000 ALTER TABLE `entrada_producto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `entrada_productocancelado`
--

DROP TABLE IF EXISTS `entrada_productocancelado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `entrada_productocancelado` (
  `id_entrada_productocancelado` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` varchar(45) DEFAULT NULL,
  `fecha_registro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `id_entrada_producto` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_entrada_productocancelado`),
  KEY `id_entra_idx` (`id_entrada_producto`),
  CONSTRAINT `id_entra` FOREIGN KEY (`id_entrada_producto`) REFERENCES `entrada_producto` (`id_entrada_producto`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entrada_productocancelado`
--

LOCK TABLES `entrada_productocancelado` WRITE;
/*!40000 ALTER TABLE `entrada_productocancelado` DISABLE KEYS */;
/*!40000 ALTER TABLE `entrada_productocancelado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `factura`
--

DROP TABLE IF EXISTS `factura`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `factura` (
  `id_factura` int(11) NOT NULL AUTO_INCREMENT,
  `serie` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '	',
  `folio` int(11) DEFAULT NULL,
  `subtotal` double DEFAULT NULL,
  `impuestos` double DEFAULT NULL,
  `total` double DEFAULT NULL,
  `status` varchar(20) COLLATE utf8_unicode_ci DEFAULT 'ACTIVA',
  `urlxml` text COLLATE utf8_unicode_ci,
  `urlpdf` text COLLATE utf8_unicode_ci,
  `metodo_de_pago` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `forma_de_pago` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha_registro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `digitos` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tipo_comprobante` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_persona` bigint(20) NOT NULL,
  `id_venta` bigint(20) DEFAULT NULL,
  `cancelada` int(11) DEFAULT '0',
  `iva` double DEFAULT NULL,
  `ieps` double DEFAULT NULL,
  `id_usuario` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechainicial` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechafinal` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_usuariocancelacion` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha_cancelacion` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `exentos` double DEFAULT NULL,
  PRIMARY KEY (`id_factura`),
  KEY `fk_factura_persona1_idx` (`id_persona`),
  KEY `fk_factura_venta1_idx` (`id_venta`),
  CONSTRAINT `fk_factura_persona1` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id_persona`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `factura`
--

LOCK TABLES `factura` WRITE;
/*!40000 ALTER TABLE `factura` DISABLE KEYS */;
/*!40000 ALTER TABLE `factura` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gasto`
--

DROP TABLE IF EXISTS `gasto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gasto` (
  `id_gasto` int(11) NOT NULL AUTO_INCREMENT,
  `concepto` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `monto` double DEFAULT NULL,
  PRIMARY KEY (`id_gasto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gasto`
--

LOCK TABLES `gasto` WRITE;
/*!40000 ALTER TABLE `gasto` DISABLE KEYS */;
/*!40000 ALTER TABLE `gasto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `inventariocosto`
--

DROP TABLE IF EXISTS `inventariocosto`;
/*!50001 DROP VIEW IF EXISTS `inventariocosto`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `inventariocosto` (
  `id_entrada_producto` tinyint NOT NULL,
  `id_producto` tinyint NOT NULL,
  `id_tienda` tinyint NOT NULL,
  `costo` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `inventariocosto2`
--

DROP TABLE IF EXISTS `inventariocosto2`;
/*!50001 DROP VIEW IF EXISTS `inventariocosto2`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `inventariocosto2` (
  `id_tienda` tinyint NOT NULL,
  `costo` tinyint NOT NULL,
  `existencias` tinyint NOT NULL,
  `costototal` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `inventariocostomensual`
--

DROP TABLE IF EXISTS `inventariocostomensual`;
/*!50001 DROP VIEW IF EXISTS `inventariocostomensual`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `inventariocostomensual` (
  `id` tinyint NOT NULL,
  `id_tienda` tinyint NOT NULL,
  `existencias` tinyint NOT NULL,
  `precio` tinyint NOT NULL,
  `precio_mayoreo` tinyint NOT NULL,
  `costo` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `inventarioprecio`
--

DROP TABLE IF EXISTS `inventarioprecio`;
/*!50001 DROP VIEW IF EXISTS `inventarioprecio`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `inventarioprecio` (
  `id_entrada_producto` tinyint NOT NULL,
  `id_producto` tinyint NOT NULL,
  `id_tienda` tinyint NOT NULL,
  `precio` tinyint NOT NULL,
  `precio_descuento` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `inventarioprecio2`
--

DROP TABLE IF EXISTS `inventarioprecio2`;
/*!50001 DROP VIEW IF EXISTS `inventarioprecio2`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `inventarioprecio2` (
  `id_tienda` tinyint NOT NULL,
  `precio` tinyint NOT NULL,
  `existencias` tinyint NOT NULL,
  `preciototal` tinyint NOT NULL,
  `preciomayoreototal` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `marca`
--

DROP TABLE IF EXISTS `marca`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `marca` (
  `id_marca` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descuento` double DEFAULT '0',
  `descuento_activado` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id_marca`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `marca`
--

LOCK TABLES `marca` WRITE;
/*!40000 ALTER TABLE `marca` DISABLE KEYS */;
INSERT INTO `marca` VALUES (1,'No asignada',0,0),(2,'prueba',0,0),(3,'ONSEN',0,0),(4,'MARCA PRUEBA',10,1);
/*!40000 ALTER TABLE `marca` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `paquete`
--

DROP TABLE IF EXISTS `paquete`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `paquete` (
  `id_paquete` int(11) NOT NULL AUTO_INCREMENT,
  `id_producto` bigint(20) DEFAULT NULL,
  `id_productocompuesto` bigint(20) DEFAULT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT 'ACTIVO',
  `fecha_registro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `id_usuario` varchar(45) DEFAULT NULL,
  `cantidad` double DEFAULT NULL,
  `comentarios` text,
  PRIMARY KEY (`id_paquete`),
  KEY `id_opr_idx` (`id_producto`),
  CONSTRAINT `id_opr` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paquete`
--

LOCK TABLES `paquete` WRITE;
/*!40000 ALTER TABLE `paquete` DISABLE KEYS */;
INSERT INTO `paquete` VALUES (1,6,5,'Producto1','ACTIVO','2016-02-12 01:21:47','789.mx',1,'paquete 1 pruebas'),(2,6,7,'Producto2','ACTIVO','2016-02-12 01:21:47','789.mx',2,'paquete 1 pruebas'),(3,10,8,'Milk Lotion','ACTIVO','2016-03-15 23:27:10','789.mx',1,'PACK PROMOCIONAL DE PRUEBA'),(4,10,7,'Producto2','ACTIVO','2016-03-15 23:27:10','789.mx',1,'PACK PROMOCIONAL DE PRUEBA');
/*!40000 ALTER TABLE `paquete` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `persona`
--

DROP TABLE IF EXISTS `persona`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `persona` (
  `id_persona` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rfc` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `calle` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `num_exterior` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `num_interior` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `colonia` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ciudad` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `estado` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `codigo_postal` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pais` varchar(80) COLLATE utf8_unicode_ci DEFAULT 'MEXICO',
  `email` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_registro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `id_usuario_tipo` bigint(20) NOT NULL,
  `ap_paterno` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ap_materno` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `st_idcliente` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha_nacimiento` text COLLATE utf8_unicode_ci,
  `status` varchar(45) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'ACTIVO',
  `id_tienda` int(11) DEFAULT NULL,
  `razon_social` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lada` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `observaciones` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `banco` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `num_cuenta` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dir_cuenta` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tiempo_credito` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `celular` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_persona`),
  KEY `fk_persona_usuario_tipo1_idx` (`id_usuario_tipo`),
  KEY `id_tienda_idx` (`id_tienda`),
  CONSTRAINT `fk_persona_usuario_tipo1` FOREIGN KEY (`id_usuario_tipo`) REFERENCES `usuario_tipo` (`id_usuario_tipo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10113 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `persona`
--

LOCK TABLES `persona` WRITE;
/*!40000 ALTER TABLE `persona` DISABLE KEYS */;
INSERT INTO `persona` VALUES (1,'Administrador','1234','calle1','1','2','col','cd','edo','1233','MEXICO','email@hotmail.com','2014-07-28 16:44:21',2,'adminpat','adminmat','','07/15/2014','ACTIVO',1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2,'','234567','Calle','num exte12','13','Colonia','cuidad','df','1212','MEXICO','jor_yor_@hotmail.com','2014-07-28 17:28:59',1,'','','1234567','07/01/1990','ACTIVO',1,'Publico en General','','','','','','','',''),(3,'OD','123','Calle','num exte12','num int 123','Colonia','ciudad','estado','1234cp','MEXICO','jor_yor_@hotmail.com','2014-07-28 17:37:24',3,'INTERNATIONAL',' 1','','07/14/2014','ACTIVO',1,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL),(10098,'eduardo','jone','','','','','','','','MEXICO','','2016-02-24 15:36:48',4,'joloy','nahmias','','02/16/2016','ACTIVO',13,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(10099,'l','123','','','','','','','','MEXICO','','2016-02-24 18:06:19',4,'l','l','','02/29/2016','ACTIVO',13,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(10100,'agenda',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'MEXICO','','2016-03-01 22:06:54',1,'ap','am',NULL,NULL,'ACTIVO',12,'pruebas sa de cv',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'123'),(10101,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'MEXICO','','2016-03-01 22:19:52',1,'','',NULL,NULL,'BAJA',12,'pruebasaaaaa',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'asasa'),(10102,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'MEXICO','','2016-03-01 22:23:31',1,'','',NULL,NULL,'BAJA',12,'sddfghjhklk;jtre',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(10103,'sdf',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'MEXICO','','2016-03-01 22:26:17',1,'','',NULL,NULL,'BAJA',12,'sadfcbn',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(10104,'fefefefefef',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'MEXICO','','2016-03-01 22:33:12',1,'','',NULL,NULL,'BAJA',12,'freffrfe',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(10105,'tyt',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'MEXICO','','2016-03-01 22:36:07',1,'ty','ty',NULL,NULL,'BAJA',12,'tytyty',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(10106,'nvocliii',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'MEXICO','','2016-03-01 22:37:57',1,'','',NULL,NULL,'ACTIVO',12,'nvocliii',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(10107,'dsds',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'MEXICO','','2016-03-01 22:38:47',1,'sdsd','',NULL,NULL,'BAJA',12,'dsdsd',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(10108,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'MEXICO','','2016-03-03 17:41:03',1,'','',NULL,NULL,'BAJA',12,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(10109,'jjoorrr123',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'MEXICO','','2016-03-07 19:12:28',4,NULL,NULL,NULL,NULL,'ACTIVO',13,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(10110,'a',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'MEXICO','','2016-03-07 19:55:23',1,'b','c',NULL,NULL,'ACTIVO',12,'pruebaa789',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(10111,'Ana Rojas',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'MEXICO','','2016-03-14 20:55:32',2,NULL,NULL,NULL,NULL,'ACTIVO',4,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(10112,'prueba',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'MEXICO','','2016-05-12 16:16:05',1,'kdjfkls','klsgkl',NULL,NULL,'ACTIVO',12,'prueba',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `persona` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `preciomayoreo`
--

DROP TABLE IF EXISTS `preciomayoreo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `preciomayoreo` (
  `CLAVE` varchar(12) DEFAULT NULL,
  `PRODUCTO` varchar(36) DEFAULT NULL,
  `PRECIO` decimal(5,2) DEFAULT NULL,
  `PEDIDO` varchar(10) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `preciomayoreo`
--

LOCK TABLES `preciomayoreo` WRITE;
/*!40000 ALTER TABLE `preciomayoreo` DISABLE KEYS */;
/*!40000 ALTER TABLE `preciomayoreo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `precios`
--

DROP TABLE IF EXISTS `precios`;
/*!50001 DROP VIEW IF EXISTS `precios`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `precios` (
  `precio` tinyint NOT NULL,
  `precio_mayoreo` tinyint NOT NULL,
  `id_tienda` tinyint NOT NULL,
  `existencias` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `producto`
--

DROP TABLE IF EXISTS `producto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `producto` (
  `id_producto` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `precio` double DEFAULT NULL,
  `costo` double DEFAULT NULL,
  `precio_descuento` double DEFAULT '0',
  `descuento_activado` tinyint(4) DEFAULT '0',
  `status` varchar(45) COLLATE utf8_unicode_ci DEFAULT 'ACTIVO',
  `codbarras` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_proveedor` int(11) NOT NULL,
  `id_marca` int(11) NOT NULL,
  `multiplicador` double DEFAULT NULL,
  `id_categoria` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `codinter` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `condiciones` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `exento_iva` int(11) DEFAULT '0',
  `ieps` double DEFAULT '0',
  `paquete` tinyint(4) DEFAULT '0',
  `alerta_minima` double DEFAULT NULL,
  `exento_ieps` tinyint(4) DEFAULT '0',
  `precio_costo` double DEFAULT '0',
  `imagen` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id_producto`),
  KEY `nombre` (`nombre`),
  KEY `fk_producto_proveedor1_idx` (`id_proveedor`),
  KEY `fk_producto_marca1_idx` (`id_marca`),
  KEY `fk_producto_categoria1_idx` (`id_categoria`),
  CONSTRAINT `fk_producto_categoria1` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_producto_marca1` FOREIGN KEY (`id_marca`) REFERENCES `marca` (`id_marca`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_producto_proveedor1` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id_proveedor`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `producto`
--

LOCK TABLES `producto` WRITE;
/*!40000 ALTER TABLE `producto` DISABLE KEYS */;
INSERT INTO `producto` VALUES (5,'Producto1',1.74,1,1.3,0,'BAJA','12345',1,1,1.5,'1','2016-02-11 15:39:47','cod12345','1.16',0,0,0,1,1,1,NULL),(6,'Paquete1',8.7,5,6.5,0,'BAJA','1212',1,1,1.5,'1','2016-02-11 15:41:40','cod1212','1.16',0,0,1,1,1,5,'20160308_11:55:1412233424_10201070231514829_487239831_n.jpg'),(7,'Producto2',3.48,2,2.6,0,'BAJA','54321',1,1,1.5,'1','2016-02-12 01:18:41','cod54321','1.16',0,0,0,1,1,2.2,'20160308_11:55:1412233424_10201070231514829_487239831_n.jpg'),(8,'Milk Lotion',1392,800,600,0,'ACTIVO','5555',1,1,1.5,'1','2016-02-24 17:42:17','ml165','1.16',0,0,0,25,1,300,''),(9,'1232',1.74,1,1.3,0,'BAJA','12345',1,1,1.5,'1','2016-03-08 17:55:14','12345','1.16',0,0,0,1,1,1.1,'20160308_11:55:1412233424_10201070231514829_487239831_n.jpg'),(10,'PRODUCTOPRUEBA',174,100,130,0,'ACTIVO','123132',1,4,1.5,'1','2016-03-15 23:25:52','PRUEBA1111','1.16',0,0,1,2,1,110,'20160315_05:25:52hormiga.jpg');
/*!40000 ALTER TABLE `producto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `producto_tienda`
--

DROP TABLE IF EXISTS `producto_tienda`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `producto_tienda` (
  `id_productotienda` int(11) NOT NULL AUTO_INCREMENT,
  `existencias` double DEFAULT '0',
  `status` varchar(45) DEFAULT 'ACTIVO',
  `tienda_id_tienda` int(11) NOT NULL,
  `id_producto` bigint(20) NOT NULL,
  `alerta_minima` double DEFAULT NULL,
  PRIMARY KEY (`id_productotienda`),
  KEY `fk_producto_tienda_tienda1_idx` (`tienda_id_tienda`),
  KEY `fk_producto_tienda_producto1_idx` (`id_producto`),
  CONSTRAINT `fk_producto_tienda_producto1` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_producto_tienda_tienda1` FOREIGN KEY (`tienda_id_tienda`) REFERENCES `tienda` (`id_tienda`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `producto_tienda`
--

LOCK TABLES `producto_tienda` WRITE;
/*!40000 ALTER TABLE `producto_tienda` DISABLE KEYS */;
INSERT INTO `producto_tienda` VALUES (1,10,'ACTIVO',12,5,NULL),(2,8,'ACTIVO',12,7,NULL),(3,0,'ACTIVO',13,5,NULL),(4,2,'ACTIVO',13,7,NULL),(5,1,'ACTIVO',15,5,NULL),(6,2,'ACTIVO',12,6,NULL),(7,0,'ACTIVO',13,6,NULL),(8,30,'ACTIVO',12,8,NULL),(9,1,'ACTIVO',15,8,NULL),(10,14,'ACTIVO',14,8,NULL),(11,108,'ACTIVO',13,8,NULL),(12,50,'ACTIVO',13,10,NULL),(13,51,'ACTIVO',14,10,NULL),(14,100,'ACTIVO',4,8,NULL);
/*!40000 ALTER TABLE `producto_tienda` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productos_venta`
--

DROP TABLE IF EXISTS `productos_venta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `productos_venta` (
  `id_productos_venta` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_venta` bigint(20) NOT NULL,
  `cantidad` double DEFAULT NULL,
  `nombre` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `total` double DEFAULT NULL,
  `cancelado` tinyint(4) DEFAULT '0',
  `id_productotienda` int(11) NOT NULL,
  `costototal` double DEFAULT '0',
  `status` varchar(45) COLLATE utf8_unicode_ci DEFAULT 'ACTIVO',
  `folio` int(11) DEFAULT NULL,
  `paquete` int(11) DEFAULT '0',
  `tipoprecio` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_productos_venta`),
  KEY `fk_productos_venta_venta1` (`id_venta`),
  KEY `fk_productos_venta_producto1_idx` (`id_productotienda`),
  CONSTRAINT `fk_productos_venta_producto1` FOREIGN KEY (`id_productotienda`) REFERENCES `producto_tienda` (`id_productotienda`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_productos_venta_venta1` FOREIGN KEY (`id_venta`) REFERENCES `venta` (`id_venta`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productos_venta`
--

LOCK TABLES `productos_venta` WRITE;
/*!40000 ALTER TABLE `productos_venta` DISABLE KEYS */;
INSERT INTO `productos_venta` VALUES (1,1,1,'Producto1',1.74,0,3,1,'ACTIVO',1,0,'tienda'),(2,2,1,'Paquete1',8.7,0,7,5,'ACTIVO',2,1,'tienda'),(3,7,1,'Producto1',100,0,1,1,'ACTIVO',1,0,'tienda'),(4,8,1,'Paquete1',100,0,6,5,'ACTIVO',2,1,'tienda'),(5,9,1,'Producto1',80,0,1,1,'ACTIVO',3,0,'tienda'),(6,10,1,'Producto1',100,0,3,1,'ACTIVO',3,0,'tienda'),(7,11,1,'Milk Lotion',1500,0,8,800,'ACTIVO',4,0,'tienda'),(8,13,1,'Producto2',10,0,2,2,'ACTIVO',5,0,'tienda'),(9,14,1,'Producto2',10,0,4,2,'ACTIVO',4,0,'tienda'),(10,15,1,'Paquete1',150,0,6,5,'ACTIVO',6,1,'tienda');
/*!40000 ALTER TABLE `productos_venta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proveedor`
--

DROP TABLE IF EXISTS `proveedor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proveedor` (
  `id_proveedor` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_corto` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `info_adicional` text COLLATE utf8_unicode_ci,
  `id_persona` bigint(20) NOT NULL,
  PRIMARY KEY (`id_proveedor`),
  KEY `fk_proveedor_persona1_idx` (`id_persona`),
  CONSTRAINT `fk_proveedor_persona1` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id_persona`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proveedor`
--

LOCK TABLES `proveedor` WRITE;
/*!40000 ALTER TABLE `proveedor` DISABLE KEYS */;
INSERT INTO `proveedor` VALUES (1,'OD INTERNATIONAL','','',3);
/*!40000 ALTER TABLE `proveedor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `salida`
--

DROP TABLE IF EXISTS `salida`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `salida` (
  `id_salida` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_registro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha` timestamp NULL DEFAULT NULL,
  `costo_total` double DEFAULT NULL,
  `total` double DEFAULT NULL,
  `concepto` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT 'Traspaso de Almacen',
  `referencia` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `cancelado` tinyint(4) DEFAULT '0',
  `id_usuario` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `id_tienda` int(11) DEFAULT '6',
  `comentarios` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT 'POR AUTORIZAR',
  `ticket_items` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `id_tiendaanterior` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_salida`),
  KEY `id_tienda_idx` (`id_tienda`),
  KEY `id_usu_idx` (`id_usuario`),
  KEY `id_tien_idx` (`id_tiendaanterior`),
  CONSTRAINT `id_tien` FOREIGN KEY (`id_tiendaanterior`) REFERENCES `tienda` (`id_tienda`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `salida`
--

LOCK TABLES `salida` WRITE;
/*!40000 ALTER TABLE `salida` DISABLE KEYS */;
/*!40000 ALTER TABLE `salida` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `salida_producto`
--

DROP TABLE IF EXISTS `salida_producto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `salida_producto` (
  `id_salida_producto` int(11) NOT NULL AUTO_INCREMENT,
  `id_producto` bigint(20) NOT NULL,
  `fechare_gistro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `cantidad` double DEFAULT NULL,
  `status` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'ACTIVO',
  `costo` double NOT NULL DEFAULT '0',
  `multiplicador` double DEFAULT NULL,
  `precio` double DEFAULT NULL,
  `iva` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `cantvendida` double DEFAULT '0',
  `ieps` double DEFAULT '0',
  `id_salida` int(11) NOT NULL,
  `totalcosto` double DEFAULT '0',
  `nombre` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_tienda` int(11) DEFAULT NULL,
  `precio_descuento` double DEFAULT NULL,
  `cancelado` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id_salida_producto`),
  KEY `id_salida_idx` (`id_salida`),
  KEY `id_p_idx` (`id_producto`),
  CONSTRAINT `id_p` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `id_sali` FOREIGN KEY (`id_salida`) REFERENCES `salida` (`id_salida`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `salida_producto`
--

LOCK TABLES `salida_producto` WRITE;
/*!40000 ALTER TABLE `salida_producto` DISABLE KEYS */;
/*!40000 ALTER TABLE `salida_producto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tienda`
--

DROP TABLE IF EXISTS `tienda`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tienda` (
  `id_tienda` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `info_adicional` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT 'ACTIVA',
  `ubicacion` varchar(100) DEFAULT NULL,
  `permiso_adicional` int(11) DEFAULT '0',
  PRIMARY KEY (`id_tienda`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tienda`
--

LOCK TABLES `tienda` WRITE;
/*!40000 ALTER TABLE `tienda` DISABLE KEYS */;
INSERT INTO `tienda` VALUES (4,'No Seleccionada','','','BAJA','*',0),(12,'Almacen','','','ACTIVA','',0),(13,'Tienda1','','','ACTIVA','',0),(14,'Tienda2','','','ACTIVA','',0),(15,'Tienda3','','','BAJA','',0),(16,'Prueba','5567665','hdufg','BAJA','prueba',0),(17,'SANTA FE','','','ACTIVA','AV. VASCO DE QUIROGA 3900 CC SANTA FE',0),(18,'GALERIAS INSURGENTES','','','ACTIVA','PARROQUIA 194, COL. DEL VALLE',0),(19,'PARQUE TEZONTLE','','','ACTIVA','AV. CANAL DE TEZONTLE NO. 1512, COL. ALFONSO ORTIZ TIRADO',0),(20,'PARQUE DELTA','','','ACTIVA','AV. CUAUHTEMOC 462, COL. NARVARTE',0);
/*!40000 ALTER TABLE `tienda` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `traspaso`
--

DROP TABLE IF EXISTS `traspaso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `traspaso` (
  `id_traspaso` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_registro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha` timestamp NULL DEFAULT NULL,
  `costo_total` double DEFAULT NULL,
  `total` double DEFAULT NULL,
  `concepto` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT 'Traspaso de Almacen',
  `folio` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `referencia` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `cancelado` tinyint(4) DEFAULT '0',
  `id_usuario` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `id_tienda` int(11) NOT NULL DEFAULT '6',
  `comentarios` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT 'SOLICITADO',
  `ticket_items` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `id_tiendaanterior` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_traspaso`),
  KEY `id_tienda_idx` (`id_tienda`),
  KEY `id_usu_idx` (`id_usuario`),
  CONSTRAINT `id_tiend` FOREIGN KEY (`id_tienda`) REFERENCES `tienda` (`id_tienda`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `id_usu` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `traspaso`
--

LOCK TABLES `traspaso` WRITE;
/*!40000 ALTER TABLE `traspaso` DISABLE KEYS */;
INSERT INTO `traspaso` VALUES (1,'2016-02-12 02:02:10','2016-02-11 06:00:00',13,8,'TRASPASO A ALMACEN',NULL,'pruebas 789',0,'789.mx',13,'pruebas de traspasos','ACTIVO','\r\n        <tbody><tr>\r\n            <th>Cantidad</th>\r\n            <th>Codigo Interno</th>\r\n            <th>Producto</th>\r\n            <th>Costo</th>\r\n            <th>Precio</th>\r\n            <th>Precio Mayoreo</th>\r\n            <th>Importe</th>\r\n            \r\n        </tr>\r\n    <tr class=\"producto\" lineid=\"15704\">\r\n    <td>\r\n        <div id=\"cantidad15704\" placeholder=\"$0.00\">3</div>\r\n\r\n        <input type=\"hidden\" name=\"id_producto[]\" value=\"5\">\r\n        <input type=\"hidden\" name=\"cantidad[]\" value=\"3\">\r\n    </td>\r\n    <td>\r\n        cod12345    </td>\r\n    <td>\r\n        Producto1    </td>\r\n    <td>\r\n        <input type=\"text\" name=\"costo[]\" class=\"small-field\" readonly=\"\" id=\"costo15704\" onkeyup=\"calculaprecio(15704)\" style=\"width: 30\" pattern=\"[0-9]+([\\.|,][0-9]+)?>$\" placeholder=\"$0.00\" value=\"1\">    </td>\r\n    <td>\r\n        <input type=\"text\" name=\"precio[]\" class=\"small-field\" readonly=\"\" id=\"precio15704\" style=\"width: 30\" pattern=\"[0-9]+([\\.|,][0-9]+)?>$\" placeholder=\"$0.00\" value=\"1.74\">    </td>\r\n    <td>\r\n        <input type=\"text\" name=\"precio_descuento[]\" readonly=\"\" class=\"small-field\" id=\"precio_descuento15704\" style=\"width: 30\" pattern=\"[0-9]+([\\.|,][0-9]+)?>$\" placeholder=\"$0.00\" value=\"1.74\">    </td>\r\n    <td>\r\n\r\n        <input type=\"hidden\" value=\"0\">\r\n       \r\n        <div class=\"totales\" id=\"importe15704\">3</div><input type=\"hidden\" value=\"3\" name=\"total[]\" id=\"importe215704\">    </td>\r\n\r\n    \r\n</tr>\r\n                \r\n                \r\n                \r\n                <tr class=\"producto\" lineid=\"77427\">\r\n    <td>\r\n        <div id=\"cantidad77427\" placeholder=\"$0.00\">5</div>\r\n\r\n        <input type=\"hidden\" name=\"id_producto[]\" value=\"7\">\r\n        <input type=\"hidden\" name=\"cantidad[]\" value=\"5\">\r\n    </td>\r\n    <td>\r\n        cod54321    </td>\r\n    <td>\r\n        Producto2    </td>\r\n    <td>\r\n        <input type=\"text\" name=\"costo[]\" class=\"small-field\" readonly=\"\" id=\"costo77427\" onkeyup=\"calculaprecio(77427)\" style=\"width: 30\" pattern=\"[0-9]+([\\.|,][0-9]+)?>$\" placeholder=\"$0.00\" value=\"2\">    </td>\r\n    <td>\r\n        <input type=\"text\" name=\"precio[]\" class=\"small-field\" readonly=\"\" id=\"precio77427\" style=\"width: 30\" pattern=\"[0-9]+([\\.|,][0-9]+)?>$\" placeholder=\"$0.00\" value=\"3.48\">    </td>\r\n    <td>\r\n        <input type=\"text\" name=\"precio_descuento[]\" readonly=\"\" class=\"small-field\" id=\"precio_descuento77427\" style=\"width: 30\" pattern=\"[0-9]+([\\.|,][0-9]+)?>$\" placeholder=\"$0.00\" value=\"3.48\">    </td>\r\n    <td>\r\n\r\n        <input type=\"hidden\" value=\"0\">\r\n       \r\n        <div class=\"totales\" id=\"importe77427\">10</div><input type=\"hidden\" value=\"10\" name=\"total[]\" id=\"importe277427\">    </td>\r\n\r\n    \r\n</tr>\r\n                \r\n                </tbody>',12),(2,'2016-02-12 02:09:18','2016-02-11 06:00:00',1,1,'TRASPASO A ALMACEN',NULL,'pruebas 789',0,'789.mx',15,'traspaso a tienda 3','ACTIVO','\r\n        <tbody><tr>\r\n            <th>Cantidad</th>\r\n            <th>Codigo Interno</th>\r\n            <th>Producto</th>\r\n            <th>Costo</th>\r\n            <th>Precio</th>\r\n            <th>Precio Mayoreo</th>\r\n            <th>Importe</th>\r\n            \r\n        </tr>\r\n    <tr class=\"producto\" lineid=\"14916\">\r\n    <td>\r\n        <div id=\"cantidad14916\" placeholder=\"$0.00\">1</div>\r\n\r\n        <input type=\"hidden\" name=\"id_producto[]\" value=\"5\">\r\n        <input type=\"hidden\" name=\"cantidad[]\" value=\"1\">\r\n    </td>\r\n    <td>\r\n        cod12345    </td>\r\n    <td>\r\n        Producto1    </td>\r\n    <td>\r\n        <input type=\"text\" name=\"costo[]\" class=\"small-field\" readonly=\"\" id=\"costo14916\" onkeyup=\"calculaprecio(14916)\" style=\"width: 30\" pattern=\"[0-9]+([\\.|,][0-9]+)?>$\" placeholder=\"$0.00\" value=\"1\">    </td>\r\n    <td>\r\n        <input type=\"text\" name=\"precio[]\" class=\"small-field\" readonly=\"\" id=\"precio14916\" style=\"width: 30\" pattern=\"[0-9]+([\\.|,][0-9]+)?>$\" placeholder=\"$0.00\" value=\"1.74\">    </td>\r\n    <td>\r\n        <input type=\"text\" name=\"precio_descuento[]\" readonly=\"\" class=\"small-field\" id=\"precio_descuento14916\" style=\"width: 30\" pattern=\"[0-9]+([\\.|,][0-9]+)?>$\" placeholder=\"$0.00\" value=\"1.74\">    </td>\r\n    <td>\r\n\r\n        <input type=\"hidden\" value=\"0\">\r\n       \r\n        <div class=\"totales\" id=\"importe14916\">1</div><input type=\"hidden\" value=\"1\" name=\"total[]\" id=\"importe214916\">    </td>\r\n\r\n    \r\n</tr>\r\n                \r\n                </tbody>',13),(3,'2016-02-12 02:51:53','2016-02-11 06:00:00',5,1,'TRASPASO A ALMACEN',NULL,'pruebas 789',0,'789.mx',13,'traspaso de paquete','ACTIVO','\r\n        <tbody><tr>\r\n            <th>Cantidad</th>\r\n            <th>Codigo Interno</th>\r\n            <th>Producto</th>\r\n            <th>Costo</th>\r\n            <th>Precio</th>\r\n            <th>Precio Mayoreo</th>\r\n            <th>Importe</th>\r\n            \r\n        </tr>\r\n    <tr class=\"producto\" lineid=\"25900\">\r\n    <td>\r\n        <div id=\"cantidad25900\" placeholder=\"$0.00\">1</div>\r\n\r\n        <input type=\"hidden\" name=\"id_producto[]\" value=\"6\">\r\n        <input type=\"hidden\" name=\"cantidad[]\" value=\"1\">\r\n    </td>\r\n    <td>\r\n        cod1212    </td>\r\n    <td>\r\n        Paquete1    </td>\r\n    <td>\r\n        <input type=\"text\" name=\"costo[]\" class=\"small-field\" readonly=\"\" id=\"costo25900\" onkeyup=\"calculaprecio(25900)\" style=\"width: 30\" pattern=\"[0-9]+([\\.|,][0-9]+)?>$\" placeholder=\"$0.00\" value=\"5\">    </td>\r\n    <td>\r\n        <input type=\"text\" name=\"precio[]\" class=\"small-field\" readonly=\"\" id=\"precio25900\" style=\"width: 30\" pattern=\"[0-9]+([\\.|,][0-9]+)?>$\" placeholder=\"$0.00\" value=\"8.7\">    </td>\r\n    <td>\r\n        <input type=\"text\" name=\"precio_descuento[]\" readonly=\"\" class=\"small-field\" id=\"precio_descuento25900\" style=\"width: 30\" pattern=\"[0-9]+([\\.|,][0-9]+)?>$\" placeholder=\"$0.00\" value=\"8.7\">    </td>\r\n    <td>\r\n\r\n        <input type=\"hidden\" value=\"0\">\r\n       \r\n        <div class=\"totales\" id=\"importe25900\">5</div><input type=\"hidden\" value=\"5\" name=\"total[]\" id=\"importe225900\">    </td>\r\n\r\n    \r\n</tr>\r\n                \r\n                </tbody>',12),(4,'2016-02-24 18:22:07','2016-02-16 06:00:00',800,1,'TRASPASO A ALMACEN',NULL,'1',0,'789.mx',15,'','ACTIVO','\r\n        <tbody><tr>\r\n            <th>Cantidad</th>\r\n            <th>Codigo Interno</th>\r\n            <th>Producto</th>\r\n            <th>Costo</th>\r\n            <th>Precio</th>\r\n            <th>Precio Mayoreo</th>\r\n            <th>Importe</th>\r\n            \r\n        </tr>\r\n    <tr class=\"producto\" lineid=\"8481\">\r\n    <td>\r\n        <div id=\"cantidad8481\" placeholder=\"$0.00\">1</div>\r\n\r\n        <input type=\"hidden\" name=\"id_producto[]\" value=\"8\">\r\n        <input type=\"hidden\" name=\"cantidad[]\" value=\"1\">\r\n    </td>\r\n    <td>\r\n        ml165    </td>\r\n    <td>\r\n        Milk Lotion    </td>\r\n    <td>\r\n        <input type=\"text\" name=\"costo[]\" class=\"small-field\" readonly=\"\" id=\"costo8481\" onkeyup=\"calculaprecio(8481)\" style=\"width: 30\" pattern=\"[0-9]+([\\.|,][0-9]+)?>$\" placeholder=\"$0.00\" value=\"800\">    </td>\r\n    <td>\r\n        <input type=\"text\" name=\"precio[]\" class=\"small-field\" readonly=\"\" id=\"precio8481\" style=\"width: 30\" pattern=\"[0-9]+([\\.|,][0-9]+)?>$\" placeholder=\"$0.00\" value=\"1392\">    </td>\r\n    <td>\r\n        <input type=\"text\" name=\"precio_descuento[]\" readonly=\"\" class=\"small-field\" id=\"precio_descuento8481\" style=\"width: 30\" pattern=\"[0-9]+([\\.|,][0-9]+)?>$\" placeholder=\"$0.00\" value=\"1392\">    </td>\r\n    <td>\r\n\r\n        <input type=\"hidden\" value=\"0\">\r\n       \r\n        <div class=\"totales\" id=\"importe8481\">800</div><input type=\"hidden\" value=\"800\" name=\"total[]\" id=\"importe28481\">    </td>\r\n\r\n    \r\n</tr>\r\n                \r\n                </tbody>',12),(5,'2016-02-24 18:23:39','2016-02-22 06:00:00',0,0,'TRASPASO A ALMACEN',NULL,'1',0,'789.mx',14,'','POR AUTORIZAR','\r\n        <tbody><tr>\r\n            <th>Cantidad</th>\r\n            <th>Codigo Interno</th>\r\n            <th>Producto</th>\r\n            <th>Costo</th>\r\n            <th>Precio</th>\r\n            <th>Precio Mayoreo</th>\r\n            <th>Importe</th>\r\n            \r\n        </tr>\r\n    </tbody>',13),(6,'2016-02-24 18:24:02','2016-02-22 06:00:00',0,0,'TRASPASO A ALMACEN',NULL,'1',0,'789.mx',14,'','POR AUTORIZAR','\r\n        <tbody><tr>\r\n            <th>Cantidad</th>\r\n            <th>Codigo Interno</th>\r\n            <th>Producto</th>\r\n            <th>Costo</th>\r\n            <th>Precio</th>\r\n            <th>Precio Mayoreo</th>\r\n            <th>Importe</th>\r\n            \r\n        </tr>\r\n    </tbody>',13),(7,'2016-03-08 17:17:47','2016-03-08 06:00:00',8000,10,'TRASPASO A ALMACEN',NULL,'prueba',0,'789.mx',14,'','ACTIVO','\r\n        <tbody><tr>\r\n            <th>Cantidad</th>\r\n            <th>Codigo Interno</th>\r\n            <th>Producto</th>\r\n            <th>Costo</th>\r\n            <th>Precio</th>\r\n            <th>Precio Mayoreo</th>\r\n            <th>Importe</th>\r\n            \r\n        </tr>\r\n    <tr class=\"producto\" lineid=\"86123\">\r\n    <td>\r\n        <div id=\"cantidad86123\" placeholder=\"$0.00\">10</div>\r\n\r\n        <input type=\"hidden\" name=\"id_producto[]\" value=\"8\">\r\n        <input type=\"hidden\" name=\"cantidad[]\" value=\"10\">\r\n    </td>\r\n    <td>\r\n        ml165    </td>\r\n    <td>\r\n        Milk Lotion    </td>\r\n    <td>\r\n        <input type=\"text\" name=\"costo[]\" class=\"small-field\" readonly=\"\" id=\"costo86123\" onkeyup=\"calculaprecio(86123)\" style=\"width: 30\" pattern=\"[0-9]+([\\.|,][0-9]+)?>$\" placeholder=\"$0.00\" value=\"800\">    </td>\r\n    <td>\r\n        <input type=\"text\" name=\"precio[]\" class=\"small-field\" readonly=\"\" id=\"precio86123\" style=\"width: 30\" pattern=\"[0-9]+([\\.|,][0-9]+)?>$\" placeholder=\"$0.00\" value=\"1392\">    </td>\r\n    <td>\r\n        <input type=\"text\" name=\"precio_descuento[]\" readonly=\"\" class=\"small-field\" id=\"precio_descuento86123\" style=\"width: 30\" pattern=\"[0-9]+([\\.|,][0-9]+)?>$\" placeholder=\"$0.00\" value=\"1392\">    </td>\r\n    <td>\r\n\r\n        <input type=\"hidden\" value=\"0\">\r\n       \r\n        <div class=\"totales\" id=\"importe86123\">8000</div><input type=\"hidden\" value=\"8000\" name=\"total[]\" id=\"importe286123\">    </td>\r\n\r\n    \r\n</tr>\r\n                \r\n                </tbody>',12),(8,'2016-03-08 17:20:37','2016-03-08 06:00:00',8000,10,'TRASPASO A ALMACEN',NULL,'',0,'789.mx',13,'','ACTIVO','\r\n        <tbody><tr>\r\n            <th>Cantidad</th>\r\n            <th>Codigo Interno</th>\r\n            <th>Producto</th>\r\n            <th>Costo</th>\r\n            <th>Precio</th>\r\n            <th>Precio Mayoreo</th>\r\n            <th>Importe</th>\r\n            \r\n        </tr>\r\n    <tr class=\"producto\" lineid=\"15913\">\r\n    <td>\r\n        <div id=\"cantidad15913\" placeholder=\"$0.00\">10</div>\r\n\r\n        <input type=\"hidden\" name=\"id_producto[]\" value=\"8\">\r\n        <input type=\"hidden\" name=\"cantidad[]\" value=\"10\">\r\n    </td>\r\n    <td>\r\n        ml165    </td>\r\n    <td>\r\n        Milk Lotion    </td>\r\n    <td>\r\n        <input type=\"text\" name=\"costo[]\" class=\"small-field\" readonly=\"\" id=\"costo15913\" onkeyup=\"calculaprecio(15913)\" style=\"width: 30\" pattern=\"[0-9]+([\\.|,][0-9]+)?>$\" placeholder=\"$0.00\" value=\"800\">    </td>\r\n    <td>\r\n        <input type=\"text\" name=\"precio[]\" class=\"small-field\" readonly=\"\" id=\"precio15913\" style=\"width: 30\" pattern=\"[0-9]+([\\.|,][0-9]+)?>$\" placeholder=\"$0.00\" value=\"1392\">    </td>\r\n    <td>\r\n        <input type=\"text\" name=\"precio_descuento[]\" readonly=\"\" class=\"small-field\" id=\"precio_descuento15913\" style=\"width: 30\" pattern=\"[0-9]+([\\.|,][0-9]+)?>$\" placeholder=\"$0.00\" value=\"1392\">    </td>\r\n    <td>\r\n\r\n        <input type=\"hidden\" value=\"0\">\r\n       \r\n        <div class=\"totales\" id=\"importe15913\">8000</div><input type=\"hidden\" value=\"8000\" name=\"total[]\" id=\"importe215913\">    </td>\r\n\r\n    \r\n</tr>\r\n                \r\n                </tbody>',12),(9,'2016-04-14 17:50:25','2016-04-14 05:00:00',100,1,'TRASPASO A ALMACEN',NULL,'ref prueba',0,'789.mx',14,'','ACTIVO','\r\n        <tbody><tr>\r\n            <th>Cantidad</th>\r\n            <th>Codigo Interno</th>\r\n            <th>Producto</th>\r\n            <th>Costo</th>\r\n            <th>Precio</th>\r\n            <th>Precio Mayoreo</th>\r\n            <th>Importe</th>\r\n            \r\n        </tr>\r\n    <tr class=\"producto\" lineid=\"3404\">\r\n    <td>\r\n        <div id=\"cantidad3404\" placeholder=\"$0.00\">1</div>\r\n\r\n        <input type=\"hidden\" name=\"id_producto[]\" value=\"10\">\r\n        <input type=\"hidden\" name=\"cantidad[]\" value=\"1\">\r\n    </td>\r\n    <td>\r\n        PRUEBA1111    </td>\r\n    <td>\r\n        PRODUCTOPRUEBA    </td>\r\n    <td>\r\n        <input type=\"text\" name=\"costo[]\" class=\"small-field\" readonly=\"\" id=\"costo3404\" onkeyup=\"calculaprecio(3404)\" style=\"width: 30\" pattern=\"[0-9]+([\\.|,][0-9]+)?>$\" placeholder=\"$0.00\" value=\"100\">    </td>\r\n    <td>\r\n        <input type=\"text\" name=\"precio[]\" class=\"small-field\" readonly=\"\" id=\"precio3404\" style=\"width: 30\" pattern=\"[0-9]+([\\.|,][0-9]+)?>$\" placeholder=\"$0.00\" value=\"174\">    </td>\r\n    <td>\r\n        <input type=\"text\" name=\"precio_descuento[]\" readonly=\"\" class=\"small-field\" id=\"precio_descuento3404\" style=\"width: 30\" pattern=\"[0-9]+([\\.|,][0-9]+)?>$\" placeholder=\"$0.00\" value=\"174\">    </td>\r\n    <td>\r\n\r\n        <input type=\"hidden\" value=\"0\">\r\n       \r\n        <div class=\"totales\" id=\"importe3404\">100</div><input type=\"hidden\" value=\"100\" name=\"total[]\" id=\"importe23404\">    </td>\r\n\r\n    \r\n</tr>\r\n                \r\n                </tbody>',13),(10,'2016-05-11 21:17:29','2016-05-11 05:00:00',5000,50,'TRASPASO A ALMACEN',NULL,'ref 1105',0,'789.mx',14,'','ACTIVO','\r\n        <tbody><tr>\r\n            <th>Cantidad</th>\r\n            <th>Codigo Interno</th>\r\n            <th>Producto</th>\r\n            <th>Costo</th>\r\n            <th>Precio</th>\r\n            <th>Precio Mayoreo</th>\r\n            <th>Importe</th>\r\n            \r\n        </tr>\r\n    <tr class=\"producto\" lineid=\"46655\">\r\n    <td>\r\n        <div id=\"cantidad46655\" placeholder=\"$0.00\">50</div>\r\n\r\n        <input type=\"hidden\" name=\"id_producto[]\" value=\"10\">\r\n        <input type=\"hidden\" name=\"cantidad[]\" value=\"50\">\r\n    </td>\r\n    <td>\r\n        PRUEBA1111    </td>\r\n    <td>\r\n        PRODUCTOPRUEBA    </td>\r\n    <td>\r\n        <input type=\"text\" name=\"costo[]\" class=\"small-field\" readonly=\"\" id=\"costo46655\" onkeyup=\"calculaprecio(46655)\" style=\"width: 30\" pattern=\"[0-9]+([\\.|,][0-9]+)?>$\" placeholder=\"$0.00\" value=\"100\">    </td>\r\n    <td>\r\n        <input type=\"text\" name=\"precio[]\" class=\"small-field\" readonly=\"\" id=\"precio46655\" style=\"width: 30\" pattern=\"[0-9]+([\\.|,][0-9]+)?>$\" placeholder=\"$0.00\" value=\"174\">    </td>\r\n    <td>\r\n        <input type=\"text\" name=\"precio_descuento[]\" readonly=\"\" class=\"small-field\" id=\"precio_descuento46655\" style=\"width: 30\" pattern=\"[0-9]+([\\.|,][0-9]+)?>$\" placeholder=\"$0.00\" value=\"174\">    </td>\r\n    <td>\r\n\r\n        <input type=\"hidden\" value=\"0\">\r\n       \r\n        <div class=\"totales\" id=\"importe46655\">5000</div><input type=\"hidden\" value=\"5000\" name=\"total[]\" id=\"importe246655\">    </td>\r\n\r\n    \r\n</tr>\r\n                \r\n                \r\n                \r\n                </tbody>',13),(11,'2016-05-12 16:21:45','2016-05-12 05:00:00',80000,100,'TRASPASO A ALMACEN',NULL,'ref almacén 1205',0,'789.mx',13,'','ACTIVO','\r\n        <tbody><tr>\r\n            <th>Cantidad</th>\r\n            <th>Codigo Interno</th>\r\n            <th>Producto</th>\r\n            <th>Costo</th>\r\n            <th>Precio</th>\r\n            <th>Precio Mayoreo</th>\r\n            <th>Importe</th>\r\n            \r\n        </tr>\r\n    <tr class=\"producto\" lineid=\"94951\">\r\n    <td>\r\n        <div id=\"cantidad94951\" placeholder=\"$0.00\">100</div>\r\n\r\n        <input type=\"hidden\" name=\"id_producto[]\" value=\"8\">\r\n        <input type=\"hidden\" name=\"cantidad[]\" value=\"100\">\r\n    </td>\r\n    <td>\r\n        ml165    </td>\r\n    <td>\r\n        Milk Lotion    </td>\r\n    <td>\r\n        <input type=\"text\" name=\"costo[]\" class=\"small-field\" readonly=\"\" id=\"costo94951\" onkeyup=\"calculaprecio(94951)\" style=\"width: 30\" pattern=\"[0-9]+([\\.|,][0-9]+)?>$\" placeholder=\"$0.00\" value=\"800\">    </td>\r\n    <td>\r\n        <input type=\"text\" name=\"precio[]\" class=\"small-field\" readonly=\"\" id=\"precio94951\" style=\"width: 30\" pattern=\"[0-9]+([\\.|,][0-9]+)?>$\" placeholder=\"$0.00\" value=\"1392\">    </td>\r\n    <td>\r\n        <input type=\"text\" name=\"precio_descuento[]\" readonly=\"\" class=\"small-field\" id=\"precio_descuento94951\" style=\"width: 30\" pattern=\"[0-9]+([\\.|,][0-9]+)?>$\" placeholder=\"$0.00\" value=\"1392\">    </td>\r\n    <td>\r\n\r\n        <input type=\"hidden\" value=\"0\">\r\n       \r\n        <div class=\"totales\" id=\"importe94951\">80000</div><input type=\"hidden\" value=\"80000\" name=\"total[]\" id=\"importe294951\">    </td>\r\n\r\n    \r\n</tr>\r\n                \r\n                </tbody>',12);
/*!40000 ALTER TABLE `traspaso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `traspaso_producto`
--

DROP TABLE IF EXISTS `traspaso_producto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `traspaso_producto` (
  `id_traspaso_producto` int(11) NOT NULL AUTO_INCREMENT,
  `id_producto` bigint(20) NOT NULL,
  `fechare_gistro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `cantidad` double DEFAULT NULL,
  `status` varchar(45) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'ACTIVO',
  `costo` double NOT NULL DEFAULT '0',
  `multiplicador` double DEFAULT NULL,
  `precio` double DEFAULT NULL,
  `iva` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cantvendida` double DEFAULT '0',
  `ieps` double DEFAULT '0',
  `id_traspaso` int(11) NOT NULL,
  `totalcosto` double DEFAULT '0',
  `nombre` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_tienda` int(11) DEFAULT NULL,
  `precio_descuento` double DEFAULT NULL,
  `cancelado` tinyint(4) DEFAULT '0',
  `cant_anterior` int(11) DEFAULT '0',
  PRIMARY KEY (`id_traspaso_producto`),
  KEY `fk_traspaso_producto_producto1` (`id_producto`),
  KEY `id_traspaso_idx` (`id_traspaso`),
  CONSTRAINT `fk_traspaso_producto_producto1` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `id_tra` FOREIGN KEY (`id_traspaso`) REFERENCES `traspaso` (`id_traspaso`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `traspaso_producto`
--

LOCK TABLES `traspaso_producto` WRITE;
/*!40000 ALTER TABLE `traspaso_producto` DISABLE KEYS */;
INSERT INTO `traspaso_producto` VALUES (1,5,'2016-02-12 02:02:10',3,'ACTIVO',1,NULL,1.74,'1.16',0,0,1,3,'Producto1',13,1.74,0,0),(2,7,'2016-02-12 02:02:10',5,'ACTIVO',2,NULL,3.48,'1.16',0,0,1,10,'Producto2',13,3.48,0,0),(3,5,'2016-02-12 02:09:18',1,'ACTIVO',1,NULL,1.74,'1.16',0,0,2,1,'Producto1',15,1.74,0,0),(4,6,'2016-02-12 02:51:53',1,'ACTIVO',5,NULL,8.7,'1.16',0,0,3,5,'Paquete1',13,8.7,0,0),(5,8,'2016-02-24 18:22:07',1,'ACTIVO',800,NULL,1392,'1.16',0,0,4,800,'Milk Lotion',15,1392,0,0),(6,8,'2016-03-08 17:17:47',10,'ACTIVO',800,NULL,1392,'1.16',0,0,7,8000,'Milk Lotion',14,1392,0,0),(7,8,'2016-03-08 17:20:37',10,'ACTIVO',800,NULL,1392,'1.16',0,0,8,8000,'Milk Lotion',13,1392,0,0),(8,10,'2016-04-14 17:50:25',1,'ACTIVO',100,NULL,174,'1.16',0,0,9,100,'PRODUCTOPRUEBA',14,174,0,0),(9,10,'2016-05-11 21:17:29',50,'ACTIVO',100,NULL,174,'1.16',0,0,10,5000,'PRODUCTOPRUEBA',14,174,0,0),(10,8,'2016-05-12 16:21:45',100,'ACTIVO',800,NULL,1392,'1.16',0,0,11,80000,'Milk Lotion',13,1392,0,0);
/*!40000 ALTER TABLE `traspaso_producto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `id_usuario` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `session_id` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(45) COLLATE utf8_unicode_ci DEFAULT 'ACTIVO',
  `id_usuario_tipo` bigint(20) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_tienda` int(11) DEFAULT NULL,
  `permisos` varchar(45) COLLATE utf8_unicode_ci DEFAULT 'TODO',
  PRIMARY KEY (`id_usuario`),
  KEY `fk_usuario_usuario_tipo1_idx` (`id_usuario_tipo`),
  KEY `id_tienda_idx` (`id_tienda`),
  CONSTRAINT `fk_usuario_usuario_tipo1` FOREIGN KEY (`id_usuario_tipo`) REFERENCES `usuario_tipo` (`id_usuario_tipo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `id_tienda` FOREIGN KEY (`id_tienda`) REFERENCES `tienda` (`id_tienda`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES ('2385','ana2385','7e6ee836a820938ad56a5a92b463d262','ACTIVO',2,'Ana Rojas',4,'TODO'),('789.mx','control','18f45420377860bfe40538156209ba78','ACTIVO',2,'Administrador',12,'TODO'),('ejoloy','12345','1b4b2afcffbf6987c0c94e5d77eb9bf4','ACTIVO',4,'eduardo',13,'TODO'),('jorge','jorge','ae5350852b1fa563b131b2f39cd649fc','ACTIVO',2,'jorge',13,'TODO'),('jorge123','12345678',NULL,'ACTIVO',4,'jjoorrr123',13,'TODO'),('liron','12345','496cc132bd8256ff3de9fa5f75a1a605','ACTIVO',4,'l',13,'TODO'),('prueba','prueba','18c678fe28668a9d4dd02c1ed6f02a4d','ACTIVO',2,'prueba',14,'VENDEDOR'),('vendedor1','vendedor1','b6e6995b993f6986aa087db5ebf796e4','ACTIVO',2,'vendedor1',13,'TODO'),('vendedor2','vendedor2',NULL,'ACTIVO',4,'vendedor2',12,'VENDEDOR');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario_tipo`
--

DROP TABLE IF EXISTS `usuario_tipo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario_tipo` (
  `id_usuario_tipo` bigint(20) NOT NULL AUTO_INCREMENT,
  `usuario_tipo` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_usuario_tipo`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario_tipo`
--

LOCK TABLES `usuario_tipo` WRITE;
/*!40000 ALTER TABLE `usuario_tipo` DISABLE KEYS */;
INSERT INTO `usuario_tipo` VALUES (1,'Cliente'),(2,'Administrador'),(3,'Proveedor'),(4,'Empleado');
/*!40000 ALTER TABLE `usuario_tipo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios_venta`
--

DROP TABLE IF EXISTS `usuarios_venta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios_venta` (
  `id_usuarios_venta` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` varchar(45) DEFAULT NULL,
  `fecha_registro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `id_venta` bigint(20) DEFAULT NULL,
  `porcentaje` int(11) DEFAULT NULL,
  `monto` double DEFAULT NULL,
  PRIMARY KEY (`id_usuarios_venta`),
  KEY `id_ventadx_idx` (`id_venta`),
  CONSTRAINT `id_ventadx` FOREIGN KEY (`id_venta`) REFERENCES `venta` (`id_venta`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios_venta`
--

LOCK TABLES `usuarios_venta` WRITE;
/*!40000 ALTER TABLE `usuarios_venta` DISABLE KEYS */;
INSERT INTO `usuarios_venta` VALUES (1,'789.mx','2016-02-23 06:09:07',7,70,70),(2,'vendedor2','2016-02-23 06:09:07',7,30,30),(4,'789.mx','2016-02-23 06:10:22',8,25,25),(5,'vendedor2','2016-02-23 06:10:22',8,75,75),(6,'789.mx','2016-02-24 17:14:12',9,100,0),(7,'vendedor1','2016-02-24 17:28:16',10,50,50),(8,'vendedor2','2016-02-24 17:28:16',10,50,50),(9,'789.mx','2016-02-24 17:51:55',11,80,1200),(10,'jorge','2016-02-24 17:51:55',11,20,300),(11,'789.mx','2016-03-07 05:18:54',13,100,10),(12,'jorge','2016-03-07 05:18:54',13,0,0),(13,'prueba','2016-03-07 05:18:54',13,0,0),(14,'jorge','2016-03-31 17:01:03',14,100,10),(15,'789.mx','2016-04-14 18:02:55',15,100,135);
/*!40000 ALTER TABLE `usuarios_venta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `valida_inventario`
--

DROP TABLE IF EXISTS `valida_inventario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `valida_inventario` (
  `id_validainventario` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` varchar(45) DEFAULT NULL,
  `fecha_registro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_validacion` varchar(45) DEFAULT NULL,
  `comentarios` varchar(45) DEFAULT NULL,
  `estatus_validacion` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT 'ACTIVO',
  `cantidad` double DEFAULT NULL,
  PRIMARY KEY (`id_validainventario`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `valida_inventario`
--

LOCK TABLES `valida_inventario` WRITE;
/*!40000 ALTER TABLE `valida_inventario` DISABLE KEYS */;
INSERT INTO `valida_inventario` VALUES (1,NULL,'2016-03-15 19:19:55','2016-03-15','pruebas  esta correcto todo ','Correcto','ACTIVO',0),(2,NULL,'2016-03-15 19:26:00','2016-03-15','pruebas  esta correcto todo ','Correcto','ACTIVO',0),(3,'jorge','2016-03-15 19:26:31','2016-03-15','pruebas  esta correcto todo ','Correcto','ACTIVO',0);
/*!40000 ALTER TABLE `valida_inventario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `validaentrada`
--

DROP TABLE IF EXISTS `validaentrada`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `validaentrada` (
  `id_validaentrada` int(11) NOT NULL AUTO_INCREMENT,
  `id_entrada` int(11) DEFAULT NULL,
  `cantidad` double DEFAULT NULL,
  `status` varchar(45) DEFAULT 'ACTIVO',
  `fecha_registro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `id_usuario` varchar(45) DEFAULT NULL,
  `validaentradacol` varchar(45) DEFAULT NULL,
  `cancelado` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id_validaentrada`),
  KEY `id_entradaprod_idx` (`id_entrada`),
  CONSTRAINT `id_entrada` FOREIGN KEY (`id_entrada`) REFERENCES `entrada` (`id_entrada`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `validaentrada`
--

LOCK TABLES `validaentrada` WRITE;
/*!40000 ALTER TABLE `validaentrada` DISABLE KEYS */;
INSERT INTO `validaentrada` VALUES (1,1,NULL,'ACTIVO','2016-02-12 01:50:06','789.mx',NULL,0),(2,2,NULL,'ACTIVO','2016-02-12 02:48:47','789.mx',NULL,0),(3,3,NULL,'ACTIVO','2016-02-24 17:25:23','vendedor1',NULL,0),(4,4,NULL,'ACTIVO','2016-02-24 17:48:50','789.mx',NULL,0),(5,5,NULL,'ACTIVO','2016-04-14 17:48:39','789.mx',NULL,0),(6,6,NULL,'ACTIVO','2016-04-14 18:01:12','789.mx',NULL,0),(7,7,NULL,'ACTIVO','2016-05-12 16:11:55','789.mx',NULL,0);
/*!40000 ALTER TABLE `validaentrada` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `validasalida`
--

DROP TABLE IF EXISTS `validasalida`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `validasalida` (
  `id_validasalida` int(11) NOT NULL AUTO_INCREMENT,
  `id_salida` int(11) NOT NULL,
  `cantidad` double DEFAULT NULL,
  `status` varchar(45) DEFAULT 'ACTIVO',
  `fecha_registro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `id_usuario` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_validasalida`),
  KEY `id_salidaprod_idx` (`id_salida`),
  CONSTRAINT `id_salidasx` FOREIGN KEY (`id_salida`) REFERENCES `salida` (`id_salida`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `validasalida`
--

LOCK TABLES `validasalida` WRITE;
/*!40000 ALTER TABLE `validasalida` DISABLE KEYS */;
/*!40000 ALTER TABLE `validasalida` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `validatraspaso`
--

DROP TABLE IF EXISTS `validatraspaso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `validatraspaso` (
  `id_validatraspaso` int(11) NOT NULL AUTO_INCREMENT,
  `id_traspaso` int(11) DEFAULT NULL,
  `cantidad` double DEFAULT NULL,
  `status` varchar(45) DEFAULT 'ACTIVO',
  `fecha_registro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `id_usuario` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_validatraspaso`),
  KEY `id_traspasoprod_idx` (`id_traspaso`),
  CONSTRAINT `id_traspaso` FOREIGN KEY (`id_traspaso`) REFERENCES `traspaso` (`id_traspaso`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `validatraspaso`
--

LOCK TABLES `validatraspaso` WRITE;
/*!40000 ALTER TABLE `validatraspaso` DISABLE KEYS */;
INSERT INTO `validatraspaso` VALUES (1,1,NULL,'ACTIVO','2016-02-12 02:02:41','789.mx'),(2,2,NULL,'ACTIVO','2016-02-12 02:23:40','789.mx'),(3,3,NULL,'ACTIVO','2016-02-12 02:51:57','789.mx'),(4,4,NULL,'ACTIVO','2016-02-24 18:22:45','789.mx'),(5,7,NULL,'ACTIVO','2016-03-08 17:18:16','789.mx'),(6,8,NULL,'ACTIVO','2016-03-08 17:21:03','789.mx'),(7,9,NULL,'ACTIVO','2016-04-14 17:51:37','789.mx'),(8,10,NULL,'ACTIVO','2016-05-11 21:18:01','789.mx'),(9,11,NULL,'ACTIVO','2016-05-12 16:22:11','789.mx');
/*!40000 ALTER TABLE `validatraspaso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `venta`
--

DROP TABLE IF EXISTS `venta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `venta` (
  `id_venta` bigint(20) NOT NULL AUTO_INCREMENT,
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `usuariosventa` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `total` double DEFAULT NULL,
  `tipo` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `factura` tinyint(4) DEFAULT NULL,
  `no_calculable` tinyint(4) DEFAULT '0',
  `ticket_items` text COLLATE utf8_unicode_ci,
  `cancelado` tinyint(4) DEFAULT '0',
  `id_usuario` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `id_persona` bigint(20) DEFAULT NULL,
  `id_tienda` int(11) DEFAULT NULL,
  `consignacion` tinyint(4) DEFAULT '0',
  `icredito` tinyint(4) DEFAULT '0',
  `folio` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_venta`),
  KEY `fk_venta_usuario1_idx` (`id_usuario`),
  KEY `id_persona1_idx` (`id_persona`),
  KEY `id_tienda_idx` (`id_tienda`),
  CONSTRAINT `fk_venta_usuario1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `id_persona1` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id_persona`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `venta`
--

LOCK TABLES `venta` WRITE;
/*!40000 ALTER TABLE `venta` DISABLE KEYS */;
INSERT INTO `venta` VALUES (1,'2016-02-11 14:38:08',NULL,1.74,'Efectivo',0,0,'\r\n        <tbody><tr>\r\n            <th>Cantidad</th>\r\n            <th>Codigo Interno</th>\r\n            <th>Producto</th>\r\n            <th>Subtotal</th>\r\n            <th>Total</th>\r\n            \r\n        </tr>\r\n    <tr class=\"producto\" lineid=\"1471\">\r\n    <td>\r\n        1        <input type=\"hidden\" name=\"cantidad[]\" value=\"1\">\r\n        <input type=\"hidden\" name=\"id_producto[]\" value=\"5\">\r\n    </td>\r\n    <td>\r\n        cod12345    </td>\r\n    <td>\r\n        Producto1    </td>\r\n    <td>\r\n        <input type=\"hidden\" name=\"tipoprecio[]\" value=\"tienda\"><div title=\"Existentes con este precio: 9\">$1.74</div>    </td>\r\n    <td>\r\n        <input type=\"hidden\" class=\"\" name=\"costototal[]\" value=\"1\">\r\n        <input type=\"hidden\" class=\"totales\" name=\"total[]\" value=\"1.74\">\r\n        <input type=\"hidden\" class=\"id_entrada_producto\" name=\"id_entrada_producto[]\" value=\"3178\">\r\n        <input type=\"hidden\" class=\"id_tienda\" name=\"id_tienda\" value=\"13\">\r\n        $1.74    </td>\r\n\r\n    \r\n</tr>\r\n\r\n    </tbody>',0,'789.mx',2,13,0,0,1),(2,'2016-02-11 14:54:25',NULL,8.7,'Tarjeta',NULL,0,'\r\n        <tbody><tr>\r\n            <th>Cantidad</th>\r\n            <th>Codigo Interno</th>\r\n            <th>Producto</th>\r\n            <th>Subtotal</th>\r\n            <th>Total</th>\r\n            \r\n        </tr>\r\n    <tr class=\"producto\" lineid=\"15827\">\r\n    <td>\r\n        1        <input type=\"hidden\" name=\"cantidad[]\" value=\"1\">\r\n        <input type=\"hidden\" name=\"id_producto[]\" value=\"6\">\r\n    </td>\r\n    <td>\r\n        cod1212    </td>\r\n    <td>\r\n        Paquete1    </td>\r\n    <td>\r\n        <input type=\"hidden\" name=\"tipoprecio[]\" value=\"tienda\"><div title=\"Existentes con este precio: 4\">$8.70</div>    </td>\r\n    <td>\r\n        <input type=\"hidden\" class=\"\" name=\"costototal[]\" value=\"5\">\r\n        <input type=\"hidden\" class=\"totales\" name=\"total[]\" value=\"8.7\">\r\n        <input type=\"hidden\" class=\"id_entrada_producto\" name=\"id_entrada_producto[]\" value=\"3180\">\r\n        <input type=\"hidden\" class=\"id_tienda\" name=\"id_tienda\" value=\"13\">\r\n        $8.70    </td>\r\n\r\n    \r\n</tr>\r\n\r\n    </tbody>\r\n    \r\n    ',0,'789.mx',2,13,0,0,2),(7,'2016-02-23 18:09:07','Array',100,'Efectivo',NULL,0,'\r\n        <tbody><tr>\r\n            <th>Cantidad</th>\r\n            <th>Codigo Interno</th>\r\n            <th>Producto</th>\r\n            <th>Subtotal</th>\r\n            <th>Total</th>\r\n            \r\n        </tr>\r\n    <tr class=\"producto\" lineid=\"20663\">\r\n    <td>\r\n        1        <input type=\"hidden\" name=\"cantidad[]\" value=\"1\">\r\n        <input type=\"hidden\" name=\"id_producto[]\" value=\"5\">\r\n    </td>\r\n    <td>\r\n        cod12345    </td>\r\n    <td>\r\n        Producto1    </td>\r\n    <td>\r\n        <input type=\"hidden\" name=\"tipoprecio[]\" value=\"tienda\"><div title=\"Existentes con este precio: 9\">$100.00</div>    </td>\r\n    <td>\r\n        <input type=\"hidden\" class=\"\" name=\"costototal[]\" value=\"1\">\r\n        <input type=\"hidden\" class=\"totales\" name=\"total[]\" value=\"100\">\r\n        <input type=\"hidden\" class=\"id_entrada_producto\" name=\"id_entrada_producto[]\" value=\"3178\">\r\n        <input type=\"hidden\" class=\"id_tienda\" name=\"id_tienda\" value=\"12\">\r\n        $100.00    </td>\r\n\r\n    \r\n</tr>\r\n\r\n    </tbody>',0,'789.mx',2,12,0,0,1),(8,'2016-02-23 18:10:22','Array',100,'Efectivo',NULL,0,'\r\n        <tbody><tr>\r\n            <th>Cantidad</th>\r\n            <th>Codigo Interno</th>\r\n            <th>Producto</th>\r\n            <th>Subtotal</th>\r\n            <th>Total</th>\r\n            \r\n        </tr>\r\n    <tr class=\"producto\" lineid=\"24064\">\r\n    <td>\r\n        1        <input type=\"hidden\" name=\"cantidad[]\" value=\"1\">\r\n        <input type=\"hidden\" name=\"id_producto[]\" value=\"6\">\r\n    </td>\r\n    <td>\r\n        cod1212    </td>\r\n    <td>\r\n        Paquete1    </td>\r\n    <td>\r\n        <input type=\"hidden\" name=\"tipoprecio[]\" value=\"tienda\"><div title=\"Existentes con este precio: 4\">$100.00</div>    </td>\r\n    <td>\r\n        <input type=\"hidden\" class=\"\" name=\"costototal[]\" value=\"5\">\r\n        <input type=\"hidden\" class=\"totales\" name=\"total[]\" value=\"100\">\r\n        <input type=\"hidden\" class=\"id_entrada_producto\" name=\"id_entrada_producto[]\" value=\"3180\">\r\n        <input type=\"hidden\" class=\"id_tienda\" name=\"id_tienda\" value=\"12\">\r\n        $100.00    </td>\r\n\r\n    \r\n</tr>\r\n\r\n    </tbody>',0,'789.mx',2,12,0,0,2),(9,'2016-02-24 17:14:12','Array',0,'Efectivo',NULL,0,'\r\n        <tbody><tr>\r\n            <th>Cantidad</th>\r\n            <th>Codigo Interno</th>\r\n            <th>Producto</th>\r\n            <th>Subtotal</th>\r\n            <th>Total</th>\r\n            \r\n        </tr>\r\n    <tr class=\"producto\" lineid=\"41453\">\r\n    <td>\r\n        1        <input type=\"hidden\" name=\"cantidad[]\" value=\"1\">\r\n        <input type=\"hidden\" name=\"id_producto[]\" value=\"5\">\r\n    </td>\r\n    <td>\r\n        cod12345    </td>\r\n    <td>\r\n        Producto1    </td>\r\n    <td>\r\n        <input type=\"hidden\" name=\"tipoprecio[]\" value=\"tienda\"><div title=\"Existentes con este precio: 9\">$80.00</div>    </td>\r\n    <td>\r\n        <input type=\"hidden\" class=\"\" name=\"costototal[]\" value=\"1\">\r\n        <input type=\"hidden\" class=\"totales\" name=\"total[]\" value=\"80\">\r\n        <input type=\"hidden\" class=\"id_entrada_producto\" name=\"id_entrada_producto[]\" value=\"3178\">\r\n        <input type=\"hidden\" class=\"id_tienda\" name=\"id_tienda\" value=\"12\">\r\n        $80.00    </td>\r\n\r\n    \r\n</tr>\r\n\r\n    \r\n<tr lineid=\"descuento-gerencial\">\r\n    <td>\r\n\r\n    </td>\r\n        <td><input type=\"hidden\" name=\"descripciondesc[]\" id=\"descripciondesc\" value=\"Tester 100%: 789.mx\">\r\n            <input type=\"hidden\" name=\"usuariodesc[]\" value=\"789.mx\">\r\n            <input type=\"hidden\" name=\"porcentajedesc[]\" value=\"100\">\r\n            Tester 100%: 789.mx        </td>\r\n    <td>\r\n\r\n    </td>\r\n    <td>\r\n        <input type=\"hidden\" name=\"id_producto[]\" value=\"0\">\r\n        <input type=\"hidden\" name=\"cantidad[]\" value=\"0\">\r\n        <input type=\"hidden\" class=\"totales\" name=\"total[]\" value=\"-80\">\r\n        <input type=\"hidden\" name=\"totaldesc[]\" value=\"80.00\">\r\n        <input type=\"hidden\" name=\"desc[]\" value=\"80\">\r\n        $-80.00    </td>\r\n</tr>\r\n</tbody>',0,'789.mx',2,12,0,0,3),(10,'2016-02-24 17:28:16','Array',100,'Tarjeta',NULL,0,'\r\n        <tbody><tr>\r\n            <th>Cantidad</th>\r\n            <th>Codigo Interno</th>\r\n            <th>Producto</th>\r\n            <th>Subtotal</th>\r\n            <th>Total</th>\r\n            \r\n        </tr>\r\n    <tr class=\"producto\" lineid=\"23733\">\r\n    <td>\r\n        1        <input type=\"hidden\" name=\"cantidad[]\" value=\"1\">\r\n        <input type=\"hidden\" name=\"id_producto[]\" value=\"5\">\r\n    </td>\r\n    <td>\r\n        cod12345    </td>\r\n    <td>\r\n        Producto1    </td>\r\n    <td>\r\n        <input type=\"hidden\" name=\"tipoprecio[]\" value=\"tienda\"><div title=\"Existentes con este precio: 9\">$100.00</div>    </td>\r\n    <td>\r\n        <input type=\"hidden\" class=\"\" name=\"costototal[]\" value=\"1\">\r\n        <input type=\"hidden\" class=\"totales\" name=\"total[]\" value=\"100\">\r\n        <input type=\"hidden\" class=\"id_entrada_producto\" name=\"id_entrada_producto[]\" value=\"3181\">\r\n        <input type=\"hidden\" class=\"id_tienda\" name=\"id_tienda\" value=\"13\">\r\n        $100.00    </td>\r\n\r\n    \r\n</tr>\r\n\r\n    </tbody>',0,'vendedor1',2,13,0,0,3),(11,'2016-02-24 17:51:55','Array',1500,'Efectivo',NULL,0,'\r\n        <tbody><tr>\r\n            <th>Cantidad</th>\r\n            <th>Codigo Interno</th>\r\n            <th>Producto</th>\r\n            <th>Subtotal</th>\r\n            <th>Total</th>\r\n            \r\n        </tr>\r\n    <tr class=\"producto\" lineid=\"45001\">\r\n    <td>\r\n        1        <input type=\"hidden\" name=\"cantidad[]\" value=\"1\">\r\n        <input type=\"hidden\" name=\"id_producto[]\" value=\"8\">\r\n    </td>\r\n    <td>\r\n        ml165    </td>\r\n    <td>\r\n        Milk Lotion    </td>\r\n    <td>\r\n        <input type=\"hidden\" name=\"tipoprecio[]\" value=\"tienda\"><div title=\"Existentes con este precio: 151\">$1,500.00</div>    </td>\r\n    <td>\r\n        <input type=\"hidden\" class=\"\" name=\"costototal[]\" value=\"800\">\r\n        <input type=\"hidden\" class=\"totales\" name=\"total[]\" value=\"1500\">\r\n        <input type=\"hidden\" class=\"id_entrada_producto\" name=\"id_entrada_producto[]\" value=\"3182\">\r\n        <input type=\"hidden\" class=\"id_tienda\" name=\"id_tienda\" value=\"12\">\r\n        $1,500.00    </td>\r\n\r\n    \r\n</tr>\r\n\r\n    </tbody>\r\n    ',0,'789.mx',2,12,0,0,4),(12,'2016-03-01 10:03:42',NULL,NULL,NULL,NULL,0,NULL,0,'789.mx',NULL,NULL,0,0,1),(13,'2016-03-06 17:18:54','Array',10,'Efectivo',NULL,0,'\r\n        <tbody><tr>\r\n            <th>Cantidad</th>\r\n            <th>Codigo Interno</th>\r\n            <th>Producto</th>\r\n            <th>Subtotal</th>\r\n            <th>Total</th>\r\n            \r\n        </tr>\r\n    <tr class=\"producto\" lineid=\"69686\">\r\n    <td>\r\n        1        <input type=\"hidden\" name=\"cantidad[]\" value=\"1\">\r\n        <input type=\"hidden\" name=\"id_producto[]\" value=\"7\">\r\n    </td>\r\n    <td>\r\n        cod54321    </td>\r\n    <td>\r\n        Producto2    </td>\r\n    <td>\r\n        <input type=\"hidden\" name=\"tipoprecio[]\" value=\"tienda\"><div title=\"Existentes con este precio: 19\">$10.00</div>    </td>\r\n    <td>\r\n        <input type=\"hidden\" class=\"\" name=\"costototal[]\" value=\"2\">\r\n        <input type=\"hidden\" class=\"totales\" name=\"total[]\" value=\"10\">\r\n        <input type=\"hidden\" class=\"id_entrada_producto\" name=\"id_entrada_producto[]\" value=\"3179\">\r\n        <input type=\"hidden\" class=\"id_tienda\" name=\"id_tienda\" value=\"12\">\r\n        $10.00    </td>\r\n\r\n    \r\n</tr>\r\n\r\n    </tbody>\r\n    \r\n    ',0,'789.mx',10106,12,0,0,5),(14,'2016-03-31 17:01:03','Array',10,'Efectivo',NULL,0,'\r\n        <tbody><tr>\r\n            <th>Cantidad</th>\r\n            <th>Codigo Interno</th>\r\n            <th>Producto</th>\r\n            <th>Subtotal</th>\r\n            <th>Total</th>\r\n            \r\n        </tr>\r\n    <tr class=\"producto\" lineid=\"21067\">\r\n    <td>\r\n        1        <input type=\"hidden\" name=\"cantidad[]\" value=\"1\">\r\n        <input type=\"hidden\" name=\"id_producto[]\" value=\"7\">\r\n    </td>\r\n    <td>\r\n        cod54321    </td>\r\n    <td>\r\n        Producto2    </td>\r\n    <td>\r\n        <input type=\"hidden\" name=\"tipoprecio[]\" value=\"tienda\"><div title=\"Existentes con este precio: 19\">$10.00</div>    </td>\r\n    <td>\r\n        <input type=\"hidden\" class=\"\" name=\"costototal[]\" value=\"2\">\r\n        <input type=\"hidden\" class=\"totales\" name=\"total[]\" value=\"10\">\r\n        <input type=\"hidden\" class=\"id_entrada_producto\" name=\"id_entrada_producto[]\" value=\"3179\">\r\n        <input type=\"hidden\" class=\"id_tienda\" name=\"id_tienda\" value=\"13\">\r\n        $10.00    </td>\r\n\r\n    \r\n</tr>\r\n\r\n    </tbody>',0,'jorge',2,13,0,0,4),(15,'2016-04-14 06:02:55','Array',135,'Efectivo',NULL,0,'\r\n        <tbody><tr>\r\n            <th>Cantidad</th>\r\n            <th>Codigo Interno</th>\r\n            <th>Producto</th>\r\n            <th>Subtotal</th>\r\n            <th>Total</th>\r\n            \r\n        </tr>\r\n    <tr class=\"producto\" lineid=\"40050\">\r\n    <td>\r\n        1        <input type=\"hidden\" name=\"cantidad[]\" value=\"1\">\r\n        <input type=\"hidden\" name=\"id_producto[]\" value=\"6\">\r\n    </td>\r\n    <td>\r\n        cod1212    </td>\r\n    <td>\r\n        Paquete1    </td>\r\n    <td>\r\n        <input type=\"hidden\" name=\"tipoprecio[]\" value=\"tienda\"><div title=\"Existentes con este precio: 4\">$150.00</div>    </td>\r\n    <td>\r\n        <input type=\"hidden\" class=\"\" name=\"costototal[]\" value=\"5\">\r\n        <input type=\"hidden\" class=\"totales\" name=\"total[]\" value=\"150\">\r\n        <input type=\"hidden\" class=\"id_entrada_producto\" name=\"id_entrada_producto[]\" value=\"3180\">\r\n        <input type=\"hidden\" class=\"id_tienda\" name=\"id_tienda\" value=\"12\">\r\n        $150.00    </td>\r\n\r\n    \r\n</tr>\r\n\r\n    <tr lineid=\"descuento-gerencial\">\r\n    <td>\r\n\r\n    </td>\r\n        <td><input type=\"hidden\" name=\"descripciondesc[]\" id=\"descripciondesc\" value=\"Tester 10%: 789.mx\">\r\n            <input type=\"hidden\" name=\"usuariodesc[]\" value=\"789.mx\">\r\n            <input type=\"hidden\" name=\"porcentajedesc[]\" value=\"10\">\r\n            Tester 10%: 789.mx        </td>\r\n    <td>\r\n\r\n    </td>\r\n    <td>\r\n        <input type=\"hidden\" name=\"id_producto[]\" value=\"0\">\r\n        <input type=\"hidden\" name=\"cantidad[]\" value=\"0\">\r\n        <input type=\"hidden\" class=\"totales\" name=\"total[]\" value=\"-15\">\r\n        <input type=\"hidden\" name=\"totaldesc[]\" value=\"150.00\">\r\n        <input type=\"hidden\" name=\"desc[]\" value=\"15\">\r\n        $-15.00    </td>\r\n</tr>\r\n</tbody>\r\n    ',0,'789.mx',2,12,0,0,6);
/*!40000 ALTER TABLE `venta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `venta_cancelada`
--

DROP TABLE IF EXISTS `venta_cancelada`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `venta_cancelada` (
  `id_ventacancelada` int(11) NOT NULL AUTO_INCREMENT,
  `total` double DEFAULT '0',
  `id_usuario` varchar(45) DEFAULT NULL,
  `id_venta` bigint(20) DEFAULT NULL,
  `fecha_registro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `id_tienda_destino` int(11) DEFAULT NULL,
  `observaciones` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_ventacancelada`),
  KEY `id_prod_idx` (`id_venta`),
  CONSTRAINT `id_prod` FOREIGN KEY (`id_venta`) REFERENCES `venta` (`id_venta`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `venta_cancelada`
--

LOCK TABLES `venta_cancelada` WRITE;
/*!40000 ALTER TABLE `venta_cancelada` DISABLE KEYS */;
/*!40000 ALTER TABLE `venta_cancelada` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `venta_productocancelado`
--

DROP TABLE IF EXISTS `venta_productocancelado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `venta_productocancelado` (
  `id_venta_productocancelado` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` varchar(45) DEFAULT NULL,
  `fecha_registro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `id_productos_venta` bigint(20) DEFAULT NULL,
  `total` double DEFAULT NULL,
  `observaciones` varchar(100) DEFAULT NULL,
  `id_tienda_destino` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_venta_productocancelado`),
  KEY `id_pro_idx` (`id_productos_venta`),
  CONSTRAINT `id_pro` FOREIGN KEY (`id_productos_venta`) REFERENCES `productos_venta` (`id_productos_venta`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `venta_productocancelado`
--

LOCK TABLES `venta_productocancelado` WRITE;
/*!40000 ALTER TABLE `venta_productocancelado` DISABLE KEYS */;
/*!40000 ALTER TABLE `venta_productocancelado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `ventascorte`
--

DROP TABLE IF EXISTS `ventascorte`;
/*!50001 DROP VIEW IF EXISTS `ventascorte`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `ventascorte` (
  `id` tinyint NOT NULL,
  `id_venta` tinyint NOT NULL,
  `tipo` tinyint NOT NULL,
  `total` tinyint NOT NULL,
  `id_tienda` tinyint NOT NULL,
  `nombre` tinyint NOT NULL,
  `abono` tinyint NOT NULL,
  `id_usuario` tinyint NOT NULL,
  `fecha` tinyint NOT NULL,
  `fechahora` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Dumping events for database 'jpetdeshdn'
--

--
-- Dumping routines for database 'jpetdeshdn'
--

--
-- Final view structure for view `base_inventario`
--

/*!50001 DROP TABLE IF EXISTS `base_inventario`*/;
/*!50001 DROP VIEW IF EXISTS `base_inventario`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`jpetdeshdn`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `base_inventario` AS select max(`ep`.`id_entrada_producto`) AS `id_entrada_producto`,`p`.`id_producto` AS `id_producto`,`p`.`tienda_id_tienda` AS `id_tienda` from (`producto_tienda` `p` join `entrada_producto` `ep` on((`p`.`id_producto` = `ep`.`id_producto`))) where ((`p`.`status` = 'ACTIVO') and (`p`.`existencias` > 0)) group by `p`.`id_producto`,`p`.`tienda_id_tienda` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `costos`
--

/*!50001 DROP TABLE IF EXISTS `costos`*/;
/*!50001 DROP VIEW IF EXISTS `costos`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`jpetdeshdn`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `costos` AS select sum(`a`.`costototal`) AS `costo`,`a`.`id_tienda` AS `id_tienda`,sum(`a`.`existencias`) AS `existencias` from `inventariocosto2` `a` group by `a`.`id_tienda` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `detalle_ventascorte`
--

/*!50001 DROP TABLE IF EXISTS `detalle_ventascorte`*/;
/*!50001 DROP VIEW IF EXISTS `detalle_ventascorte`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`jpetdeshdn`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `detalle_ventascorte` AS select (`vc`.`id` = 0) AS `id`,`vc`.`id_venta` AS `id_venta`,`pv`.`cantidad` AS `cantidad`,`p`.`codinter` AS `codinter`,`p`.`nombre` AS `nombre`,`p`.`exento_iva` AS `exento_iva`,`p`.`exento_ieps` AS `exento_ieps`,`vc`.`fecha` AS `fecha`,`pv`.`total` AS `total`,`vc`.`tipo` AS `tipo`,`vc`.`id_usuario` AS `id_usuario`,`vc`.`id_tienda` AS `id_tienda` from ((((`ventascorte` `vc` left join `venta` `v` on((`vc`.`id_venta` = `v`.`id_venta`))) left join `productos_venta` `pv` on((`vc`.`id_venta` = `pv`.`id_venta`))) left join `producto_tienda` `pt` on((`pt`.`id_productotienda` = `pv`.`id_productotienda`))) left join `producto` `p` on((`pt`.`id_producto` = `p`.`id_producto`))) where ((`pv`.`cancelado` = 0) and (`vc`.`abono` <> 1)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `inventariocosto`
--

/*!50001 DROP TABLE IF EXISTS `inventariocosto`*/;
/*!50001 DROP VIEW IF EXISTS `inventariocosto`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`jpetdeshdn`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `inventariocosto` AS select `ent`.`id_entrada_producto` AS `id_entrada_producto`,`ent`.`id_producto` AS `id_producto`,`ent`.`id_tienda` AS `id_tienda`,`ep`.`costo` AS `costo` from (`base_inventario` `ent` join `entrada_producto` `ep` on((`ent`.`id_entrada_producto` = `ep`.`id_entrada_producto`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `inventariocosto2`
--

/*!50001 DROP TABLE IF EXISTS `inventariocosto2`*/;
/*!50001 DROP VIEW IF EXISTS `inventariocosto2`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`jpetdeshdn`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `inventariocosto2` AS select `costo`.`id_tienda` AS `id_tienda`,`costo`.`costo` AS `costo`,`pt`.`existencias` AS `existencias`,(`costo`.`costo` * `pt`.`existencias`) AS `costototal` from (`inventariocosto` `costo` join `producto_tienda` `pt` on(((`costo`.`id_producto` = `pt`.`id_producto`) and (`costo`.`id_tienda` = `pt`.`tienda_id_tienda`)))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `inventariocostomensual`
--

/*!50001 DROP TABLE IF EXISTS `inventariocostomensual`*/;
/*!50001 DROP VIEW IF EXISTS `inventariocostomensual`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`jpetdeshdn`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `inventariocostomensual` AS select 0 AS `id`,`costos`.`id_tienda` AS `id_tienda`,`costos`.`existencias` AS `existencias`,`precios`.`precio` AS `precio`,`precios`.`precio_mayoreo` AS `precio_mayoreo`,`costos`.`costo` AS `costo` from (`precios` left join `costos` on((`precios`.`id_tienda` = `costos`.`id_tienda`))) order by `precios`.`id_tienda` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `inventarioprecio`
--

/*!50001 DROP TABLE IF EXISTS `inventarioprecio`*/;
/*!50001 DROP VIEW IF EXISTS `inventarioprecio`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`jpetdeshdn`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `inventarioprecio` AS select `ent`.`id_entrada_producto` AS `id_entrada_producto`,`ent`.`id_producto` AS `id_producto`,`ent`.`id_tienda` AS `id_tienda`,`ep`.`precio` AS `precio`,`ep`.`precio_descuento` AS `precio_descuento` from (`base_inventario` `ent` join `entrada_producto` `ep` on((`ent`.`id_entrada_producto` = `ep`.`id_entrada_producto`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `inventarioprecio2`
--

/*!50001 DROP TABLE IF EXISTS `inventarioprecio2`*/;
/*!50001 DROP VIEW IF EXISTS `inventarioprecio2`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`jpetdeshdn`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `inventarioprecio2` AS select `precio`.`id_tienda` AS `id_tienda`,`precio`.`precio` AS `precio`,`pt`.`existencias` AS `existencias`,(`precio`.`precio` * `pt`.`existencias`) AS `preciototal`,(`precio`.`precio_descuento` * `pt`.`existencias`) AS `preciomayoreototal` from (`inventarioprecio` `precio` join `producto_tienda` `pt` on(((`precio`.`id_producto` = `pt`.`id_producto`) and (`precio`.`id_tienda` = `pt`.`tienda_id_tienda`)))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `precios`
--

/*!50001 DROP TABLE IF EXISTS `precios`*/;
/*!50001 DROP VIEW IF EXISTS `precios`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`jpetdeshdn`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `precios` AS select sum(`a`.`preciototal`) AS `precio`,sum(`a`.`preciomayoreototal`) AS `precio_mayoreo`,`a`.`id_tienda` AS `id_tienda`,sum(`a`.`existencias`) AS `existencias` from `inventarioprecio2` `a` group by `a`.`id_tienda` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `ventascorte`
--

/*!50001 DROP TABLE IF EXISTS `ventascorte`*/;
/*!50001 DROP VIEW IF EXISTS `ventascorte`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`jpetdeshdn`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `ventascorte` AS select 0 AS `id`,`v`.`id_venta` AS `id_venta`,`v`.`tipo` AS `tipo`,sum(`v`.`total`) AS `total`,`v`.`id_tienda` AS `id_tienda`,`t`.`nombre` AS `nombre`,0 AS `abono`,`v`.`id_usuario` AS `id_usuario`,date_format(str_to_date(`v`.`fecha`,'%Y-%m-%d'),'%Y-%m-%d') AS `fecha`,`v`.`fecha` AS `fechahora` from (`venta` `v` join `tienda` `t` on((`v`.`id_tienda` = `t`.`id_tienda`))) where (`v`.`cancelado` = 0) group by `v`.`tipo`,`v`.`id_venta`,`v`.`id_tienda`,`t`.`nombre`,`v`.`id_usuario`,date_format(str_to_date(`v`.`fecha`,'%Y-%m-%d'),'%Y-%m-%d'),`v`.`fecha` union select 0 AS `id`,`v`.`id_venta` AS `id_venta`,`v`.`tipo` AS `tipo`,sum(`d`.`montoabono`) AS `total`,`v`.`id_tienda` AS `id_tienda`,`t`.`nombre` AS `nombre`,1 AS `abono`,`v`.`id_usuario` AS `id_usuario`,date_format(str_to_date(`d`.`fecha_registro`,'%Y-%m-%d'),'%Y-%m-%d') AS `fecha`,`v`.`fecha` AS `fechahora` from ((`deudores` `d` join `venta` `v` on((`v`.`id_venta` = `d`.`id_venta`))) join `tienda` `t` on((`v`.`id_tienda` = `t`.`id_tienda`))) where ((`d`.`status` = 'ACTIVA') and (`v`.`cancelado` = 0)) group by `v`.`tipo`,`v`.`id_venta`,`v`.`id_tienda`,`t`.`nombre`,`v`.`id_usuario`,date_format(str_to_date(`d`.`fecha_registro`,'%Y-%m-%d'),'%Y-%m-%d'),`v`.`fecha` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-07-10 13:36:15

CREATE DATABASE IF NOT EXISTS `Miguel`;

USE `Miguel`;

SET foreign_key_checks = 0;

DROP TABLE IF EXISTS `afipauditoria`;

CREATE TABLE `afipauditoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nro_afip` varchar(255) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `sigla` varchar(255) DEFAULT NULL,
  `usuario` varchar(255) DEFAULT NULL,
  `accion` varchar(255) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



DROP TABLE IF EXISTS `cliente`;

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `num_cliente` varchar(255) DEFAULT NULL,
  `apellido` varchar(255) DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `nro_documento` varchar(255) DEFAULT NULL,
  `tipodocumento_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nro_documento` (`nro_documento`) USING BTREE,
  UNIQUE KEY `num_cliente` (`num_cliente`) USING BTREE,
  KEY `tipodocumento_id` (`tipodocumento_id`) USING BTREE,
  CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`tipodocumento_id`) REFERENCES `tipodocumento` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



DROP TABLE IF EXISTS `clienteauditoria`;

CREATE TABLE `clienteauditoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `num_cliente` varchar(255) DEFAULT NULL,
  `apellido` varchar(255) DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `nro_documento` varchar(255) DEFAULT NULL,
  `tipodocumento_id` int(11) DEFAULT NULL,
  `usuario` varchar(255) DEFAULT NULL,
  `accion` varchar(255) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



DROP TABLE IF EXISTS `params`;

CREATE TABLE `params` (
  `name` varchar(200) COLLATE utf8_bin NOT NULL,
  `parameter` varchar(2000) COLLATE utf8_bin NOT NULL DEFAULT '0',
  PRIMARY KEY (`name`),
  UNIQUE KEY `name_UNIQUE` (`name`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;



DROP TABLE IF EXISTS `perfilusuario`;

CREATE TABLE `perfilusuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `perfil` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `perfilusuario` (`perfil`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO `perfilusuario` VALUES (1,"auditor"),
(2,"supervisor"),
(3,"usuario");


DROP TABLE IF EXISTS `permisos`;

CREATE TABLE `permisos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `module` varchar(255) NOT NULL,
  `idselector` varchar(255) DEFAULT NULL,
  `href` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `divparent` varchar(255) NOT NULL,
  `iconCls` varchar(255) NOT NULL,
  `plain` varchar(255) DEFAULT NULL,
  `onclick` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `style` varchar(255) DEFAULT NULL,
  `ordernum` int(11) DEFAULT NULL,
  `locked` varchar(255) DEFAULT NULL,
  `support` varchar(10) DEFAULT NULL,
  `param` varchar(100) DEFAULT NULL,
  `paramval` varchar(100) DEFAULT NULL,
  `nextseparator` varchar(10) DEFAULT NULL,
  `element` varchar(10) DEFAULT NULL,
  `body` tinyint(1) DEFAULT '0',
  `tooltip` varchar(10) DEFAULT '0',
  `messagetool` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `column` (`module`,`idselector`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



DROP TABLE IF EXISTS `permisos_perfiles`;

CREATE TABLE `permisos_perfiles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `permiso_id` int(11) DEFAULT NULL,
  `perfil_id` int(11) DEFAULT NULL,
  `can` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `permiso_perfil_id` (`permiso_id`,`perfil_id`) USING BTREE,
  KEY `perfil_id` (`perfil_id`) USING BTREE,
  CONSTRAINT `generalbuttons_permiso_ibfk_1` FOREIGN KEY (`perfil_id`) REFERENCES `perfilusuario` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



DROP TABLE IF EXISTS `tipodocumento`;

CREATE TABLE `tipodocumento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nro_afip` varchar(255) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `sigla` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nro_afip` (`nro_afip`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

INSERT INTO `tipodocumento` VALUES (1,1,"CÃ©dula Identidad Buenos Aires","CI Buenos Aires"),
(2,2,"CÃ©dula Identidad Catamarca","CI Catamarca"),
(3,3,"CÃ©dula Identidad CÃ³rdoba","CI CÃ³rdoba"),
(4,4,"CÃ©dula Identidad Corrientes","CI Corrientes"),
(5,5,"CÃ©dula Identidad Entre RÃ­os","CI Entre RÃ­os"),
(6,6,"CÃ©dula Identidad Jujuy","CI Jujuy"),
(7,7,"CÃ©dula Identidad Mendoza","CI Mendoza"),
(8,8,"CÃ©dula Identidad La Rioja","CI La Rioja"),
(9,9,"CÃ©dula Identidad Salta","CI Salta"),
(10,10,"CÃ©dula Identidad San Juan","CI San Juan"),
(11,11,"CÃ©dula Identidad San Luis","CI San Luis"),
(12,12,"CÃ©dula Identidad Santa Fe","CI Santa Fe"),
(13,14,"CÃ©dula Identidad TucumÃ¡n","CI TucumÃ¡n"),
(14,16,"CÃ©dula Identidad Chaco","CI Chaco"),
(15,17,"CÃ©dula Identidad Chubut","CI Chubut"),
(16,18,"CÃ©dula Identidad Formosa","CI Formosa"),
(17,19,"CÃ©dula Identidad Misiones","CI Misiones"),
(18,20,"CÃ©dula Identidad NeuquÃ©n","CI NeuquÃ©n"),
(19,21,"CÃ©dula Identidad La Pampa","CI La Pampa"),
(20,22,"CÃ©dula Identidad RÃ­o Negro","CI RÃ­o Negro"),
(21,23,"CÃ©dula Identidad Santa Cruz","CI Santa Cruz"),
(22,24,"CÃ©dula Identidad Tierra del Fuego","CI Tierra del Fuego"),
(23,80,"Clave Ãºnica de IdentificaciÃºn Tributaria","CUIT"),
(24,86,"Clave Ãºnica de IdentificaciÃºn Laboral","CUIL"),
(25,87,"Clave de IdentificaciÃºn","CDI"),
(26,89,"Libreta de Enrolamiento","LE"),
(27,90,"Libreta CÃ­vica","LC"),
(28,91,"CÃ©dula Identidad extranjera","CI extranjera"),
(29,92,"en trÃ¡mite","en trÃ¡mite"),
(30,93,"Acta nacimiento","Acta nacimiento"),
(31,94,"Pasaporte","Pasaporte"),
(32,95,"CI Bs. As. Registro Nacional de Prestadores","CI Bs. As. RNP"),
(33,96,"Documento Nacional de Identidad","DNI"),
(34,99,"Sin identificar/venta global diaria","Sin identificar/venta global diaria"),
(35,30,"Certificado de MigraciÃ³n","Certificado de MigraciÃ³n"),
(36,88,"Usado por Anses para PadrÃ³n","Usado por Anses para PadrÃ³n");


DROP TABLE IF EXISTS `usuario`;

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `apellido` varchar(255) DEFAULT NULL,
  `nick` varchar(255) DEFAULT NULL,
  `contrasenia` varchar(255) DEFAULT NULL,
  `perfilusuario_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nick` (`nick`) USING BTREE,
  KEY `usuario` (`perfilusuario_id`) USING BTREE,
  CONSTRAINT `usuario` FOREIGN KEY (`perfilusuario_id`) REFERENCES `perfilusuario` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



SET foreign_key_checks = 1;

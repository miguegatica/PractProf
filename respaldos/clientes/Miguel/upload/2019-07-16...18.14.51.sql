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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `afipauditoria` VALUES (1,98,"Nuevo tipo","NT","soporte","INSERTAR","2019-07-16","18:13:15");


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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `migrations` VALUES (1,"migration_1","2019-07-16 23:11:41");


DROP TABLE IF EXISTS `params`;

CREATE TABLE `params` (
  `name` varchar(200) COLLATE utf8_bin NOT NULL,
  `parameter` varchar(2000) COLLATE utf8_bin NOT NULL DEFAULT '0',
  PRIMARY KEY (`name`),
  UNIQUE KEY `name_UNIQUE` (`name`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `params` VALUES ("perfilusuario_superadmin",4);


DROP TABLE IF EXISTS `perfilusuario`;

CREATE TABLE `perfilusuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `perfil` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `perfilusuario` (`perfil`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO `perfilusuario` VALUES (1,"auditor"),
(4,"superadmin"),
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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

INSERT INTO `permisos` VALUES (1,"GENERAL","btnGeneral_usuarios","#","easyui-linkbutton","mm1","icon-man",true,"agregarTabUsuario()","Usuarios","",0,false,false,"","","","a",0,false,""),
(2,"GENERAL","btnGeneral_permisos","#","easyui-linkbutton","mm1","icon-hlock",true,"agregarTabPermisos()","Permisos","",1,false,false,"","","","a",0,false,""),
(3,"GENERAL","btnGeneral_tiposdocumentos","#","easyui-linkbutton","mm1","icon-record2",true,"agregarTabTiposDocs()","Tipos Documentos","",2,false,false,"","","","a",0,false,""),
(4,"GENERAL","btnGeneral_clientes","#","easyui-linkbutton","mm1","icon-man",true,"agregarTabCliente()","Clientes","",3,false,false,"","","","a",0,false,""),
(5,"GENERAL","btnGeneral_auditoriaclientes","#","easyui-linkbutton","mm1","icon-record2",true,"agregarTabAuditoriaClient()","Auditoria Clientes","",4,false,false,"","","","a",0,false,""),
(6,"GENERAL","btnGeneral_auditoriaafip","#","easyui-linkbutton","mm1","icon-record2",true,"agregarTabAuditoriaDoc()","Auditoria Afip","",5,false,false,"","","","a",0,false,""),
(7,"CLIENTES","btnClientes_nuevoCliente","#","easyui-linkbutton","","icon-add",true,"nuevoCliente()","Nuevo Cliente","",0,false,false,"","","","a",0,false,""),
(8,"CLIENTES","btnClientes_editarCliente","#","easyui-linkbutton","","icon-edit",true,"editarCliente()","Editar Cliente","",1,false,false,"","","","a",0,false,""),
(9,"CLIENTES","btnClientes_eliminarCliente","#","easyui-linkbutton","","icon-remove",true,"eliminarCliente()","Eliminar Cliente","",2,false,false,"","","","a",0,false,""),
(10,"CLIENTES","btnClientes_filtrarCliente","#","easyui-linkbutton","","icon-filter",true,"filtrarCliente()","Filtrar Cliente","",3,false,false,"","","","a",0,false,""),
(11,"USUARIOS","btnUsuarios_nuevoUsuario","#","easyui-linkbutton","","icon-add",true,"nuevoUsuario()","Nuevo Usuario","",0,false,false,"","","","a",0,false,""),
(12,"USUARIOS","btnUsuarios_editarUsuario","#","easyui-linkbutton","","icon-edit",true,"editarUsuario()","Editar Usuario","",1,false,false,"","","","a",0,false,""),
(13,"USUARIOS","btnUsuarios_eliminarUsuario","#","easyui-linkbutton","","icon-remove",true,"eliminarUsuario()","Eliminar Usuario","",2,false,false,"","","","a",0,false,""),
(14,"TIPOSDOCUMENTOS","btnTiposdocumentos_nuevoDocumento","#","easyui-linkbutton","","icon-add",true,"nuevoDocumento()","Nuevo Documento","",0,false,false,"","","","a",0,false,""),
(15,"TIPOSDOCUMENTOS","btnTiposdocumentos_editarDocumento","#","easyui-linkbutton","","icon-edit",true,"editarDocumento()","Editar Documento","",1,false,false,"","","","a",0,false,""),
(16,"TIPOSDOCUMENTOS","btnTiposdocumentos_eliminarDocumento","#","easyui-linkbutton","","icon-remove",true,"eliminarDocumento()","Eliminar Documento","",2,false,false,"","","","a",0,false,"");


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
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=latin1;

INSERT INTO `permisos_perfiles` VALUES (1,1,1,0),
(2,1,2,0),
(3,1,3,0),
(4,1,4,1),
(5,2,1,0),
(6,2,2,0),
(7,2,3,0),
(8,2,4,1),
(9,3,1,0),
(10,3,2,0),
(11,3,3,0),
(12,3,4,1),
(13,4,1,0),
(14,4,2,0),
(15,4,3,0),
(16,4,4,1),
(17,5,1,0),
(18,5,2,0),
(19,5,3,0),
(20,5,4,1),
(21,6,1,0),
(22,6,2,0),
(23,6,3,0),
(24,6,4,1),
(25,7,1,0),
(26,7,2,0),
(27,7,3,0),
(28,7,4,1),
(29,8,1,0),
(30,8,2,0),
(31,8,3,0),
(32,8,4,1),
(33,9,1,0),
(34,9,2,0),
(35,9,3,0),
(36,9,4,1),
(37,10,1,0),
(38,10,2,0),
(39,10,3,0),
(40,10,4,1),
(41,11,1,0),
(42,11,2,0),
(43,11,3,0),
(44,11,4,1),
(45,12,1,0),
(46,12,2,0),
(47,12,3,0),
(48,12,4,1),
(49,13,1,0),
(50,13,2,0),
(51,13,3,0),
(52,13,4,1),
(53,14,1,0),
(54,14,2,0),
(55,14,3,0),
(56,14,4,1),
(57,15,1,0),
(58,15,2,0),
(59,15,3,0),
(60,15,4,1),
(61,16,1,0),
(62,16,2,0),
(63,16,3,0),
(64,16,4,1);


DROP TABLE IF EXISTS `tipodocumento`;

CREATE TABLE `tipodocumento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nro_afip` varchar(255) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `sigla` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nro_afip` (`nro_afip`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

INSERT INTO `tipodocumento` VALUES (1,1,"CÃƒÂ©dula Identidad Buenos Aires","CI Buenos Aires"),
(2,2,"CÃƒÂ©dula Identidad Catamarca","CI Catamarca"),
(3,3,"CÃƒÂ©dula Identidad CÃƒÂ³rdoba","CI CÃƒÂ³rdoba"),
(4,4,"CÃƒÂ©dula Identidad Corrientes","CI Corrientes"),
(5,5,"CÃƒÂ©dula Identidad Entre RÃƒÂ­os","CI Entre RÃƒÂ­os"),
(6,6,"CÃƒÂ©dula Identidad Jujuy","CI Jujuy"),
(7,7,"CÃƒÂ©dula Identidad Mendoza","CI Mendoza"),
(8,8,"CÃƒÂ©dula Identidad La Rioja","CI La Rioja"),
(9,9,"CÃƒÂ©dula Identidad Salta","CI Salta"),
(10,10,"CÃƒÂ©dula Identidad San Juan","CI San Juan"),
(11,11,"CÃƒÂ©dula Identidad San Luis","CI San Luis"),
(12,12,"CÃƒÂ©dula Identidad Santa Fe","CI Santa Fe"),
(13,14,"CÃƒÂ©dula Identidad TucumÃƒÂ¡n","CI TucumÃƒÂ¡n"),
(14,16,"CÃƒÂ©dula Identidad Chaco","CI Chaco"),
(15,17,"CÃƒÂ©dula Identidad Chubut","CI Chubut"),
(16,18,"CÃƒÂ©dula Identidad Formosa","CI Formosa"),
(17,19,"CÃƒÂ©dula Identidad Misiones","CI Misiones"),
(18,20,"CÃƒÂ©dula Identidad NeuquÃƒÂ©n","CI NeuquÃƒÂ©n"),
(19,21,"CÃƒÂ©dula Identidad La Pampa","CI La Pampa"),
(20,22,"CÃƒÂ©dula Identidad RÃƒÂ­o Negro","CI RÃƒÂ­o Negro"),
(21,23,"CÃƒÂ©dula Identidad Santa Cruz","CI Santa Cruz"),
(22,24,"CÃƒÂ©dula Identidad Tierra del Fuego","CI Tierra del Fuego"),
(23,80,"Clave ÃƒÂºnica de IdentificaciÃƒÂºn Tributaria","CUIT"),
(24,86,"Clave ÃƒÂºnica de IdentificaciÃƒÂºn Laboral","CUIL"),
(25,87,"Clave de IdentificaciÃƒÂºn","CDI"),
(26,89,"Libreta de Enrolamiento","LE"),
(27,90,"Libreta CÃƒÂ­vica","LC"),
(28,91,"CÃƒÂ©dula Identidad extranjera","CI extranjera"),
(29,92,"en trÃƒÂ¡mite","en trÃƒÂ¡mite"),
(30,93,"Acta nacimiento","Acta nacimiento"),
(31,94,"Pasaporte","Pasaporte"),
(32,95,"CI Bs. As. Registro Nacional de Prestadores","CI Bs. As. RNP"),
(33,96,"Documento Nacional de Identidad","DNI"),
(34,99,"Sin identificar/venta global diaria","Sin identificar/venta global diaria"),
(35,30,"Certificado de MigraciÃƒÂ³n","Certificado de MigraciÃƒÂ³n"),
(36,88,"Usado por Anses para PadrÃƒÂ³n","Usado por Anses para PadrÃƒÂ³n"),
(37,98,"Nuevo tipo","NT");


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

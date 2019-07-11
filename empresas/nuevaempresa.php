<?php

//require_once '../class.consultas.php';


if(isset($_POST['crear'])){

    $contrasenia = $_POST['contrasenia'];
    

     $uso = 'false';
        
     
    //VOY A REVISAR SI LA CLAVE TIENE PERMISOS  
    $conn = new PDO ('mysql:host=localhost;dbname=claves','root','');
    
    $uso = $conn->prepare('SELECT uso FROM claves where contrasenia = :contrasenia');
    $uso->bindParam(':contrasenia', $contrasenia);
    $uso->execute();
    
    $resultUso = $uso->fetch(); 
    
    $esteUso = $resultUso[0];
    
    //VOY A REVISAR SI EXISTE LA CLAVE
    $statement = $conn->prepare('SELECT count(*) FROM claves WHERE contrasenia = :contrasenia');
    $statement->bindParam(':contrasenia', $contrasenia);
    $statement->execute();
    
    $result = $statement->fetch(); 
    
    $count = $result[0];
    
    
    if ($count == 0){
        echo '<script>alert("Contraseña no existe. Solicitar nueva contraseña.");</script>';
    } elseif ($esteUso == 'false'){
        echo '<script>alert("Contraseña no tiene permiso de uso! Solicitar nueva contraseña.");</script>';
    } else{
        
        $companyname = $_POST['name'];

        $bd_name=trim($companyname);
        $bd_name=str_replace(' ','',$bd_name);
        $bd_name=str_replace('/','',$bd_name);
        $bd_name=str_replace('.','',$bd_name);
        $bd_name=str_replace('ñ','n',$bd_name);
        $bd_name=str_replace('Ñ','N',$bd_name);

        

        // INSERTO EN LA TABLA GENERAL
        
        $conn = new PDO ('mysql:host=localhost;dbname=sistemas_3','root','');
        
        $insertarempresa = $conn->prepare('INSERT INTO empresas (nombre, bd, contrasenia) VALUES (:nombre, :bd, :contrasenia) ');
        $insertarempresa->bindParam(':nombre', $companyname);
        $insertarempresa->bindParam(':bd', $bd_name);
        $insertarempresa->bindParam(':contrasenia', $contrasenia);
        $insertarempresa->execute();
        
        //ACTUALIZO EN LA BASE DE DATOS DE CLAVES PARA DARLA A USO = FALSE
        $uso = 'false';
        
        $conn = new PDO ('mysql:host=localhost;dbname=claves','root','');
        $insertPassword = $conn->prepare('UPDATE claves SET uso =:uso WHERE contrasenia=:contrasenia');
        $insertPassword->bindParam(':uso', $uso);
        $insertPassword->bindParam(':contrasenia', $contrasenia);
        $insertPassword->execute(); 

        //**** CREO LA BASE DE DATOS FUERA DEL SISTEMA **********

        $conexion = new PDO('mysql:host=localhost','root','');//Conexion al servidor, sin seleccionar ninguna base de datos

        $CreateDatabase=$conexion->query("CREATE DATABASE `$bd_name`");

        $conexion2 = new PDO('mysql:host=localhost;dbname='.$bd_name,'root','');


    ///////////////////////////////////////////// CREANDO TABLAS ///////////////////////////////////////////////////////////////////////

        //**** creando tabla tipodocumento

        $CreateTables=$conexion2->query("CREATE TABLE tipodocumento (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        nro_afip VARCHAR(255), 
        descripcion VARCHAR(255), 
        sigla VARCHAR(255),
        UNIQUE KEY nro_afip (nro_afip) USING BTREE) ");


        //**** creando tabla cliente

        $CreateTables=$conexion2->query("
        CREATE TABLE cliente (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        num_cliente VARCHAR(255), 
        apellido VARCHAR(255), 
        nombre VARCHAR(255), 
        nro_documento VARCHAR(255),  
        tipodocumento_id INT(11),
        UNIQUE KEY nro_documento (nro_documento) USING BTREE,
        UNIQUE KEY num_cliente (num_cliente) USING BTREE,
        KEY tipodocumento_id (tipodocumento_id) USING BTREE,
        CONSTRAINT cliente_ibfk_1 FOREIGN KEY (tipodocumento_id) REFERENCES tipodocumento (id) ON UPDATE CASCADE) ");



        //**** creando tabla perfilusuario
        $CreateTables=$conexion2->query("CREATE TABLE perfilusuario (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        perfil VARCHAR(255),
        UNIQUE KEY perfilusuario (perfil) USING BTREE)");




         //**** creando tabla usuario
        $CreateTables=$conexion2->query("CREATE TABLE usuario (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(255), 
        apellido VARCHAR(255), 
        nick VARCHAR(255), 
        contrasenia VARCHAR(255), 
        perfilusuario_id INT(11),
        UNIQUE KEY nick (nick) USING BTREE,
        KEY usuario (perfilusuario_id) USING BTREE,
        CONSTRAINT usuario FOREIGN KEY (perfilusuario_id) REFERENCES perfilusuario (id) ON UPDATE CASCADE)");



        //**** creando tabla clienteauditoria
        $CreateTables=$conexion2->query("CREATE TABLE clienteauditoria (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        num_clienteOld VARCHAR(255), 
        apellidoOld VARCHAR(255), 
        nombreOld VARCHAR(255), 
        nro_documentoOld VARCHAR(255), 
        tipodocumento_idOld INT(11), 
        num_clienteNew VARCHAR(255), 
        apellidoNew VARCHAR(255), 
        nombreNew VARCHAR(255), 
        nro_documentoNew VARCHAR(255), 
        tipodocumento_idNew INT(11),
        usuario VARCHAR(255), 
        accion VARCHAR(255), 
        fecha DATE, hora TIME)");



        //**** creando tabla afipauditoria
        $CreateTables=$conexion2->query("CREATE TABLE afipauditoria (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        nro_afipOld VARCHAR(255), 
        descripcionOld VARCHAR(255), 
        siglaOld VARCHAR(255), 
        nro_afipNew VARCHAR(255), 
        descripcionNew VARCHAR(255), 
        siglaNew VARCHAR(255), 
        usuario VARCHAR(255), 
        accion VARCHAR(255), 
        fecha DATE, 
        hora TIME)");


        //**** creando tabla migrations
        $CreateTables=$conexion2->query("CREATE TABLE migrations (
        id int(11) NOT NULL AUTO_INCREMENT,
        name varchar(200) NOT NULL,
        date datetime DEFAULT NULL,
        PRIMARY KEY (id)) 
        ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;");


        //**** creando tabla params
        $CreateTables=$conexion2->query("CREATE TABLE params (
        name varchar(200) COLLATE utf8_bin NOT NULL,
        parameter varchar(2000) COLLATE utf8_bin NOT NULL DEFAULT 0,
        PRIMARY KEY (name),
        UNIQUE KEY name_UNIQUE (name) USING BTREE) 
        ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;");


          //**** creando tabla permisos
        $CreateTables=$conexion2->query("
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
        ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;");

        //**** creando tabla permisos_perfiles 
        $CreateTables=$conexion2->query("CREATE TABLE permisos_perfiles (
        id int(10) unsigned NOT NULL AUTO_INCREMENT,
        permiso_id int(11) DEFAULT NULL,
        perfil_id int(11) DEFAULT NULL,
        can tinyint(4) DEFAULT 0,
        PRIMARY KEY (id),
        UNIQUE KEY permiso_perfil_id (permiso_id,perfil_id) USING BTREE,
        KEY perfil_id (perfil_id) USING BTREE,
        CONSTRAINT generalbuttons_permiso_ibfk_1 FOREIGN KEY (perfil_id) REFERENCES perfilusuario (id) ON DELETE CASCADE
        ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;");



    ////////////////////////////////////////// INSERTAR TABLAS /////////////////////////////////////////////////////////////////////////

        $InsertTables2 = $conexion2->query("INSERT INTO tipodocumento (nro_afip, descripcion, sigla) VALUES ('1', 'Cédula Identidad Buenos Aires', 'CI Buenos Aires')");

        $InsertTables3=$conexion2->query("INSERT INTO tipodocumento (nro_afip, descripcion, sigla) VALUES ('2', 'Cédula Identidad Catamarca', 'CI Catamarca')");

        $InsertTables4=$conexion2->query("INSERT INTO tipodocumento (nro_afip, descripcion, sigla) VALUES ('3', 'Cédula Identidad Córdoba', 'CI Córdoba')");

        $InsertTables5=$conexion2->query("INSERT INTO tipodocumento (nro_afip, descripcion, sigla) VALUES ('4', 'Cédula Identidad Corrientes', 'CI Corrientes')");

        $InsertTables6=$conexion2->query("INSERT INTO tipodocumento (nro_afip, descripcion, sigla) VALUES ('5', 'Cédula Identidad Entre Ríos', 'CI Entre Ríos')");

        $InsertTables7=$conexion2->query("INSERT INTO tipodocumento (nro_afip, descripcion, sigla) VALUES ('6', 'Cédula Identidad Jujuy', 'CI Jujuy')");

        $InsertTables8=$conexion2->query("INSERT INTO tipodocumento (nro_afip, descripcion, sigla) VALUES ('7', 'Cédula Identidad Mendoza', 'CI Mendoza')");

        $InsertTables9=$conexion2->query("INSERT INTO tipodocumento (nro_afip, descripcion, sigla) VALUES ('8', 'Cédula Identidad La Rioja', 'CI La Rioja')");

        $InsertTables10=$conexion2->query("INSERT INTO tipodocumento (nro_afip, descripcion, sigla) VALUES ('9', 'Cédula Identidad Salta', 'CI Salta')");

        $InsertTables11=$conexion2->query("INSERT INTO tipodocumento (nro_afip, descripcion, sigla) VALUES ('10', 'Cédula Identidad San Juan', 'CI San Juan')");

        $InsertTables12=$conexion2->query("INSERT INTO tipodocumento (nro_afip, descripcion, sigla) VALUES ('11', 'Cédula Identidad San Luis', 'CI San Luis')");

        $InsertTables13=$conexion2->query("INSERT INTO tipodocumento (nro_afip, descripcion, sigla) VALUES ('12', 'Cédula Identidad Santa Fe', 'CI Santa Fe')");

        $InsertTables14=$conn->query("INSERT INTO tipodocumento (nro_afip, descripcion, sigla) VALUES ('13', 'Cédula Identidad Santiago del Estero', 'CI Santiago del Estero')");

        $InsertTables15=$conexion2->query("INSERT INTO tipodocumento (nro_afip, descripcion, sigla) VALUES ('14', 'Cédula Identidad Tucumán', 'CI Tucumán')");

        $InsertTables16=$conexion2->query("INSERT INTO tipodocumento (nro_afip, descripcion, sigla) VALUES ('16', 'Cédula Identidad Chaco', 'CI Chaco')");

        $InsertTables17=$conexion2->query("INSERT INTO tipodocumento (nro_afip, descripcion, sigla) VALUES ('17', 'Cédula Identidad Chubut', 'CI Chubut')");

        $InsertTables18=$conexion2->query("INSERT INTO tipodocumento (nro_afip, descripcion, sigla) VALUES ('18', 'Cédula Identidad Formosa', 'CI Formosa')");

        $InsertTables19=$conexion2->query("INSERT INTO tipodocumento (nro_afip, descripcion, sigla) VALUES ('19', 'Cédula Identidad Misiones', 'CI Misiones')");

        $InsertTables20=$conexion2->query("INSERT INTO tipodocumento (nro_afip, descripcion, sigla) VALUES ('20', 'Cédula Identidad Neuquén', 'CI Neuquén')");

        $InsertTables21=$conexion2->query("INSERT INTO tipodocumento (nro_afip, descripcion, sigla) VALUES ('21', 'Cédula Identidad La Pampa', 'CI La Pampa')");

        $InsertTables22=$conexion2->query("INSERT INTO tipodocumento (nro_afip, descripcion, sigla) VALUES ('22', 'Cédula Identidad Río Negro', 'CI Río Negro')");

        $InsertTables23=$conexion2->query("INSERT INTO tipodocumento (nro_afip, descripcion, sigla) VALUES ('23', 'Cédula Identidad Santa Cruz', 'CI Santa Cruz')");

        $InsertTables24=$conexion2->query("INSERT INTO tipodocumento (nro_afip, descripcion, sigla) VALUES ('24', 'Cédula Identidad Tierra del Fuego', 'CI Tierra del Fuego')");

        $InsertTables25=$conexion2->query("INSERT INTO tipodocumento (nro_afip, descripcion, sigla) VALUES ('80', 'Clave única de Identificaciún Tributaria', 'CUIT')");

        $InsertTables26=$conexion2->query("INSERT INTO tipodocumento (nro_afip, descripcion, sigla) VALUES ('86', 'Clave única de Identificaciún Laboral', 'CUIL')");

        $InsertTables27=$conexion2->query("INSERT INTO tipodocumento (nro_afip, descripcion, sigla) VALUES ('87', 'Clave de Identificaciún', 'CDI')");

        $InsertTables28=$conexion2->query("INSERT INTO tipodocumento (nro_afip, descripcion, sigla) VALUES ('89', 'Libreta de Enrolamiento', 'LE')");

        $InsertTables29=$conexion2->query("INSERT INTO tipodocumento (nro_afip, descripcion, sigla) VALUES ('90', 'Libreta Cívica', 'LC')");

        $InsertTables30=$conexion2->query("INSERT INTO tipodocumento (nro_afip, descripcion, sigla) VALUES ('91', 'Cédula Identidad extranjera', 'CI extranjera')");

        $InsertTables31=$conexion2->query("INSERT INTO tipodocumento (nro_afip, descripcion, sigla) VALUES ('92', 'en trámite', 'en trámite')");

        $InsertTables32=$conexion2->query("INSERT INTO tipodocumento (nro_afip, descripcion, sigla) VALUES ('93', 'Acta nacimiento', 'Acta nacimiento')");

        $InsertTables33=$conexion2->query("INSERT INTO tipodocumento (nro_afip, descripcion, sigla) VALUES ('94', 'Pasaporte', 'Pasaporte')");

        $InsertTables34=$conexion2->query("INSERT INTO tipodocumento (nro_afip, descripcion, sigla) VALUES ('95', 'CI Bs. As. Registro Nacional de Prestadores', 'CI Bs. As. RNP')");

        $InsertTables35=$conexion2->query("INSERT INTO tipodocumento (nro_afip, descripcion, sigla) VALUES ('96', 'Documento Nacional de Identidad', 'DNI')");

        $InsertTables36=$conexion2->query("INSERT INTO tipodocumento (nro_afip, descripcion, sigla) VALUES ('99', 'Sin identificar/venta global diaria', 'Sin identificar/venta global diaria')");

        $InsertTables37=$conexion2->query("INSERT INTO tipodocumento (nro_afip, descripcion, sigla) VALUES ('30', 'Certificado de Migración', 'Certificado de Migración')");

        $InsertTables38=$conexion2->query("INSERT INTO tipodocumento (nro_afip, descripcion, sigla) VALUES ('88', 'Usado por Anses para Padrón', 'Usado por Anses para Padrón')");


//////////////////////////////// INSERTANDO LOS TIPOS DE PERFILES  //////////////////////////////////////////////////////////

        $InsertTables39=$conexion2->query("INSERT INTO perfilusuario (perfil) VALUES ('auditor')");
        $InsertTables39=$conexion2->query("INSERT INTO perfilusuario (perfil) VALUES ('supervisor')");
        $InsertTables39=$conexion2->query("INSERT INTO perfilusuario (perfil) VALUES ('usuario')");


        echo '<script>alert("La empresa ha sida creada. Ir a empresas");</script>';
    }
        

}        
        





?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title></title> 
	<meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1.0, maximum-scale=3.0, minimum-scale=1.0">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" >
        <link rel="stylesheet" href="../estilos/estilos.css">
        
</head>  
<body>
    
 <nav class="menu">
           <ul>
               <li class="item-r"><a href="../empresas/empresas.php">Volver a Empresas</a></li> 
           </ul>
      </nav>
 <form class="formulario" action="nuevaempresa.php" method="POST">
    <h1>Registrar empresa</h1> 
     
    <div class="contenedor">

        <div class="input-contenedor">
            <i class="fas fa-building icon"></i>
            <input type="text" placeholder="Nombre empresa" required name="name">
        </div>
        <div class="input-contenedor">
            <i class="fas fa-key icon"></i>
            <input type="text" placeholder="Contraseña" required name="contrasenia">
        </div>


<!--        <div class="input-contenedor">
            <i class="fas fa-location-arrow icon"></i>
            <input type="text" placeholder="Dirección" required>
        </div>
         
        <div class="input-contenedor">
            <i class="fas fa-phone icon"></i>
            <input type="text" placeholder="Teléfono" required>
        </div>-->

         <input type="submit" class="button" value="Crear" name="crear">
         <p>Al crear una nueva empresa, asegurate de ingresar los datos correctamente.</p>
         <p>¿No tienes contraseña?<a class="link" href="solicitarcontraseña.php"> Solicitar contraseña</a></p>
    </div>

 </form>
</body>
</html>




















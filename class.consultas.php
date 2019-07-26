<?php

Class Consultas {
        public function set_BD ($companyname, $bd_name){ 
            $modelo = new Conexion();
            $conn = $modelo->get_conexion();
            $query = 'INSERT INTO empresas (nombre, bd) VALUES (:nombre, :bd)';
            $statement = $conn->prepare($query);
            $statement->bindParam(':nombre', $companyname);
            $statement->bindParam(':bd', $bd_name);
            if(!$statement){
                return "Error al crear base de datos";
            }
            else{
                $statement->execute();
            }    
        }
        
        public function get_BD(){
            $rows = null;
            $modelo = new Conexion();
            $conn = $modelo->get_conexion();
            $query = 'SELECT * FROM empresas';
            $statement = $conn->prepare($query);
            $statement->execute();
            while($result = $statement->fetch()){
                $rows[] = $result;
            }
            
            return $rows; 
        }
        
        
        public function set_tipoDoc(){
         
            $modelo = new Conexion();
            $conn = $modelo->get_conexion();
             
            $query = "INSERT INTO tipodocumento (nro_afip, descripcion, sigla) VALUES ('0', 'Cédula Identidad Policía Federal', 'CI Policía Federal')";
            $statement = $conn->prepare($query);
            $statement->execute();

            $InsertTables2 = $conn->query("INSERT INTO tipodocumento (nro_afip, descripcion, sigla) VALUES ('1', 'Cédula Identidad Buenos Aires', 'CI Buenos Aires')");

            $InsertTables3=$conn->query("INSERT INTO tipodocumento (nro_afip, descripcion, sigla) VALUES ('2', 'Cédula Identidad Catamarca', 'CI Catamarca')");

            $InsertTables4=$conn->query("INSERT INTO tipodocumento (nro_afip, descripcion, sigla) VALUES ('3', 'Cédula Identidad Córdoba', 'CI Córdoba')");

            $InsertTables5=$conn->query("INSERT INTO tipodocumento (nro_afip, descripcion, sigla) VALUES ('4', 'Cédula Identidad Corrientes', 'CI Corrientes')");

            $InsertTables6=$conn->query("INSERT INTO tipodocumento (nro_afip, descripcion, sigla) VALUES ('5', 'Cédula Identidad Entre Ríos', 'CI Entre Ríos')");

            $InsertTables7=$conn->query("INSERT INTO tipodocumento (nro_afip, descripcion, sigla) VALUES ('6', 'Cédula Identidad Jujuy', 'CI Jujuy')");

            $InsertTables8=$conn->query("INSERT INTO tipodocumento (nro_afip, descripcion, sigla) VALUES ('7', 'Cédula Identidad Mendoza', 'CI Mendoza')");

            $InsertTables9=$conn->query("INSERT INTO tipodocumento (nro_afip, descripcion, sigla) VALUES ('8', 'Cédula Identidad La Rioja', 'CI La Rioja')");

            $InsertTables10=$conn->query("INSERT INTO tipodocumento (nro_afip, descripcion, sigla) VALUES ('9', 'Cédula Identidad Salta', 'CI Salta')");

            $InsertTables11=$conn->query("INSERT INTO tipodocumento (nro_afip, descripcion, sigla) VALUES ('10', 'Cédula Identidad San Juan', 'CI San Juan')");

            $InsertTables12=$conn->query("INSERT INTO tipodocumento (nro_afip, descripcion, sigla) VALUES ('11', 'Cédula Identidad San Luis', 'CI San Luis')");

            $InsertTables13=$conn->query("INSERT INTO tipodocumento (nro_afip, descripcion, sigla) VALUES ('12', 'Cédula Identidad Santa Fe', 'CI Santa Fe')");

            $InsertTables14=$conn->query("INSERT INTO tipodocumento (nro_afip, descripcion, sigla) VALUES ('13', 'Cédula Identidad Santiago del Estero', 'CI Santiago del Estero')");

            $InsertTables15=$conn->query("INSERT INTO tipodocumento (nro_afip, descripcion, sigla) VALUES ('14', 'Cédula Identidad Tucumán', 'CI Tucumán')");

            $InsertTables16=$conn->query("INSERT INTO tipodocumento (nro_afip, descripcion, sigla) VALUES ('16', 'Cédula Identidad Chaco', 'CI Chaco')");

            $InsertTables17=$conn->query("INSERT INTO tipodocumento (nro_afip, descripcion, sigla) VALUES ('17', 'Cédula Identidad Chubut', 'CI Chubut')");

            $InsertTables18=$conn->query("INSERT INTO tipodocumento (nro_afip, descripcion, sigla) VALUES ('18', 'Cédula Identidad Formosa', 'CI Formosa')");

            $InsertTables19=$conn->query("INSERT INTO tipodocumento (nro_afip, descripcion, sigla) VALUES ('19', 'Cédula Identidad Misiones', 'CI Misiones')");

            $InsertTables20=$conn->query("INSERT INTO tipodocumento (nro_afip, descripcion, sigla) VALUES ('20', 'Cédula Identidad Neuquén', 'CI Neuquén')");

            $InsertTables21=$conn->query("INSERT INTO tipodocumento (nro_afip, descripcion, sigla) VALUES ('21', 'Cédula Identidad La Pampa', 'CI La Pampa')");

            $InsertTables22=$conn->query("INSERT INTO tipodocumento (nro_afip, descripcion, sigla) VALUES ('22', 'Cédula Identidad Río Negro', 'CI Río Negro')");

            $InsertTables23=$conn->query("INSERT INTO tipodocumento (nro_afip, descripcion, sigla) VALUES ('23', 'Cédula Identidad Santa Cruz', 'CI Santa Cruz')");

            $InsertTables24=$conn->query("INSERT INTO tipodocumento (nro_afip, descripcion, sigla) VALUES ('24', 'Cédula Identidad Tierra del Fuego', 'CI Tierra del Fuego')");

            $InsertTables25=$conn->query("INSERT INTO tipodocumento (nro_afip, descripcion, sigla) VALUES ('80', 'Clave única de Identificaciún Tributaria', 'CUIT')");

            $InsertTables26=$conn->query("INSERT INTO tipodocumento (nro_afip, descripcion, sigla) VALUES ('86', 'Clave única de Identificaciún Laboral', 'CUIL')");

            $InsertTables27=$conn->query("INSERT INTO tipodocumento (nro_afip, descripcion, sigla) VALUES ('87', 'Clave de Identificaciún', 'CDI')");

            $InsertTables28=$conn->query("INSERT INTO tipodocumento (nro_afip, descripcion, sigla) VALUES ('89', 'Libreta de Enrolamiento', 'LE')");

            $InsertTables29=$conn->query("INSERT INTO tipodocumento (nro_afip, descripcion, sigla) VALUES ('90', 'Libreta Cívica', 'LC')");

            $InsertTables30=$conn->query("INSERT INTO tipodocumento (nro_afip, descripcion, sigla) VALUES ('91', 'Cédula Identidad extranjera', 'CI extranjera')");

            $InsertTables31=$conn->query("INSERT INTO tipodocumento (nro_afip, descripcion, sigla) VALUES ('92', 'en trámite', 'en trámite')");


            $InsertTables32=$conn->query("INSERT INTO tipodocumento (nro_afip, descripcion, sigla) VALUES ('93', 'Acta nacimiento', 'Acta nacimiento')");

            $InsertTables33=$conn->query("INSERT INTO tipodocumento (nro_afip, descripcion, sigla) VALUES ('94', 'Pasaporte', 'Pasaporte')");

            $InsertTables34=$conn->query("INSERT INTO tipodocumento (nro_afip, descripcion, sigla) VALUES ('95', 'CI Bs. As. Registro Nacional de Prestadores', 'CI Bs. As. RNP')");

            $InsertTables35=$conn->query("INSERT INTO tipodocumento (nro_afip, descripcion, sigla) VALUES ('96', 'Documento Nacional de Identidad', 'DNI')");

            $InsertTables36=$conn->query("INSERT INTO tipodocumento (nro_afip, descripcion, sigla) VALUES ('99', 'Sin identificar/venta global diaria', 'Sin identificar/venta global diaria')");

            $InsertTables37=$conn->query("INSERT INTO tipodocumento (nro_afip, descripcion, sigla) VALUES ('30', 'Certificado de Migración', 'Certificado de Migración')");

            $InsertTables38=$conn->query("INSERT INTO tipodocumento (nro_afip, descripcion, sigla) VALUES ('88', 'Usado por Anses para Padrón', 'Usado por Anses para Padrón')");

        }
                
    }
    
    
    
 ?>
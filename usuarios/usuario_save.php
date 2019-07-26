
<?php


//include_once(dirname(__FILE__).'/../login/loginok.php');

include_once '../lib/connections/conn.php';

include_once '../lib/utils.php'; //no entender utils.php

$nombre = empty($_POST['nombre']) ? exit() : $_POST['nombre']; 
$apellido = empty($_POST['apellido']) ? exit() : $_POST['apellido'];
$nick= empty($_POST['nick']) ? exit() : $_POST['nick'];//COMPROBAR QUE EL NICK SEA DE TIPO UNIQUE
$contrasenia = empty($_POST['contrasenia']) ? exit() : $_POST['contrasenia'];
$perfilusuario_id = empty($_POST['perfilusuario_id']) ? exit() : $_POST['perfilusuario_id']; //COMPROBAR QUE EXISTE EL TIPO DE PERFIL EN LA BASE DE DATOS 


//DETALLE, si me esta man

//////////////////// PARA VALIDAR DESDE EL FRONT /////////////////////////
//
//
//if(empty($nro_afip)){
//    exit(json_response('Nro Afip Obligatorio',422));
//}
//
//if(!is_numeric($nro_afip)){
//    exit(json_response('Nro Afip Debe ser un numero',422));
//}
//
//if(empty($descripcion)){
//    exit(json_response('Descripcion Afip Obligatorio',422));
//}
//
//if(empty($sigla)){
//    exit(json_response('Sigla Afip Obligatorio',422));
//}


//////////////////////// CREAMOS LA CONEXION //////////////////////////////////



$conn = null;
$row_cnt = 0; 
if (crearConexion($conn)){
    
//    $contrasenia = md5($contrasenia);
    $query = "insert into usuario (nombre, apellido, nick, contrasenia, perfilusuario_id) VALUES ('$nombre', '$apellido', '$nick', '$contrasenia', $perfilusuario_id)";
      
  
        if(!$resultQuery = $conn->query($query)){ 
            //Observar que arriba dice ! ese signfica SI NO SE PUDO HACER LA QUERY...

            switch ($conn->errno) {
                case 1054:

                    exit(json_response("El tipo de perfil NO existe",422));
                    break;
                case 1062:
                    exit(json_response("Esta intentando cargar un dato duplicado. (Revisar nick)",422));
                   break;


               default:
                    exit(json_response($conn->errno,422));
            }
        }
        
    $conn->close();
    exit(json_response("",200));
   }






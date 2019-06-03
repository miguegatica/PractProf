
<?php
include_once(dirname(__FILE__).'/../login/loginok.php');

include_once '../lib/connections/conn.php';
include_once '../lib/utils.php'; 

$id = isset($_REQUEST["id"]) ? $_REQUEST["id"] : "";
if(empty($id)){
    exit(json_response("Seleccione un cliente valido!",422));
}


$nombre = isset($_REQUEST["nombre"]) ? $_REQUEST["nombre"] : ""; 
$apellido = isset($_REQUEST["apellido"]) ? $_REQUEST["apellido"] : ""; 
$nick = isset($_REQUEST["nick"]) ? $_REQUEST["nick"] : ""; 
$contrasenia = isset($_REQUEST["contrasenia"]) ? $_REQUEST["contrasenia"] : ""; 
$perfilusuario_id = isset($_REQUEST["perfilusuario_id"]) ? $_REQUEST["perfilusuario_id"] : ""; 



//////////////////// PARA VALIDAR DESDE EL FRONT /////////////////////////


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
if (crearConexion($conn)){
    $query = "UPDATE usuario SET nombre = '$nombre', apellido = '$apellido', nick= '$nick', contrasenia = '$contrasenia', perfilusuario_id = '$perfilusuario_id' WHERE id='$id' ";
    
    if(!$resultQuery = $conn->query($query)){ 
        //Observar que arriba dice ! ese signfica SI NO SE PUDO HACER LA QUERY...
        exit(json_response($conn->error,422));
    }

    $conn->close();
    exit(json_response("",200));
}


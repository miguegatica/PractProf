
<?php




include_once '../lib/connections/conn.php';

include_once '../lib/utils.php'; //no entender utils.php


$num_cliente = isset($_REQUEST["num_cliente"]) ? $_REQUEST["num_cliente"] : ""; 
$apellido = isset($_REQUEST["apellido"]) ? $_REQUEST["apellido"] : ""; 
$nombre = isset($_REQUEST["nombre"]) ? $_REQUEST["nombre"] : ""; 
$nro_afip = isset($_REQUEST["nro_afip"]) ? $_REQUEST["nro_afip"] : ""; 
$nro_documento = isset($_REQUEST["nro_documento"]) ? $_REQUEST["nro_documento"] : ""; 
$tipodocumento_id = isset($_REQUEST["tipodocumento_id"]) ? $_REQUEST["tipodocumento_id"] : ""; 



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
    $query = "INSERT INTO cliente (num_cliente, apellido, nombre, nro_afip, nro_documento, tipodocumento_id) VALUES ('$num_cliente', '$apellido', '$nombre', '$nro_afip', '$nro_documento', '$tipodocumento_id')";
    
    if(!$resultQuery = $conn->query($query)){ 
        $result[]= array('isError'=>true, 'msg'=>$resultQuery->error ); 
        exit(json_encode($result));    
    }
    $resultQuery->close();
    $conn->close();
    $result[]= array('isError'=>false );
    exit(json_encode($result));
}



<?php

include_once(dirname(__FILE__).'/../login/loginok.php');
include_once '../lib/connections/conn.php';
include_once '../lib/utils.php';


$id = isset($_REQUEST["id"])? $_REQUEST["id"] :""; 
$nro_afip = isset($_REQUEST["nro_afip"]) ? $_REQUEST["nro_afip"] : ""; 
$descripcion = isset($_REQUEST["descripcion"]) ? $_REQUEST["descripcion"] : ""; 
$sigla = isset($_REQUEST["sigla"]) ? $_REQUEST["sigla"] : ""; 



if(empty($id)){ //si no va a modificar el id si no se ve ? 
    exit(json_response('ID Obligatorio',422));
}

//empty me devuelve true cuando la variable esta vacia
if(empty($nro_afip)){
    exit(json_response('Nro Afip Obligatorio',422));
}

if(!is_numeric($nro_afip)){
    exit(json_response('Nro Afip Debe ser un numero',422));
}

if(empty($descripcion)){
    exit(json_response('Descripcion Afip Obligatorio',422));
}

if(empty($sigla)){
    exit(json_response('Sigla Afip Obligatorio',422));
}


 datosafipOld ($id);  


$conn = null;
if (crearConexion($conn)){
    
    $query = "UPDATE tipodocumento SET nro_afip = '$nro_afip', descripcion = '$descripcion', sigla = '$sigla'  WHERE id='$id' ";


 if(!$resultQuery = $conn->query($query)){ 
        //Observar que arriba dice ! ese signfica SI NO SE PUDO HACER LA QUERY...
        
        switch ($conn->errno) {
            case 1062:

                exit(json_response("El documento ingresado ya existe",422));
                break;
            default:
            exit(json_response($conn->errno,422));
        }
             
    }
    
datosafipNew ($id);
    
$movement = 'ACTUALIZAR';
insert_auditoriaDoc($movement); 

    $conn->close();
    exit(json_response("",200));
}
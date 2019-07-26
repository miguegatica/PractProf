
<?php
include_once(dirname(__FILE__).'/../login/loginok.php');

include_once '../lib/connections/conn.php';

include_once '../lib/utils.php'; 


// empty = "vacío"

//IF de 1 sola linea... analizar_booleano ? true : false
$nro_afip = isset($_REQUEST["nro_afip"]) ? $_REQUEST["nro_afip"] : ""; 
$descripcion = isset($_REQUEST["descripcion"]) ? $_REQUEST["descripcion"] : ""; 
$sigla = isset($_REQUEST["sigla"]) ? $_REQUEST["sigla"] : ""; 




if(!is_numeric($nro_afip)){
    exit(json_response('Nro Afip Debe ser un numero',422));
}

if(empty($descripcion)){
    exit(json_response('Descripcion Afip Obligatorio',422));
}

if(empty($sigla)){
    exit(json_response('Sigla Afip Obligatorio',422));
}

if(!is_string($sigla)){
    exit(json_response('Sigla Debe ser alfabetico',422));
}



$conn = null;
if (crearConexion($conn)){
    $query = "INSERT INTO tipodocumento (nro_afip, descripcion, sigla) VALUES ('$nro_afip', '$descripcion', '$sigla')";
   
    
     if(!$resultQuery = $conn->query($query)){ 

        switch ($conn->errno) {
            case 1062:

                exit(json_response("El documento ingresado ya existe",422));
                break;
            default:
            exit(json_response($conn->error,422));
        }
             
    }
    
    $id = devolverIdAfip($nro_afip);
    
    datosafip ($id);
    
    $movement = 'INSERTAR';
            
    insert_auditoriaDoc($movement);
    
    

    $conn->close();
    exit(json_response("",200));
  
}




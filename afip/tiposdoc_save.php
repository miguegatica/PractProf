
<?php



include_once '../lib/connections/conn.php';

include_once '../lib/utils.php'; //no entender utils.php
// isset = "establecido"
// empty = "vacío"

//IF de 1 sola linea... analizar_booleano ? true : false
$nro_afip = isset($_REQUEST["nro_afip"]) ? $_REQUEST["nro_afip"] : ""; 
$descripcion = isset($_REQUEST["descripcion"]) ? $_REQUEST["descripcion"] : ""; 
$sigla = isset($_REQUEST["sigla"]) ? $_REQUEST["sigla"] : ""; 




//////////////////// PARA VALIDAR DESDE EL back /////////////////////////


// TUVE QUE IDENTAR PARA QUE ME DEJE INGRESAR EL CERO, PORQUE EMPTY LO TOMA COMO VACIO 

//if(isset($nro_afip)){
//    exit(json_response('Nro Afip Obligatorio',422));
//}

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



//////////////////////// CREAMOS LA CONEXION //////////////////////////////////


//¿Que espera el save..? un json que contenga el error en caso de error
// o un result true 
// si algunos de los campos esta mal, exit es como die 
// exit que? exit un json .., que json? ... un $resultado.., que contiene $result? el error campos deben ser obligatorios
// ..... y sigue? .., NO, SALE CON EL EXIT 
// tener en cuenta que la conexion debe ser unica para todas 

$conn = null;
if (crearConexion($conn)){
    $query = "INSERT INTO tipodocumento (nro_afip, descripcion, sigla) VALUES ('$nro_afip', '$descripcion', '$sigla')";
    
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

    $conn->close();
    exit(json_response("",200));
}
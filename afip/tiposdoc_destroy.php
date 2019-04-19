<?php


include_once '../lib/connections/conn.php';
include_once '../lib/utils.php';


$id = isset($_REQUEST["id"])? $_REQUEST["id"] :""; 


if(empty($id)){
    exit(json_response('ID Obligatorio',422));
}


$conn = null;
if (crearConexion($conn)){
    $query = "DELETE FROM tipodocumento  WHERE id='$id' ";
    
    if(!$resultQuery = $conn->query($query)){
        $mensajeError = "Error Data Base";
        switch ($conn->errno) {
            case 1451:

                $mensajeError = "Hay clientes con el codigo de eliminar.";
                break;

        }
        $conn->close();
        exit(json_response($mensajeError,422));
        
    }

    $conn->close();
    $result[]= array('isError'=>false );
    exit(json_encode($result));
}



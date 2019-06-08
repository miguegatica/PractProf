<?php
include_once(dirname(__FILE__).'/../login/loginok.php');

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
                exit(json_response("Hay clientes con el codigo de documento a eliminar.",422));
                break;
             default:
                exit(json_response($conn->errno,422));
        }
        exit(json_response($conn->error,422));
        
    }
    
    $movement = 'inicio sesion';
    insert_log($movement);

    $conn->close();
    exit(json_response("",200));
}



//function json_response($message = null, $code = 200){
// return json_encode(array(
//        'status' => $code < 300, // si el error es menor a 300 va a ponerlo en "true" (no hubo un error http)
//        'errorMsg' => $message   // ..., sino va a mostrar este mensaje 
//        ));
// }



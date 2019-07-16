<?php
include_once(dirname(__FILE__).'/../login/loginok.php');

include_once '../lib/connections/conn.php';
include_once '../lib/utils.php';


$id = isset($_REQUEST["id"])? $_REQUEST["id"] :""; 


//if(empty($id)){
//    exit(json_response('ID Obligatorio',422));
//}


    datoscustormer($id);

    $movement = 'ELIMINAR';

    insert_auditoriaCustomer($movement);


$conn = null;
if (crearConexion($conn)){
    $query = "DELETE FROM cliente  WHERE id='$id' ";
    

    
    if(!$resultQuery = $conn->query($query)){
        $mensajeError = "Error Data Base";
//        switch ($conn->errno) {
//            case 1451:
//
//                $mensajeError = "Hay clientes con el codigo de eliminar.";
//                break;
//
//        }
        exit(json_response($conn->error,422));
        
    }

 
    $conn->close();
    exit(json_response("",200));
}



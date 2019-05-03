<?php //
include_once '../lib/connections/conn.php';
include_once '../lib/utils.php';


$id = isset($_REQUEST["id"])? $_REQUEST["id"] :""; 

//tuve que identar esto, porque me daba un error

if(empty($id)){
    exit(json_response('ID Obligatorio',422));
}


$conn = null;


if (crearConexion($conn)){
    $query = "DELETE FROM tipodocumento  WHERE id='$id' ";
   
    if(!$resultQuery = $conn->query($query)){ 
        exit(json_response($conn->error,422));
  
    }

    $conn->close();
    exit(json_response("",200));
}
     
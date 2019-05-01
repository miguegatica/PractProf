<?php //
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
        $mensajeError = "Error Data Base"; //si hubo en error se guarda ese error inmediatamente, algo hay q ponerle
        switch ($conn->errno) {
            case 1451:

                $mensajeError = "Hay clientes con el codigo de eliminar.";
                break;

        }
        $conn->close();
        exit(json_response($mensajeError,422));
        
    }

    $conn->close();
    $result[]= array('isError'=>false);
    exit(json_encode($result));
    

/*
 //Los OBJETOS en PHP se pueden convertir a JSON usando la función json_encode () de PHP
  <?php
    $myObj->name = "John";
    $myObj->age = 30;
    $myObj->city = "New York";

    $myJSON = json_encode($myObj);

    echo $myJSON;
  
 navegador : {"nombre": "John", "edad": 30, "ciudad": "Nueva York"}

?>    
*/
    
    
    
    
    
    
/*    
 //Los AREGLOS en PHP también se convertirán en JSON cuando se use la función json_encode () de PHP:    
 <?php
$myArr = array("John", "Mary", "Peter", "Sally");

$myJSON = json_encode($myArr);

echo $myJSON;
?>   
*/



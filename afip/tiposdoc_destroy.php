<?php //
include_once '../lib/connections/conn.php';
include_once '../lib/utils.php';



$id = isset($_REQUEST["id"])? $_REQUEST["id"] :""; 


//if(empty($id)){
//    exit(json_response('ID Obligatorio',422));
//}


$conn = null;
if (crearConexion($conn)){
    $query = "DELETE FROM tipodocumento  WHERE id='$id' ";

    
    if(!$resultQuery = $conn->query($query)){
        $mensajeError = "Error Data Base"; //si hubo en error se guarda ese error inmediatamente, algo hay q ponerle
     
        switch ($conn->errno) {
            case 1451:
                $mensajeError = "Hay clientes con el codigo de eliminar.";
                $conn->close();
                exit(json_response($mensajeError,422));
                break;
             default:
                exit(json_response($conn->error,422));
        }
   
       // errno me trae el numero de error 
  
    }

    $conn->close();
    $result[]= array('isError'=>false);
     
//    $result[]= array('isError'=>false, 'msg' => 'Muy bien');// en el front no esta esperando un mensaje?? 
    
    exit(json_encode($result)); // si sale bien la query le mando al front el array result 
    
}



 // ******** código del lado del cliente ************
// $ ('# dg'). edatagrid ({
//	 onError: función (índice, fila) {
//		 alerta (row.msg);
//	 }
// });


//********  código del lado del servidor **********
// echo json_encode (array (
//	 'isError' => true,
//	 'msg' => 'mensaje de error'.
// ));

















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



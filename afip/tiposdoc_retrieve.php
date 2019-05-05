<?php


include_once '../lib/connections/conn.php';


$result = array();

$page="";
$rows="";


if (isset($_POST['page'])==true){
    $pagina_seleccionada = $_POST['page'];
}else{
    $pagina_seleccionada = 1;
}
// ¿  Me esta mandando la cantidad de renglones que quiere ver ? 

if (isset($_POST['rows'])==true){
    $cantidad_a_ver = $_POST['rows'];
}else{
    $cantidad_a_ver = 10;
}       



$cuantos_saltearse = ($pagina_seleccionada-1)*$cantidad_a_ver;


///////////////////////////////// 2) REALIZAR QUERY PARA RECUPERAR LOS TIPOS DOCUMENTOS /////////////////////////////////////////

$query = " select SQL_CALC_FOUND_ROWS tipodocumento.* from tipodocumento ORDER BY tipodocumento.nro_afip ASC";


$query .=" limit $cuantos_saltearse, $cantidad_a_ver";
    

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


$result["total"] = "500"; 

$items = array();




////////////////////////////////////// 3) ANALIZAR SI HAY RESULTADOS (creamdo conexion) /////////////////////////////////////////////////////

$conn = null;

if (crearConexion($conn)){ 
    if(!$resultQuery = $conn->query($query)){ 
        die('There was an error running the query [' . $conn->error . ']');
    }      
 
   
   else{
    
       $result["total"] = $conn->query("SELECT FOUND_ROWS() as cant;")->fetch_object()->cant;
 
       
       
  //////////////// 4) SI HAY RESULTADOS RECORRERLOS Y ARMAR UN ARRAY PHP PARA IR ALMACENANDO LOS DATOS ////////////////////////
        
 
        while($row = $resultQuery->fetch_object()) { 
                   array_push($items, $row); 
        }
    }


    $resultQuery->close();  
    $conn->close();
 }

$result["rows"] = $items;


echo json_encode($result);  


/*
Desde el PHP se convierte la solicitud en un objeto, usando la función PHP json_decode ()

Acceda a la base de datos y complete una matriz con los datos solicitados.
 
Agregue la matriz a un objeto y devuelva el objeto como JSON utilizando la función json_encode ()  
  

*/








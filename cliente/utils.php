<?php
include_once '../lib/connections/conn.php';

$metodo = $_GET['metodo'];
$result = array();

$query = "";

$items = array();

switch ($metodo) {
    case 'tiposdoclist':

        $query = " select id, CONCAT(sigla,' (',nro_afip,')') as text from tipodocumento ";
        break;
    case 'zonasVentas':

        $query = " select id, CONCAT(descripcion,' (',num_zona,')') as text from zonaventa ";
    default:
        break;
}


$conn = null;

if (crearConexion($conn)){ 
    if(!$resultQuery = $conn->query($query)){ 
        exit(json_response($conn->error,422));
    }      
   else{
        while($row = $resultQuery->fetch_object()) { 
                   array_push($items, $row); 
        }
    }
    $conn->close();
 }

echo json_encode($items);  













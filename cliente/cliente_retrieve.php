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

if (isset($_POST['rows'])==true){
    $cantidad_a_ver = $_POST['rows'];
}else{
    $cantidad_a_ver = 10;
}       

$cuantos_saltearse = ($pagina_seleccionada-1)*$cantidad_a_ver;
$query = " select SQL_CALC_FOUND_ROWS cliente.*, (select CONCAT(sigla,' (',nro_afip,')')  from tipodocumento where tipodocumento.id=cliente.tipodocumento_id) as tipodoc_descripcion from cliente ";
$query .=" limit $cuantos_saltearse, $cantidad_a_ver";
    

$result["total"] = "500"; 
$items = array();
$conn = null;

if (crearConexion($conn)){ 
    if(!$resultQuery = $conn->query($query)){ 
        die('There was an error running the query [' . $conn->error . ']');
    }      
    else{
     $result["total"] = $conn->query("SELECT FOUND_ROWS() as cant;")->fetch_object()->cant;
       
            while($row = $resultQuery->fetch_object()) { 
                   array_push($items, $row); 
        }
    }
    $resultQuery->close();  
    $conn->close();
 }

$result["rows"] = $items;

echo json_encode($result);  













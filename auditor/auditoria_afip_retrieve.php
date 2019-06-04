<?php

include_once(dirname(__FILE__).'/../login/loginok.php');

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
$query = " Select * from auditoriatipodocumento ";       

if (isset($_POST['sort'])){
    $sort=$_POST['sort'];//Columna
    $order=$_POST['order']; //Asc o DESC 
    
    switch ($sort) {
        case 'nro_afipOld':
            $query.="order by CAST(nro_afipOld as unsigned) $order ";
            break;
        default:
            $query.=" order by $sort  $order ";
            break;
    }
}else{
    $query .= "order by CAST(siglaOld as unsigned) ASC ";
}

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




//********************************** FILTRO **********************************************


//
//
////$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
////$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
////$accion = isset($_POST['accion']) ? mysql_real_escape_string($_POST['accion']) : '';
//
//$page = isset($_POST['page']) ? $_POST['page'] : 1;
//$rows = isset($_POST['rows']) ? $_POST['rows'] : 10;
//$accion = isset($_POST['accion']) ? $_POST['accion'] : '';
//
////$cuantos_saltearse = ($pagina_seleccionada-1)*$cantidad_a_ver;
//$cuantos_saltearse = ($page-1)*$rows;
// 
//$result = array();
// 
//$where = "accion like '$accion%'";
//$rs = mysql_query("select count(*) from auditoriatipodocumento where " . $where);
//$row = mysql_fetch_row($rs);
//$result["total"] = $row[0];
// 
//$rs = mysql_query("select * from auditoriatipodocumento where " . $where . " limit $cuantos_saltearse,$rows");
// 
//$items = array()7while($row = mysql_fetch_object($rs)){
//    array_push($items, $row);
//}
//$result["rows"] = $items;
// 
//echo json_encode($result);
//






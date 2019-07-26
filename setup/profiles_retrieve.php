<?php

include_once('../lib/connections/conn.php');
include_once('../lib/utils.php');

    require_once('../lang.php');
    $tr = $lang['es_LAT'];

    

    
    $result = array();
    $db = null;
    if (crearConexion($db)) {
        $db->query("set NAMES utf8;");

        $cSelect = " select * from perfilusuario ";


        $queryCount="select *, count(id) as total from perfilusuario  ";



        if(!$result1 = $db->query($cSelect))
        {
            die('There was an error running the query [' . $db->error . ']');
        }

        $items = array();
        while($row = $result1->fetch_object()) {
                array_push($items, $row);
            }
        $result1->close();  
        // *************** query ************************  

        // total puro sin limites para paginacion
        $result["total"] = count($items);      

        $result["rows"] = $items;
        $db->close();        
    }
echo json_encode($result);
    
        
?>

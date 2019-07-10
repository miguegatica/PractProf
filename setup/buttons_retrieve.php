<?php

class CellTable {

    public $field;
    public $title;
    public $width;
    public $checkbox;

}

include_once('../lib/connections/conn.php');
include_once('../lib/utils.php');

require_once('../lang.php');
$tr = $lang['es_LAT'];



$type = $_GET['type'];
$db = null;
if (crearConexion($db)) {
    $db->query("set NAMES utf8;");

    //Obtengo todos los Hie para armar la query
    $query = "select permisos.title, ";

    $hies = $db->query("select * from perfilusuario ");
    while ($row = $hies->fetch_object()) {
        //Lo que concateno en la query es el "value" de cada row, de esta forma por javascript hago un split por el punto y coma y obtengo los valores de cada celda como idHie, idButton, module, etc.
        //Para entender observar el split que hago en myformatterChecked (buscar la funcion en el proyecto)
        $query .= "(SELECT CONCAT(permisos_perfiles.can,';',permisos_perfiles.perfil_id,';',permisos.idselector,';','$type') 
        from permisos_perfiles where permisos_perfiles.permiso_id=permisos.id and permisos_perfiles.perfil_id='$row->id') as '$row->perfil' ,";
    }
    //Quito la ultima coma.
    $query = substr($query, 0, -1);
    $query .= " FROM permisos 
                LEFT JOIN params on permisos.param = params.`name` 
                WHERE permisos.module='$type' and (permisos.paramval = params.parameter or LENGTH(permisos.paramval)=0)
                order by permisos.id ";
    //echo $query.'<br>';
    $result = array();


    if (!$result1 = $db->query($query)) {
        echo $query . "<br>";
        die('There was an error running the query [' . $db->error . ']');
    }

    $items = array();
    $fields = array();
    while ($row = $result1->fetch_object()) {
        //Los titulos vienen separados por ";" mas que nada para saber la ruta.
        $title = $row->title;
        $titles = explode(";", $title);


        // Loop through each email and validate it
        if (count($titles) > 1) {
            $titlelang = "";
            foreach ($titles as $t) {
                $tran = $t;
                if (isset($tr[$t])) {
                    $tran = $tr[$t];
                }
                $titlelang .= $tran . " / ";
            }
        } else {
            $titlelang = $title;
            if (isset($tr[$title])) {
                $titlelang = $tr[$title];
            }
        }
        $titlelang = trim($titlelang);
        $titlelang = rtrim($titlelang, "/");

        $row->title = $titlelang;
        array_push($items, $row);
    }

    //Aca guardo el nombre de las columnas.
    while ($property = $result1->fetch_field()) {
        $cell = new CellTable();
        $cell->field = $property->name;
        $cell->title = $property->name;
        $cell->width = 30;
        $cell->checkbox = false;
        array_push($fields, $cell);
        unset($cell);
    }
    $fields = json_encode($fields);

    $result1->close();
    // *************** query ************************  

    $result["rta"] = true;
    $result["rows"] = $items;
    $result["fields"] = $fields;
    $db->close();
    //logger('serialize ALL: ' . serialize($result));
}


echo json_encode($result);
?>

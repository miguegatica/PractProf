
<?php


include_once '../lib/connections/conn.php';
include_once '../lib/utils.php';


$id = isset($_REQUEST["id"])? $_REQUEST["id"] :""; 
$nro_afip = isset($_REQUEST["nro_afip"]) ? $_REQUEST["nro_afip"] : ""; 
$descripcion = isset($_REQUEST["descripcion"]) ? $_REQUEST["descripcion"] : ""; 
$sigla = isset($_REQUEST["sigla"]) ? $_REQUEST["sigla"] : ""; 



if(empty($id)){ //si no va a modificar el id si no se ve ? 
    exit(json_response('ID Obligatorio',422));
}

//empty me devuelve true cuando la variable esta vacia
if(empty($nro_afip)){
    exit(json_response('Nro Afip Obligatorio',422));
}

if(!is_numeric($nro_afip)){
    exit(json_response('Nro Afip Debe ser un numero',422));
}

if(empty($descripcion)){
    exit(json_response('Descripcion Afip Obligatorio',422));
}

if(empty($sigla)){
    exit(json_response('Sigla Afip Obligatorio',422));
}

$conn = null;
if (crearConexion($conn)){
    $query = "UPDATE tipodocumento SET nro_afip = '$nro_afip', descripcion = '$descripcion', sigla = '$sigla'  WHERE id='$id' ";
    
    if(!$resultQuery = $conn->query($query)){
        exit(json_response($conn->error,422));
    }

    $conn->close();
    $result[]= array('isError'=>false );
    exit(json_encode($result));
}


//// NO ENTIENDO ///// //si no va a modificar el id si no se ve ?  

/* 
Cuando edita solo lo hace sobre el datagrid.., entonces en la query dice where id = $id..., pero si nunca
le pasamos el id para editar..., 
¿O sera que cuando apreta el update (o sobre la grilla para editar)
esta llamando la id? ..., no entiendo ! 
 */

<?php



include_once '../lib/connections/conn.php';

include_once '../lib/utils.php'; //no entender utils.php


//IF de 1 sola linea... analizar_booleano ? true : false
$nro_afip = isset($_REQUEST["nro_afip"]) ? $_REQUEST["nro_afip"] : ""; 
$descripcion = isset($_REQUEST["descripcion"]) ? $_REQUEST["descripcion"] : ""; 
$sigla = isset($_REQUEST["sigla"]) ? $_REQUEST["sigla"] : ""; 




//////////////////// PARA VALIDAR DESDE EL back /////////////////////////


//empty = vacio
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

if(!is_string($sigla)){
    exit(json_response('Sigla Debe ser alfabetico',422));
}

/////////////////////////////////////////////////////////////////////////////






//////////////////////// CREAMOS LA CONEXION //////////////////////////////////


//¿Que espera el save..? un json que contenga el error en caso de error
// o un result true 
// si algunos de los campos esta mal, exit es como die 
// exit que? exit un json .., que json? ... un $resultado.., que contiene $result? el error campos deben ser obligatorios
// ..... y sigue? .., NO, SALE CON EL EXIT 
// tener en cuenta que la conexion debe ser unica para todas 

$conn = null;
if (crearConexion($conn)){
    $query = "INSERT INTO tipodocumento (nro_afip, descripcion, sigla) VALUES ('$nro_afip', '$descripcion', '$sigla')";
    
    if(!$resultQuery = $conn->query($query)){ //SI NO SE DA LA QUERY ...., SINO SALE Y CIERRA 
        $result[]= array('isError'=>true, 'msg'=>$resultQuery->error ); // warning? 
        $conn->close();
        exit(json_encode($result));    
    }
    $conn->close();
    $result[]= array('isError'=>false );
    exit(json_encode($result));
}



// Hay 3 tipos de validacion:
// ... en el front  -------------------- "LO MEJOR ES QUE LA VALIDACION SE HAGA DEL FRENTE, no con cartelito " 
// ... en el php
// ... en el mysql

//¿SE VALIDA ALGUNAS COSAS EN EL FOMT Y ALGUNAS EN EL BACK?
//¿LO QUE SE VALIDA EN EL FRONT.., NO SE VALIDA EN EL BACK?



// Si el tipo te dice ¿Lo validastes en el servidor?
//..., entonces en tiposdoc_main .php cambia true por false

//<thead>
//    <tr>
//        <th field="id" width="50" hidden=true>ID</th>
//        <th field="nro_afip" width="50" editor="{type:'validatebox',options:{required:FALSE}}">Nro AFIP</th>
//        <th field="descripcion" width="50" editor="{type:'validatebox',options:{required:FALSE}}">Descripcion</th>
//        <th field="sigla" width="50" editor="{type:'validatebox',options:{required:FALSE}}">Sigla</th>
//    </tr>
//</thead>





// audio 5:47     validando el el front que sea numerico el nro_afip 



////////////////  VER //////////////////////

/*
Hizo una validacion en el back (cosa que en el front es redificil hacer) ..., en donde cargo todos los numeros 
de afip correctos, cosa que si pone 700 le salte un cartel que no existe 
 
Despues borro la validacion, donde guardaba en el array todos los nro_Afip posible
porque si yo me muero como programador y despues quieren agregar un num_afip nuevo que no existe .....

Igual quisiera saber como lo hizo (minuto 5:57 ) 
  
 
 */

<?php


//include_once(dirname(__FILE__).'/../login/loginok.php');

include_once '../lib/connections/conn.php';

include_once '../lib/utils.php'; //no entender utils.php

$namePost = empty($_POST['namePost']) ? exit() : $_POST['namePost']; 
$surnamePost = empty($_POST['surnamePost']) ? exit() : $_POST['surnamePost'];
$userPost= empty($_POST['userPost']) ? exit() : $_POST['userPost'];//COMPROBAR QUE EL NICK SEA DE TIPO UNIQUE
$passPost = empty($_POST['passPost']) ? exit() : $_POST['passPost'];
$perfilPost = empty($_POST['perfilPost']) ? exit() : $_POST['perfilPost']; //COMPROBAR QUE EXISTE EL TIPO DE PERFIL EN LA BASE DE DATOS 


//DETALLE, si me esta man

//////////////////// PARA VALIDAR DESDE EL FRONT /////////////////////////
//
//
//if(empty($nro_afip)){
//    exit(json_response('Nro Afip Obligatorio',422));
//}
//
//if(!is_numeric($nro_afip)){
//    exit(json_response('Nro Afip Debe ser un numero',422));
//}
//
//if(empty($descripcion)){
//    exit(json_response('Descripcion Afip Obligatorio',422));
//}
//
//if(empty($sigla)){
//    exit(json_response('Sigla Afip Obligatorio',422));
//}


//////////////////////// CREAMOS LA CONEXION //////////////////////////////////



$conn = null;
$row_cnt = 0; 
if (crearConexion($conn)){
    
     $query = "insert into usuario (nombre, apellido, nick, contrasenia, id_perfilUsuario) VALUES ('$namePost', '$surnamePost', '$userPost', '$passPost', $perfilPost)";
      if(!$resultQuery = $conn->query($query)){ 
           exit(json_response($conn->errno,422));
      }
     else {
           $row_cnt = $resultQuery->num_rows;  
     }
     
    $resultQuery->close();  
    $conn->close();
}     


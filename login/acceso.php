<?php
include_once(dirname(__FILE__).'/../lib/utils.php');

//A) //////////////////////////////////////////////////
include_once '../lib/connections/conn.php';
include_once '../lib/utils.php'; 

////////////////////////////////////////////////////////


if(is_session_started() == false){
    //Si esta apagada la session la enscendemos
    session_start();
}

if(empty($_POST['user']) or empty($_POST['pass']) ){//si esta la sesion vacia lo redirige a login 
    header("location: ../login.php");
    exit();
}

$user = empty($_POST['user']) ? exit() : $_POST['user'];
$pass = empty($_POST['pass']) ? exit() : $_POST['pass'];


//Si llego a este punto es porque EXISTE   ..., llegaron los datos en el logeo  





//Aca en este punto analizar si existe en la BD


///////////////////// Anlizando si existe en la base de datos ////////////////////////
// B) ///////////////////////////////////////////////////////////////////////////////




//SI EXISTE ESOS DATOS DE LOGUEO, ES TRUE
//else
$existeEnLaBD = true;

////////////////////////////////////////////////

if($existeEnLaBD){
    $_SESSION['usuario'] = $user; // gracias a esta linea el usuario puede usar el sistema 
    header("Location: ../index.php");
    exit();
}
header("location: ../login.php");
exit();
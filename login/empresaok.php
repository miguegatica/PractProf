<?php

include_once(dirname(__FILE__).'/../lib/utils.php');

$date=date("Y-m-d");
$time=date("H:i:s");


if(is_session_started() == false){
    session_start();
}


if(empty($_SESSION['empresa.db'])){ //si esta la sesion vacia lo redirige a login 
    header("location:empresas/empresas.php");
    exit();
}



